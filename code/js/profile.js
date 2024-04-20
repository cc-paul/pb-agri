function openImage() {
    javascript:document.getElementById('image_uploader').click();
}

$('#image_uploader').change(function (e) {
	var file_data = $('#image_uploader').prop('files')[0];
	var form_data = new FormData();
	form_data.append('file', file_data);
	$.ajax({
	    url: '../code/php/web/upload_profile.php',
	    dataType: 'text',
	    cache: false,
	    contentType: false,
	    processData: false,
	    data: form_data,
	    type: 'post',
	    success: function(data) {
            location.reload(true);
        }
	});
});

$("#btnChangePassword").click(function(){
    var password = $("#txtPassword").val();
    var repeatPassword = $("#txtRepeatPassword").val();
    
    if (password == "" || repeatPassword == "") {
        JAlert("Please fill in all required fields","red");
    } else if (password != repeatPassword) {
        JAlert("Password does not match","red");
    } else if (!checkPassword(password)) {
        JAlert("Password must be between 6 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character","red");
    } else {
        $.ajax({
            url: "../code/php/web/login.php",
            data: {
                command : 'change_password',
                password : password
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                JAlert(data[0].message,data[0].color);
                
                if (!data[0].error) {
                    $("#txtPassword").val(null);
                    $("#txtRepeatPassword").val(null);
                }
            }
        });
    }
});

function checkPassword(password) {
    var decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,15}$/;
    
    if (password.match(decimal)) { 
        return true;
    } else { 
        return false;
    }
}