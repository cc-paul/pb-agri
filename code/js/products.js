var tblProduct;
var isNewProduct;
var oldProductName;
var id;
var hasVideo = 0;

loadProducts();

$("#btnNewProduct").click(function(){
	isNewProduct = 1;
	oldProductName = "";
	id = 0;

	
	$("#cmbCategory").val(null);
	$("#cmbSubCategory").val(null);
	$("#cmbPackType").val(null);
	$("#txtItemName").val(null);
	$("#txtDescription").val(null);
	$("#txtManufacturersName").val(null);
	$("#txtDateManufactured").val(null);
	$("#txtExpirationDate").val(null);
	$("#txtCostPrice").val(null);
	$("#txtRetailPrice").val(null);
	$("#txtStocks").val(null);
	$("#txtTotalSold").val(null);
	$("#chkActive").prop("checked", true);
	$("#chkWithVideo").prop("checked", false);
	$("#chkActive").prop("disabled", true);
	$("#btnGallery").prop("disabled", true);
	$("#btnUploadVideo").prop("disabled", true);
	$("#txtHowToUse").val(null);
	$("#txtFDA").val(null);
	$("#txtYT").val(null);
	$("#dvReminder").hide();
	$("#aVideo").hide();
	$("#aYoutube").hide();
	$("#dvProgress").css("width","0%");
	hasVideo = 0;
	
	$("#mdProductForm").modal("show");
});

$('#tblProduct tbody').on('click', 'td button', function (){
	var data = tblProduct.row( $(this).parents('tr') ).data();
	
	isNewProduct = 0;
	oldProductName = data.itemName;
	id = data.id;
	
	$("#cmbCategory").val(data.categoryID);
	$("#cmbSubCategory").val(data.subCategoryID);
	$("#cmbPackType").val(data.packID);
	$("#txtItemName").val(data.itemName);
	$("#txtDescription").val(data.description);
	$("#txtManufacturersName").val(data.manufacturersName);
	$("#txtDateManufactured").val(data.s_dateManufactured);
	$("#txtExpirationDate").val(data.s_expirationDate);
	$("#txtCostPrice").val(data.costPrice);
	$("#txtRetailPrice").val(data.retailPrice);
	$("#txtStocks").val(data.stocks);
	$("#txtTotalSold").val(data.totalSold);
	$("#txtHowToUse").val(data.howToUse);
	$("#chkActive").prop("checked", data.isActive == 1 ? true : false);
	$("#chkActive").prop("disabled", false);
	$("#chkWithVideo").prop("checked", data.hasVideo == 1 ? true : false);
	$("#btnGallery").prop("disabled", false);
	$("#btnUploadVideo").prop("disabled", false);
	$("#txtYT").val(data.youtubeLink);
	$("#dvReminder").show();
	$("#dvProgress").css("width","0%");
	hasVideo = data.hasVideo == 1 ? true : false;
	
	$("#aVideo").show();
	$("#aYoutube").show();
	
	$("#mdProductForm").modal("show");
});

$('#tblProduct tbody').on('dblclick', 'td', function (){
	var data = tblProduct.row( $(this).parents('tr') ).data();
	
	isNewProduct = 0;
	oldProductName = data.itemName;
	id = data.id;
	
	$("#cmbCategory").val(data.categoryID);
	$("#cmbSubCategory").val(data.subCategoryID);
	$("#cmbPackType").val(data.packID);
	$("#txtItemName").val(data.itemName);
	$("#txtDescription").val(data.description);
	$("#txtManufacturersName").val(data.manufacturersName);
	$("#txtDateManufactured").val(data.s_dateManufactured);
	$("#txtExpirationDate").val(data.s_expirationDate);
	$("#txtCostPrice").val(data.costPrice);
	$("#txtRetailPrice").val(data.retailPrice);
	$("#txtStocks").val(data.stocks);
	$("#txtTotalSold").val(data.totalSold);
	$("#txtHowToUse").val(data.howToUse);
	$("#chkActive").prop("checked", data.isActive == 1 ? true : false);
	$("#chkWithVideo").prop("checked", data.hasVideo == 1 ? true : false);
	$("#chkActive").prop("disabled", false);
	$("#btnGallery").prop("disabled", false);
	$("#btnUploadVideo").prop("disabled", false);
	$("#txtYT").val(data.youtubeLink);
	$("#dvReminder").show();
	$("#dvProgress").css("width","0%");
	hasVideo = data.hasVideo == 1 ? true : false;
	
	$("#aVideo").show();
	$("#aYoutube").show();
	
	$("#mdProductForm").modal("show");
});

