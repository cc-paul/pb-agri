var currentItemID;
var arrCheckOutItems = [];
var currentItemName = "";
var currentDescription = "";
var currentHowToUse = "";
var current_youtubeLink = "";
var current_hasVideo = 0;
var currentItemID = 0;

$("#btnContactSeller").click(function(){
    $.ajax({
        url: "../code/php/web/message",
        data: {
            command : 'startup_message',
            itemID  : currentItemID,
            message_sent : "Hello! May I know the details about " + $("#spProductName").text()
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            data = data[0];
            
            if (!data.error) {
                window.location.href = "message";
            }
        }
    });
});

loadCart('');

$('#txtItemSearch').keyup(function(){
    loadCart($(this).val());
});

function getDetails(id) {
    currentItemID = id;
    
    //alert(id);
    
    //console.log($("#aReadMore" + id).attr("data-how"));
    
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command : 'item_details',
            id : id
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            $("#spCategory").html(data[0].category);
            $("#spProductName").html(data[0].itemName);
            $("#spManufacturer").html(data[0].manufacturersName);
            $("#spManufacturingDate").html(data[0].dateManufactured);
            $("#spExpirationDate").html(data[0].expirationDate);
            $("#spRetailPrice").html(data[0].retailPrice);
            $("#spFDA").html(data[0].fda);
            $("#spStocks").html(data[0].stocks);
            $("#spDescription").html(data[0].description);
            $("#imgProduct").attr("src","../assets/product/product-" + data[0].image + ".jpg");
            
            currentItemName = data[0].itemName;
            currentDescription = data[0].description
            currentHowToUse = data[0].howToUse;
            current_youtubeLink = data[0].youtubeLink;
            current_hasVideo = data[0].hasVideo;
            
            currentItemID = id;
            
            $("#mdItemDetails").modal("show");
        }
    });
}

$("#aVideo1").click(function(){
	if (current_hasVideo == 1) {
        window.open("../video/" + currentItemID + ".mp4", '_blank');
    } else {
		JAlert("No video uploaded","red");
	}
});

$("#aYoutube1").click(function(){

	if (current_youtubeLink != 0) {
        window.open(current_youtubeLink, '_blank');
    } else {
		JAlert("No youtube link","red");
	}
});

function getReview(id) {
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command   : 'show_review',
            itemID : id
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            
            $("#dvReviewArea").html("");
            var comments = "";
            
            for (var i = 0; i < data.length; i++) {
                var stars = "";
                
                for (var a = 0; a < Number(data[i].rate); a++) {
                    stars += '<i class="bx bx-star label-icon"></i>';
                }
                
                
                comments += `
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="own-font">
                                <b>Name :</b>
                                <span class="own-font">` + data[i].fullName + `</span>
                                <br>
                                <b>Date :</b>
                                <span class="own-font">` + data[i].dateCreated + `</span>
                                <br>
                                <b>Review :</b>
                                <span class="own-font">` + data[i].feedBack + `</span>
                                <br>
                                <b>Rate :</b>
                                
                                `+ stars +`
                            </div>
                        </div>
                    </div>
                    <br>
                `;
                
            }
            
            $("#dvReviewArea").html(comments);
        }
    });
    
    $("#mdReview").modal("show");
}



$("#btnInfo").click(function(){
	$("#mdItemDetails").modal("hide");
    $("#btnOpenChatBot").click();
    $("#dvChatFooter").hide();
    
    currentHowToUse === "null" ? 'No Instructions added' : currentHowToUse;
    
    $("#dvChatArea").append(`
        <div class="row" style="padding-right: 7px;">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="alert alert-primary own-font" role="alert" style="margin-left: 10px; padding: 0.25rem 1.25rem;">
                    <b>Agri Merchants:</b>
                    <br>
                    <br>
                    <b>Product Name : </b> ` + currentItemName + `
                    <br>
                    <b>Description : </b> ` + currentDescription + `
                    <br>
                    <b>How To Use : </b> ` + currentHowToUse + `
                    <br>
                    <br>
                    <br>
                    <span>
                        <b style="font-size:8px">Sent at :` + new Date().toLocaleString() + `</b>
                    </span>
                </div>
            </div>
        </div>
    `);
    
    $("#dvChatArea").scrollTop($("#dvChatArea")[0].scrollHeight);
});

