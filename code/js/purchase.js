var tblRef;
var tblRefItems;
var totalItems = 0;
var totalAmount = 0;
var currentID = 0;
var currentRef = "";

loadRef();
loadRefItem('');
$("#spTotalAmount2").html(0);
$("#spTotalItem2").html(0);

$('#tblRef tbody').on('click', 'td', function (){
	var data = tblRef.row(this).data();
    
    
    $("#spName").html(data.buyer);
    $("#spEmail").html(data.emailAddress);
    $("#spMobileNumber").html(data.mobileNumber);
    $("#spAddress").html(data.currentAddress);
    
    totalItems = 0;
    totalAmount = 0;
	currentRef = data.refNumber;
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
        		command : 'checkout_ref_sell'
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
        		command : 'checkout_ref_item_sell',
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
					return '<div>' + 
						   '	<button id="list_' + row.id + '" name="list_' + row.id + '" type="submit" class="btn btn-sm btn-soft-primary waves-effect waves-light">' +
						   '		<i class="fa fa-edit" style="font-size: 10px !important;"></i>' +
						   '	</button>' +
						   '</div>';
				}
			}
        ],
        'aoColumnDefs': [
        	{"className": "custom-center", "targets": [7]},
        	{"className": "dt-center", "targets": [0,1,2,3,4,5,6]},
        	{ "width": "1%", "targets": [7] },
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
            tblRefItems.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                var data = this.data();
                console.log(data);
                
                totalItems++;
                totalAmount += Number(data.total.replace(",",""));
            });
            
            
            $("#spTotalAmount2").html(getMe2DecimalPointsWithCommas(totalAmount).replace(".00",""));
            $("#spTotalItem2").html(totalItems);
        }
    }).on('user-select', function (e, dt, type, cell, originalEvent) {
        if ($(cell.node()).parent().hasClass('selected')) {
            e.preventDefault();
        }
    });
}

function getMe2DecimalPointsWithCommas(amount) {
    return Number(amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

$('#tblRefItems tbody').on('click', 'td button', function (){
	var data = tblRefItems.row( $(this).parents('tr') ).data();
	
	currentID = data.id;

	if (data.status == "For Delivery") {
		$("#txtDeliveryDate").prop("disabled", false);
	} else if (data.status == "Delivered") {
		$("#txtDeliveryDate").prop("disabled", false);
    } else {
		$("#txtDeliveryDate").prop("disabled", true);
	}
	
	$("#cmbStatus").val(data.status);
	$("#txtDeliveryDate").val(data.unfDeliveryDate);
	$("#mdUpdateDate").modal('show');
});

$("#cmbStatus").on("change", function() {
    var value = $(this).val();
    var text  = $("#cmbStatus").find("option:selected").text();
	
	$("#txtDeliveryDate").val("");
	
	if (text == "For Delivery") {
		$("#txtDeliveryDate").prop("disabled", false);
	} else if (text == "Delivered") {
		$("#txtDeliveryDate").prop("disabled", false);
    } else {
		$("#txtDeliveryDate").prop("disabled", true);
	}
});


$("#btnSaveOptions").click(function(){
	var status         = $("#cmbStatus").val();
	var date           = $("#txtDeliveryDate").val();
	var isDateDisabled = document.getElementById('txtDeliveryDate');
	
	if (status == null) {
		JAlert("Please select status","red");
		return;
	}
	
	if (!isDateDisabled.disabled && date == "") {
		JAlert("Please provide date","red");
		return;
    }
	
	$.ajax({
		url: '../code/php/web/product.php',
		data: {
			command : 'update_delivery',
			id      : currentID,
			status  : status,
			date    : date
		},
		type: 'post',
		success: function (data) {
			var data = jQuery.parseJSON(data);
			
			JAlert(data[0].message,data[0].color);
			
			if (!data[0].error) {
				loadRefItem(currentRef);
				$("#mdUpdateDate").modal('hide');
            }
		}
	});
});

function sendMessageToSeller(sellerID) {
	$.confirm({
		title: 'Inquiry Message',
		content: '' +
		'<form action="" class="formName">' +
		'<div class="form-group">' +
		'<textarea rows="4" cols="50" class="report form-control" placeholder="Please explain the reason of why the user has been reported."></textarea>' +
		'</div>' +
		'</form>',
		buttons: {
			formSubmit: {
				text: 'Submit',
				btnClass: 'btn-blue',
				action: function () {
					var report = this.$content.find('.report').val();
					if(!report){
						$.alert('provide a valid report');
						return false;
					}
					
					$.ajax({
						url: "../code/php/web/message",
						data: {
							command : 'message_reported_user',
							sellerID  : sellerID,
							message : report
						},
						type: 'post',
						success: function (data) {
							var data = jQuery.parseJSON(data);
							data = data[0];
							
							if (!data.error) {
								window.location.href = "messages";
							}
						}
					});
				}
			},
			cancel: function () {
				//close
			},
		},
		onContentReady: function () {
			// bind to events
			var jc = this;
			this.$content.find('form').on('submit', function (e) {
				// if the user submits the form by pressing enter in the field.
				e.preventDefault();
				jc.$$formSubmit.trigger('click'); // reference the button and click it
			});
		}
	});
}