$("#aVideo").click(function(){
	if (hasVideo) {
        window.open("../video/" + id + ".mp4", '_blank');
    } else {
		JAlert("No video uploaded","red");
	}
});

$("#aYoutube").click(function(){
	if ($("#txtYT").val().length != 0) {
        window.open($("#txtYT").val(), '_blank');
    } else {
		JAlert("No youtube link","red");
	}
});

$("#txtVideo").on("change", function () {
    const maxAllowedSize = 35 * 1024 * 1024;
   
    if(this.files[0].size > maxAllowedSize) {
        JAlert("Please upload file below 35mb","red");
        $(this).val('');
    } else {
		var file_data = $('#txtVideo').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('videoID', id);
        $.ajax({
           url: '../code/php/upload/upload_video.php',
           dataType: 'text',
           cache: false,
           contentType: false,
           processData: false,
           data: form_data,
           beforeSend: function(){
              //$("#file-progress-bar").width('0%');
              console.log(0);
              $("#dvProgress").css("width","0%");
           },
           xhr: function() {
              var xhr = new window.XMLHttpRequest();         
              xhr.upload.addEventListener("progress", function(element) {
                 if (element.lengthComputable) {
                    var percentComplete = ((element.loaded / element.total) * 100);
                    //$("#file-progress-bar").width(percentComplete + '%');
                    //$("#file-progress-bar").html(percentComplete+'%');
                    console.log(percentComplete);
                    $("#dvProgress").css("width",percentComplete + "%");
                 }
              }, false);
              return xhr;
           },
           type: 'post',
           success: function(data) {
              var data = jQuery.parseJSON(data);
              
              //JAlert(data[0].message,data[0].color);
              
              if (data[0].error) {
                $("#dvProgress").css("width","0%");
              } else {
				JAlert(data[0].message,data[0].color);
				$("#chkWithVideo").prop("checked", true);
				$("#dvProgress").css("width","0%");
				loadProducts();
				hasVideo = true;
			  }
           },
           error: function(xhr, textStatus, error){
              $("#dvProgress").css("width","0%");
             
              JAlert("Unable to upload. The file is too big","red");
           }
        });
	}
});

$("#btnUploadVideo").click(function(){
	$('#txtVideo').click();
});