$("#aKnowMore").click(function(){
    $("#mdItemDetails").modal("hide");
    $("#btnOpenChatBot").click();
    $("#dvChatFooter").hide();
    
    currentHowToUse === "null" ? 'No Instructions added' : currentHowToUse;
    
    $("#dvChatArea").append(`
        <div class="row" style="padding-right: 7px;">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="alert alert-primary own-font" role="alert" style="margin-left: 10px; padding: 0.25rem 1.25rem;">
                    <b>Agri Merchants:</b>
                    <br>
                    <br>
                    <b>Product Name : </b> ` + currentItemName + `
                    <br>
                    <b>Description : </b> ` + currentDescription + `
                    <br>
                    <b>How To Use : </b> ` + currentHowToUse + `
                    <br>
                    <br>
                    <br>
                    <span>
                        <b style="font-size:8px">Sent at :` + new Date().toLocaleString() + `</b>
                    </span>
                </div>
            </div>
        </div>
    `);
    
    $("#dvChatArea").scrollTop($("#dvChatArea")[0].scrollHeight);
});

function loadCart(productName) {
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command : 'cart_items',
            itemName : productName
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            
            $("#dvCart").html("");
            var items = "";
            
            for (var i = 0; i < data.length; i++) {
                items += '' +
                '<div class="col-md-12 col-sm-12 col-xs-12">' +
                '    <div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab" role="tablist" aria-orientation="vertical">' +
                '        <a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill" href="#v-price-one" role="tab" aria-controls="v-price-one" aria-selected="true">' +
                '            <div class="row">' +
                '                <div class="col-md-12">' +
                '                    <div class="d-flex align-items-center">' +
                '                        <img class="img-thumbnail" alt="200x200" width="100" src="../assets/product/product-' + data[i].image + '.jpg" data-holder-rendered="true">' +
                '                        &nbsp;&nbsp;&nbsp;&nbsp;' +
                '                        <div class="flex-1">' +	
                '                            <h2 class="text-muted font-size-12">P' + data[i].retailPrice + '<span class="text-muted font-size-12">/ ' + data[i].itemName + '</span></h2>' +
                '                            <p class="fw-normal mb-0 text-muted font-size-12">Agri-Merchants</p>' +
                '                        </div>' +
                '                    </div>' +
                '                </div>' +
                '            </div>' +
                '            <br>' +
                '            <div class="row">' +
                '                <div class="col-md-6 col-xs-12">' +
                '                    <button type="button" class="btn btn-sm btn-primary waves-effect btn-label waves-light" style="width:100%" onclick="checkOut(' + data[i].itemID + ',' + data[i].retailPrice.replace(",","") + ',' + "'" + data[i].itemName + "'" +  ',' + "'" + data[i].image + "'" + ')"><i class="bx bx-check label-icon" style="color:#ffffff"></i> Checkout</button>' +
                '                </div>' +
                '                <div class="col-md-6 col-xs-12">' +
                '                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-label waves-light" style="width:100%" onclick="removeItem(' + data[i].id + ')"><i class="bx bx-trash label-icon" style="color:#ffffff"></i> Remove</button>' +
                '                </div>' +
                '            </div>' +
                '        </a>' +
                '    </div>' +
                '</div>';
            }
            
            $("#dvCart").html(items);
        }
    });
}

$("#btnAddtoCart").click(function(){
	$.ajax({
        url: "../code/php/web/product",
        data: {
            command : 'add_to_cart',
            id : currentItemID
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
           
            if (data[0].error) {
                JAlert(data[0].message,"red");
            } else {
                JAlert(data[0].message,"green");
                $("#mdItemDetails").modal("hide");   
            }
        }
    });
});

