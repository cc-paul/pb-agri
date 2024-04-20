var tblAccount;
var currentID;
var sellersName;
var sellersEmail;

loadAccount();

function loadAccount() {
    tblAccount = 
    $('#tblAccount').DataTable({
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
            className: "btn btn-default btn-sm hide btn-export-user",
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
        	'url'       : '../code/php/web/sellers.php',
        	'type'      : 'POST',
        	'data'      : {
        		command : 'display_account',
        	}    
        },
        'aoColumns' : [
        	{ mData: 'username'},
            { mData: 'firstName'},
            { mData: 'middleName'},
            { mData: 'lastName'},
            { mData: 'emailAddress'},
            //{ mData: 'mobileNumber'},
            //{ mData: 'currentAddress'},
            { mData: 'isActive'},
            { mData: 'status'},
            { mData: 'position'},
            { mData: 'dateCreated'}
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

$("#btnExportUser").click(function(){
	$(".btn-export-user").click();
});

$('#txtSearchUser').keyup(function(){
    tblAccount.search($(this).val()).draw();
});

$('#tblAccount tbody').on('click', 'td', function (){
	var data = tblAccount.row( $(this).parents('tr') ).data();
    currentID = data.id;
    sellersName = data.firstName + " " + data.lastName;
    sellersEmail = data.emailAddress;
	
	$("#txtUsername").val(data.username);
    $("#txtFirstName").val(data.firstName);
    $("#txtMiddleName").val(data.middleName);
    $("#txtLastName").val(data.lastName);
    $("#txtEmailAddress").val(data.emailAddress);
    $("#txtMobileNumber").val(data.mobileNumber);
    $("#txtAddress").val(data.currentAddress);
    $("#cmbPosition").val(data.position);
    
    $("#cmbPosition").prop("disabled", false);
    $("#btnApprove").prop("disabled", false);
    $("#btnReject").prop("disabled", false); 
});

$("#btnApprove").click(function(){
	setApproval("Approved");
});

$("#btnReject").click(function(){
	setApproval("Banned");
});

function setApproval(status) {
    $.ajax({
        url: "../code/php/web/sellers.php",
        data: {
            command : 'set_approval',
            position : $("#cmbPosition").val(),
            status : status,
            id : currentID,
            sellersName : sellersName,
            sellersEmail : sellersEmail
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            
            JAlert(data[0].message,data[0].color);
            
            if (!data[0].error) {
                loadAccount();
                $("#txtUsername").val(null);
                $("#txtFirstName").val(null);
                $("#txtMiddleName").val(null);
                $("#txtLastName").val(null);
                $("#txtEmailAddress").val(null);
                $("#txtMobileNumber").val(null);
                $("#txtAddress").val(null);
                $("#cmbPosition").val(null);
                
                $("#cmbPosition").prop("disabled", true);
                $("#btnApprove").prop("disabled", true);
                $("#btnReject").prop("disabled", true); 
            }
        }
    });
}