$("#btnSaveItem").click(function(){
	var category = $("#cmbCategory").val();
	var subCategoryID = $("#cmbSubCategory").val();
	var packtype = $("#cmbPackType").val();
	var itemname = $("#txtItemName").val();
	var description = $("#txtDescription").val();
	var manufacturersName = $("#txtManufacturersName").val();
	var dateManufactured = $("#txtDateManufactured").val();
	var expirationDate = $("#txtExpirationDate").val();
	var costPrice = $("#txtCostPrice").val();
	var retailPrice = $("#txtRetailPrice").val();
	var stocks = $("#txtStocks").val();
	var totalSold = $("#txtTotalSold").val();
	var howToUse = $("#txtHowToUse").val();
	var fda = $("#txtFDA").val();
	var youtubeLink = $("#txtYT").val();
	var isActive = 0;
	
	if($("#chkActive").prop('checked') == true){
		isActive = 1;
	}

	$.ajax({
		url: "../code/php/web/product",
		data: {
			command : 'save_product',
			isNewProduct : isNewProduct,
			oldProductName : oldProductName,
			category : category,
			packtype : packtype,
			itemname : itemname,
			description : description,
			manufacturersName : manufacturersName,
			dateManufactured : dateManufactured,
			expirationDate : expirationDate,
			costPrice : costPrice,
			retailPrice : retailPrice,
			stocks : stocks,
			totalSold : totalSold,
			isActive : isActive,
			id : id,
			howToUse : howToUse,
			subCategoryID : subCategoryID,
			fda : fda,
			youtubeLink : youtubeLink
		},
		type: 'post',
		success: function (data) {
			var data = jQuery.parseJSON(data);
			
			JAlert(data[0].message,data[0].color);
			
			if (!data[0].error) {
				loadProducts();
				$("#mdProductForm").modal("hide");
			}
		}
	});
	
	
	if (howToUse == "" || category == null || fda == "" || subCategoryID == null || packtype == null || itemname == "" || description == "" || manufacturersName == "" || costPrice == "" || retailPrice == "" || stocks == "" || totalSold == "" || youtubeLink == "") {
		JAlert("Please fill in required fields","red");
    } else {
		
	}
});

$("#btnExportProduct").click(function(){
	$(".btn-export-products").click();
});

$('#txtSearchProduct').keyup(function(){
    tblProduct.search($(this).val()).draw();
});

function loadProducts() {
	tblProduct = 
    $('#tblProduct').DataTable({
        'destroy'       : true,
        'paging'        : true,
        'lengthChange'  : false,
        'pageLength'    : 15,
        "order"         : [],
        'info'          : true,
        'autoWidth'     : false,
        'select'        : true,
        'sDom'			: 'Btp<"clear">',
        //dom: 'Bfrtip',
        buttons: [{
            extend: "excel",
            className: "btn btn-default btn-sm hide btn-export-products",
            titleAttr: 'Export in Excel',
            text: 'Export in Excel',
            init: function(api, node, config) {
               $(node).removeClass('dt-button buttons-excel buttons-html5')
            }
        }],
        'fnRowCallback' : function( nRow, aData, iDisplayIndex ) {
            $('td', nRow).attr('nowrap','nowrap');
            return nRow;
        },
        'ajax'          : {
        	'url'       : '../code/php/web/product.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'display_product',
        	}    
        },
        'aoColumns' : [
        	{ mData: 'category'},
			{ mData: 'packtype'},
			{ mData: 'itemName'},
			{ mData: 'description'},
			{ mData: 'manufacturersName'},
			{ mData: 'dateManufactured'},
			{ mData: 'expirationDate'},
			{ mData: 'f_costPrice'},
			{ mData: 'f_retailPrice'},
			{ mData: 'f_stocks'},
			{ mData: 'f_totalSold'},
			{ mData: 'dateCreated'},
			{ mData: 'status'},
			{ mData: 'id',
				render: function (data,type,row) {
					return '<div>' + 
						   '	<button id="list_' + row.id + '" name="list_' + row.id + '" type="submit" class="btn btn-sm btn-soft-primary waves-effect waves-light">' +
						   '		<i class="fa fa-edit" style="font-size: 10px !important;"></i>' +
						   '	</button>' +
						   '</div>';
				}
			}
        ],
        'aoColumnDefs': [
        	{"className": "custom-center", "targets": [13]},
        	{"className": "dt-center", "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13]},
        	{ "width": "1%", "targets": [13] },
        //	{"className" : "hide_column", "targets": [9]} 
        ],
        "drawCallback": function() {  
            row_count = this.fnSettings().fnRecordsTotal();
        },
        //"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //	console.log(aData["status"]);
        //	
        //	if (aData["status"] == "Pending") {
        //		count_pending++;
        //	} else if (aData["status"] == "Approved") {
        //		count_approved++;
        //	} else {
        //		count_rejected++;
        //	}
        //},
        "fnInitComplete": function (oSettings, json) {
            console.log('DataTables has finished its initialisation.');
        }
    }).on('user-select', function (e, dt, type, cell, originalEvent) {
        if ($(cell.node()).parent().hasClass('selected')) {
            e.preventDefault();
        }
    });
}