function checkOut(id,retailPrice,itemName,image) {
    var isItemExist = false;
    
    console.log(image);
    
    for (var i = 0; i < arrCheckOutItems.length; i++) {
        if (arrCheckOutItems[i].id == id) {
            isItemExist = true;
            break;
        }
    }
    
    if (isItemExist) {
        JAlert("Item already added to checkout","red");
    } else {
        arrCheckOutItems.push({
            id : id,
            retailPrice : retailPrice,
            itemName : itemName,
            image : image,
            qty : 1
        });
        
        $('#dvCheckOut').append('' + 
            '<div id="dv'+ id +'" class="col-md-6 col-sm-12 col-xs-12">' +
            '    <div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab" role="tablist" aria-orientation="vertical">' +
            '        <a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill" href="#v-price-one" role="tab" aria-controls="v-price-one" aria-selected="true">' +
            '            <div class="d-flex align-items-center">' +
            '                <img class="img-thumbnail" alt="200x200" width="100" src="../assets/product/product-'+ image +'.jpg" data-holder-rendered="true">' +
            '                &nbsp;&nbsp;&nbsp;&nbsp;' +
            '                <div class="flex-1">' +
            '                    <div class="row w1">' +
            '                        <div class="col-md-12">' +
            '                           <h2 class="fw-medium w2">P' + getMe2DecimalPointsWithCommas(retailPrice).replace(".00","") + '<span class="text-muted font-size-12" title="' + itemName + '">/ ' + itemName + '</span></h2>' +                            
            '                        </div>' +
            '                     </div>' +
            '                    <div class="row">' +
            '                        <div class="col-md-3 col-xs-12">' +
            '                            <button onclick="quantity('+ id +',true)" type="button" class="btn btn-sm btn-primary waves-effect waves-light">' +
            '                                <i class="bx bx-plus font-size-16 align-middle" style="color:#ffffff"></i>' +
            '                            </button>' +
            '                        </div>' +
            '                        <div class="col-md-3 col-xs-12" style="height:100%">' +
            '                            <center>' +
            '                                <h4 class="mb-3">' +
            '                                    <span id="sp' + id+ '" class="counter-value">1</span>' +
            '                                </h4>' +
            '                            </center>' +
            '                        </div>' +
            '                        <div class="col-md-3 col-xs-12">' +
            '                            <button onclick="quantity('+ id +',false)" type="button" class="btn btn-sm btn-primary waves-effect waves-light">' +
            '                                <i class="bx bx-minus font-size-16 align-middle" style="color:#ffffff"></i>' +
            '                            </button>' +
            '                        </div>' +
            '                        <div class="col-md-3 col-xs-12">' +
            '                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="deleteCheckOutItem(' + id + ')">' +
            '                                <i class="bx bx-trash font-size-16 align-middle" style="color:#ffffff"></i>' +
            '                            </button>' +
            '                        </div>' +
            '                    </div>' +
            '                </div>' +
            '            </div>' +
            '        </a>' +
            '    </div>' +
            '</div>' +                            
        '');
    }
    
    console.log(arrCheckOutItems);
}

