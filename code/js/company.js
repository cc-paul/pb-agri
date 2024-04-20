var marker;

mapboxgl.accessToken = 'pk.eyJ1IjoicGFnZW50ZSIsImEiOiJjbDc2eW52NTIwcDBlM3hrYWh0MWx2dnM2In0.k5b0sazc7NwabRj1SLiNAA';
const map = new mapboxgl.Map({
   container: 'map',
   style: 'mapbox://styles/mapbox/streets-v12',
   center: [121.4692, 14.1407],
   zoom: 18,
   projection: 'globe', // display the map as a 3D globe
   pitch: 50, // pitch in degrees
   bearing: -30, // bearing in degrees
   maxZoom: 20
});

map.addControl(
    new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
      mapboxgl: mapboxgl
    })
);

map.addControl(new mapboxgl.NavigationControl());

map.on('style.load', function() {
    
   map.on('click', function(e) {
      var coordinates = e.lngLat;
      latLong = coordinates.lat + "," + coordinates.lng;
      selectedLat = coordinates.lat;
      selectedLng = coordinates.lng;
      console.log(coordinates);
      
      addMarker(coordinates.lat,coordinates.lng);
   });
	 
	 
	 $.ajax({
		url: "../code/php/web/company",
		data: {
			command : 'get_lat_lng'
		},
		type: 'post',
		success: function (data) {
			var data = jQuery.parseJSON(data);
			
			if (data.length != 0) {
                if (data[0].lat != 0) {
				addMarker(data[0].lat,data[0].lng);
				
				map.flyTo({
					center: [data[0].lng, data[0].lat],
					essential: true // this animation is considered essential with respect to prefers-reduced-motion
				});
      }
    }
		}
	});
});

function addMarker(lat,lng) {
	if (marker) {
		marker.remove();
	}
	
	marker = new mapboxgl.Marker()
 .setLngLat([lng,lat])
 .addTo(map);
	 
	 
	$.ajax({
		url: "../code/php/web/company",
		data: {
			command : 'update_company_map',
			lat : lat,
			lng : lng
		},
		type: 'post',
		success: function (data) {
			var data = jQuery.parseJSON(data);
			
			if (data[0].error) {
				JAlert(data[0].message,data[0].color);
      }
		}
	});
}


$("#btnSave").click(function(){
	var companyName = $("#txtCompanyName").val();
	var oldCompanyName = $("#lblOldCompanyName").text();
    var companyWebsite = $("#txtCompanyWebsite").val();
    var companyAddress = $("#txtCompanyAddress").val();
    var mobileNumber = $("#txtMobileNumber").val();
    var emailAddress = $("#txtEmailAddress").val();
    var contactPerson = $("#txtContactPerson").val();
    var aboutUs = $("#txtAboutUs").val();
	
	if (companyAddress == "" || companyAddress == "" || mobileNumber == "" || emailAddress == "" || contactPerson == "" || aboutUs == "") {
		JAlert("Please fill in required fields","red");
    } else if (mobileNumber.length != 11) {
        JAlert("Mobile Number must be 11 digit","red");
    } else if (!validateEmail(emailAddress)) {
				JAlert("Please provide proper Email Address","red");
    } else if (companyWebsite != "" && !validURL(companyWebsite)) {
        JAlert("Please provide proper Bussines Website","red");
    } else if (aboutUs.length < 100) {
		JAlert("About Us must be at least 100 characters","red");
	} else {
		$.ajax({
			url: "../code/php/web/company",
			data: {
				command : 'save_company_profile',
				companyName : companyName,
				oldCompanyName : oldCompanyName,
				companyWebsite : companyWebsite,
				companyAddress : companyAddress,
				mobileNumber : mobileNumber,
				emailAddress : emailAddress,
				contactPerson : contactPerson,
				aboutUs : aboutUs
			},
			type: 'post',
			success: function (data) {
				var data = jQuery.parseJSON(data);
				
				JAlert(data[0].message,data[0].color);
			}
		});
	}
});

function validateEmail(email) {
	var re = /\S+@\S+\.\S+/;
	return re.test(email);
}

function validURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return !!pattern.test(str);
}