/* Category */
var tblCategory;
var oldCategoryName;
var isNewCategory;
var categoryID;

function loadCategory() {
	tblCategory = 
    $('#tblCategory').DataTable({
        'destroy'       : true,
        'paging'        : true,
        'lengthChange'  : false,
        'pageLength'    : 10,
        "order"         : [],
        'info'          : true,
        'autoWidth'     : false,
        'select'        : true,
        'sDom'			: 'Btp<"clear">',
        //dom: 'Bfrtip',
        buttons: [{
            extend: "excel",
            className: "btn btn-default btn-sm hide btn-export-products",
            titleAttr: 'Export in Excel',
            text: 'Export in Excel',
            init: function(api, node, config) {
               $(node).removeClass('dt-button buttons-excel buttons-html5')
            }
        }],
        'fnRowCallback' : function( nRow, aData, iDisplayIndex ) {
            $('td', nRow).attr('nowrap','nowrap');
            return nRow;
        },
        'ajax'          : {
        	'url'       : '../code/php/web/product.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'display_category',
        	}    
        },
        'aoColumns' : [
			{ mData: 'category'},
			{ mData: 'categoryType'},
			{ mData: 'description'},
			{ mData: 'status'},
			{ mData: 'dateCreated'},
			{ mData: 'id',
				render: function (data,type,row) {
					return '<div>' + 
						   '	<button id="list_' + row.id + '" name="list_' + row.id + '" type="submit" class="btn btn-sm btn-soft-primary waves-effect waves-light">' +
						   '		<i class="fa fa-edit" style="font-size: 10px !important;"></i>' +
						   '	</button>' +
						   '</div>';
				}
			}
        ],
        'aoColumnDefs': [
        	{"className": "custom-center", "targets": [5]},
        	{"className": "dt-center", "targets": [0,1,2,3,4]},
        	{ "width": "1%", "targets": [0,2,3,4,5] },
        //	{"className" : "hide_column", "targets": [9]} 
        ],
        "drawCallback": function() {  
            row_count = this.fnSettings().fnRecordsTotal();
        },
        //"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //	console.log(aData["status"]);
        //	
        //	if (aData["status"] == "Pending") {
        //		count_pending++;
        //	} else if (aData["status"] == "Approved") {
        //		count_approved++;
        //	} else {
        //		count_rejected++;
        //	}
        //},
        "fnInitComplete": function (oSettings, json) {
            console.log('DataTables has finished its initialisation.');
        }
    }).on('user-select', function (e, dt, type, cell, originalEvent) {
        if ($(cell.node()).parent().hasClass('selected')) {
            e.preventDefault();
        }
    });
}

$('#txtSearchCategory').keyup(function(){
    tblCategory.search($(this).val()).draw();
});

$("#btnCategories").click(function(){
	$("#txtSearchCategory").val("");
	$("#mdCategory").modal("show");
	loadCategory();
});

$("#btnNewCategory").click(function(){
	oldCategoryName = "";
	isNewCategory = 1;
	categoryID = 0;
	$("#txtCategoryName").val("");
	$("#txtCategoryDescription").val("");
	$("#chkActiveCategory").prop("checked", true);
	$("#chkSubCategory").prop("checked", false);
	$("#chkActiveCategory").prop("disabled", true);
	$("#mdCategory").modal("hide");
	$("#mdCategoryAdd").modal("show");
});