function getMe2DecimalPointsWithCommas(amount) {
    return Number(amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function deleteCheckOutItem(id) {
    $("#dv" + id).remove();
    
    arrCheckOutItems = arrCheckOutItems.filter(function(item) { 
		return item.id !== id; 
	});
}

function quantity(id,isAdd) {
    var currentQty = Number($("#sp" + id).text());
    
    if (isAdd) {
        currentQty += 1;
    } else {
        if (currentQty != 1) {
            currentQty -= 1;
        }
    }
    
    $.each(arrCheckOutItems, function() {
        if (this.id == id) {
            this.qty = currentQty;
        }
    });
    
    console.log(arrCheckOutItems);
    $("#sp" + id).text(currentQty);
}

setInterval(function() {
    var total = 0;
    
    for (var i = 0; i < arrCheckOutItems.length; i++) {
        var currentTotal = Number(arrCheckOutItems[i].retailPrice) * Number(arrCheckOutItems[i].qty);
        total += currentTotal;
    }
    
    $("#spTotalAmount").html(getMe2DecimalPointsWithCommas(total).replace(".00",""));
    
    $("#spTotalItem").html(arrCheckOutItems.length);
}, 1000);

$("#btnCompletePurchase").click(function(){
	var totalItem = arrCheckOutItems.length;
    var refNumber = Random();
    var arrQryItems  = [];
    var arrItemIDs = [];
    
    if (totalItem == 0) {
        JAlert("Please add at least 1 item","red");
    } else {
        for (var i = 0; i < arrCheckOutItems.length; i++) {
            var data = arrCheckOutItems[i];
            arrQryItems.push("('" + refNumber + "','" + data.id + "','" + data.retailPrice + "','" + data.qty + "')");
            arrItemIDs.push(data.qty + "~" + data.id);
        }
        
        $.ajax({
            url: "../code/php/web/product.php",
            data: {
                command   : 'checkout',
                refNumber : refNumber,
                items : arrQryItems.join(","),
                ids : arrItemIDs.join(",")
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                if (data[0].error) {
                    JAlert(data[0].message,"red");
                } else {
                    JAlert(data[0].message,"green");
                    arrCheckOutItems = [];
                    $("#dvCheckOut").html("");
                }
            }
        });
    }
});

var tblRef;
var tblRefItems;

$("#btnPurchaseList").click(function(){
	$("#mdRegistration").modal();
    loadRef();
    loadRefItem('');
    $("#spTotalAmount2").html(0);
    $("#spTotalItem2").html(0);
});

$('#tblRef tbody').on('click', 'td', function (){
	var data = tblRef.row(this).data();
    
    $("#spTotalAmount2").html(data.totalAmount);
    $("#spTotalItem2").html(data.totalItems);
    loadRefItem(data.refNumber);
});

function loadRef() {
    tblRef = 
    $('#tblRef').DataTable({
        'destroy'       : true,
        'paging'        : false,
        'lengthChange'  : false,
        'pageLength'    : 10000,
        "order"         : [],
        'info'          : true,
        'autoWidth'     : false,
        'select'        : true,
        'sDom'			: 'tp<"clear">', 
        'fnRowCallback' : function( nRow, aData, iDisplayIndex ) {
            $('td', nRow).attr('nowrap','nowrap');
            return nRow;
        },
        'ajax'          : {
        	'url'       : '../code/php/web/product.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'checkout_ref'
        	}    
        },
        'aoColumns' : [
        	{ mData: 'refNumber'},
        ],
        //'aoColumnDefs': [
        //	{"className": "custom-center", "targets": [8]},
        //	{"className": "dt-center", "targets": [0,1,2,3,4,5,6,7]},
        //	{ "width": "1%", "targets": [8] },
        //	{"className" : "hide_column", "targets": [9]} 
        //],
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


function loadRefItem(refNumber) {
    tblRefItems = 
    $('#tblRefItems').DataTable({
        'destroy'       : true,
        'paging'        : false,
        'lengthChange'  : false,
        'pageLength'    : 10000,
        "order"         : [],
        'info'          : true,
        'autoWidth'     : false,
        'select'        : true,
        'sDom'			: 'tp<"clear">', 
        'fnRowCallback' : function( nRow, aData, iDisplayIndex ) {
            $('td', nRow).attr('nowrap','nowrap');
            return nRow;
        },
        'ajax'          : {
        	'url'       : '../code/php/web/product.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'checkout_ref_item',
                refNumber : refNumber
        	}    
        },
        'aoColumns' : [
        	{ mData: 'itemName'},
            { mData: 'retailPrice'},
            { mData: 'qty'},
            { mData: 'total'},
            { mData: 'seller'},
            { mData: 'status'},
            { mData: 'deliveryDate'},
            { mData: 'id',
                render: function (data,type,row) {
                    var disable = "";
                    
                    
                    
                    if (row.status != "Delivered") {
                        disable = "disabled";
                    }
                    
                    return `
                        <button type="submit" class="btn btn-sm btn-soft-primary waves-effect waves-light" `+ disable +`>		<i class="fa fa-edit" style="font-size: 10px !important;"></i>	</button>
                    `;
                }
            }
        ],
        'aoColumnDefs': [
            {"className": "custom-center", "targets": [7]},
        	{"className": "dt-center", "targets": [0,1,2,3,4,5,6]},
        	{ "width": "1%", "targets": [7] }
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

var feedBackItemID;

$('#tblRefItems tbody').on('click', 'td button', function (){
	var data = tblRefItems.row( $(this).parents('tr') ).data();
    
    $("#txtItemNameRev").val(data.itemName);
    $("#txtDescriptionRev").val(data.description);
    
    feedBackItemID = data.id;
    
    $("#mdReview").modal();
    $("#mdRegistration").modal("hide");
    $("#txtItemNameRate").val("");
    $("#txtFeedBack").val("");
});

$("#txtItemNameRate").bind('keyup mouseup', function () {
    var rate = $("#txtItemNameRate").val();
    
    if (rate == 0) {
        $("#txtItemNameRate").val("");
    }
});

$("#btnSendFeedback").click(function(){
    var rate     = $("#txtItemNameRate").val();
    var feedBack = $("#txtFeedBack").val();
    
    if (rate == "" || feedBack == "") {
        JAlert("Please fill in required fields","red");
    } else if (rate < 1 || rate > 5) {
        JAlert("Please provide a rate of 1~5","red");
    } else {
        $.ajax({
            url: "../code/php/web/product",
            data: {
                command : 'send_feedback',
                itemId : feedBackItemID,
                rate : rate,
                feedBack : feedBack
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                JAlert(data[0].message,data[0].color);
                
                if (!data[0].error) {
                    $("#mdReview").modal("hide");
                }
            }
        });
    }
});

function Random() {
  return Math.floor(Math.random() * 1000000000);
}

function removeItem(id) {
    $.ajax({
        url: "../code/php/web/product",
        data: {
            command : 'remove_to_cart',
            id : id
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
           
            if (data[0].error) {
                JAlert(data[0].message,"red");
            } else {
                JAlert(data[0].message,"green");
                loadCart($("#txtItemSearch").val());
            }
        }
    });
}

function full_view(ele){
    let src=ele.parentElement.querySelector(".my-image").getAttribute("src");
    document.querySelector("#img-viewer").querySelector("img").setAttribute("src",src);
    document.querySelector("#img-viewer").style.display="block";
}
			
function close_model(){
    document.querySelector("#img-viewer").style.display="none";
}