$('#tblCategory tbody').on('click', 'td button', function (){
	var data = tblCategory.row( $(this).parents('tr') ).data();
	
	oldCategoryName = data.category;
	isNewCategory = 0;
	categoryID = data.id;
	$("#txtCategoryName").val(data.category);
	$("#txtCategoryDescription").val(data.description);
	$("#chkActiveCategory").prop("checked", data.isActive == 1 ? true : false);
	$("#chkSubCategory").prop("checked", data.isSub == 1 ? true : false);
	$("#chkActiveCategory").prop("disabled", false);
	$("#mdCategory").modal("hide");
	$("#mdCategoryAdd").modal("show");
});

$("#btnSaveCategory").click(function(){
	var category = $("#txtCategoryName").val();
	var description = $("#txtCategoryDescription").val();
	var isActive = 0;
	var isActiveSub = 0;
	
	if($("#chkActiveCategory").prop('checked') == true){
		isActive = 1;
	}
	
	if($("#chkSubCategory").prop('checked') == true){
		isActiveSub = 1;
	}
	
	if (category == "" || description == "") {
		JAlert("Please fill in required fields","red");
    } else {
		$.ajax({
            url: "../code/php/web/product",
            data: {
                command : 'save_category',
				isNewCategory : isNewCategory,
				oldCategoryName : oldCategoryName,
				isActive : isActive,
				category : category,
				categoryID : categoryID,
				description : description,
				isActiveSub : isActiveSub
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                JAlert(data[0].message,data[0].color);
                
                if (!data[0].error) {
					$("#mdCategoryAdd").modal("hide");
                }
            }
        });
	}
});

/* Pack Type */
var tblPackType;
var oldPackTypeName;
var isNewPackType;
var packTypeID;

$("#btnPackType").click(function(){
	$("#txtSearchPackType").val("");
	$("#mdPackType").modal("show");
	loadPackType();
});

function loadPackType() {
	tblPackType = 
    $('#tblPackType').DataTable({
        'destroy'       : true,
        'paging'        : true,
        'lengthChange'  : false,
        'pageLength'    : 15,
        "order"         : [],
        'info'          : true,
        'autoWidth'     : false,
        'select'        : true,
        'sDom'			: 'Btp<"clear">',
        //dom: 'Bfrtip',
        buttons: [{
            extend: "excel",
            className: "btn btn-default btn-sm hide btn-export-products",
            titleAttr: 'Export in Excel',
            text: 'Export in Excel',
            init: function(api, node, config) {
               $(node).removeClass('dt-button buttons-excel buttons-html5')
            }
        }],
        'fnRowCallback' : function( nRow, aData, iDisplayIndex ) {
            $('td', nRow).attr('nowrap','nowrap');
            return nRow;
        },
        'ajax'          : {
        	'url'       : '../code/php/web/product.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'display_packtype',
        	}    
        },
        'aoColumns' : [
			{ mData: 'packtype'},
			{ mData: 'status'},
			{ mData: 'dateCreated'},
			{ mData: 'id',
				render: function (data,type,row) {
					return '<div>' + 
						   '	<button id="list_' + row.id + '" name="list_' + row.id + '" type="submit" class="btn btn-sm btn-soft-primary waves-effect waves-light">' +
						   '		<i class="fa fa-edit" style="font-size: 10px !important;"></i>' +
						   '	</button>' +
						   '</div>';
				}
			}
        ],
        'aoColumnDefs': [
        	{"className": "custom-center", "targets": [3]},
        	{"className": "dt-center", "targets": [0,1,2]},
        	{ "width": "1%", "targets": [1,2,3] },
        //	{"className" : "hide_column", "targets": [9]} 
        ],
        "drawCallback": function() {  
            row_count = this.fnSettings().fnRecordsTotal();
        },
        //"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //	console.log(aData["status"]);
        //	
        //	if (aData["status"] == "Pending") {
        //		count_pending++;
        //	} else if (aData["status"] == "Approved") {
        //		count_approved++;
        //	} else {
        //		count_rejected++;
        //	}
        //},
        "fnInitComplete": function (oSettings, json) {
            console.log('DataTables has finished its initialisation.');
        }
    }).on('user-select', function (e, dt, type, cell, originalEvent) {
        if ($(cell.node()).parent().hasClass('selected')) {
            e.preventDefault();
        }
    });
}

$("#btnNewPackType").click(function(){
	oldPackTypeName = "";
	isNewPackType = 1;
	packTypeID = 0;
	$("#txtPackTypeName").val("");
	$("#chkActivePackType").prop("checked", true);
	$("#chkActivePackType").prop("disabled", true);
	$("#mdPackType").modal("hide");
	$("#mdPackTypeAdd").modal("show");
});

$('#tblPackType tbody').on('click', 'td button', function (){
	var data = tblPackType.row( $(this).parents('tr') ).data();
	
	oldPackTypeName = data.packtype;
	isNewPackType = 0;
	packTypeID = data.id;
	$("#txtPackTypeName").val(data.packtype);
	$("#chkActivePackType").prop("checked", data.isActive == 1 ? true : false);
	$("#chkActivePackType").prop("disabled", false);
	$("#mdPackType").modal("hide");
	$("#mdPackTypeAdd").modal("show");
});

$("#btnSavePackType").click(function(){
	var packType = $("#txtPackTypeName").val();
	var isActive = 0;
	
	if($("#chkActivePackType").prop('checked') == true){
		isActive = 1;
	}
	
	if (packType == "") {
		JAlert("Please fill in required fields","red");
    } else {
		$.ajax({
            url: "../code/php/web/product",
            data: {
                command : 'save_packtype',
				isNewPackType : isNewPackType,
				oldPackTypeName : oldPackTypeName,
				isActive : isActive,
				packType : packType,
				packTypeID : packTypeID
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                JAlert(data[0].message,data[0].color);
                
                if (!data[0].error) {
					$("#mdPackTypeAdd").modal("hide");
                }
            }
        });
	}
});


$("#btnGallery").click(function(){
	$("#mdProductForm").modal("hide");
	$("#mdGallery").modal("show");
	
	loadImage();
});

function openImage() {
    javascript:document.getElementById('image_uploader').click();
}

$('#image_uploader').change(function (e) {
	var file_data = $('#image_uploader').prop('files')[0];
	var form_data = new FormData();
    form_data.append('file', file_data);
	form_data.append('productID', id);
	$.ajax({
	    url: '../code/php/web/upload_photo',
	    dataType: 'text',
	    cache: false,
	    contentType: false,
	    processData: false,
	    data: form_data,
	    type: 'post',
	    success: function(data) {
            var data = jQuery.parseJSON(data);
                
            JAlert(data[0].message,data[0].color);
            
            if (!data[0].error) {
                loadImage();
            }
            
            //location.reload();
        }
	});
});


function loadImage() {
    $("#dvImages").show();
    
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command   : 'display_image',
            id : id
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            
            $('#dvImages').html("");
            
            for (var i = 0; i < data.length; i++) {
                $('#dvImages').append("" +
                                      
                    '<div class="col-xl-3 col-sm-6">'+
					'	<br>'+
					'	<div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">'+
					'		<div class="toast-header">'+
					'			<img src="assets/images/logo-sm.svg" alt="" class="me-2" height="18">'+
					'			<strong class="me-auto">  </strong>'+
					'			<button type="button" class="btn-close" aria-label="Close" onclick="deleteImage('+ data[i].id +')"></button>'+
					'		</div>'+
					'		<div class="toast-body">'+
					'			<img src="../assets/product/product-' + data[i].fileName + '.jpg" alt="" class="rounded me-2" style="width: 100%; height: 150px; max-height: 150px; object-fit: contain;">'+
					'		</div>'+
					'	</div>'+
					'</div>'
                                          
                );
            }
        }
    });
}

function deleteImage(id) {
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command  : 'delete_image',
            id : id
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            
            if (!data[0].error) {
                loadImage();
            }
        }
    });
}
