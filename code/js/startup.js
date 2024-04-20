$(document).ready(function(){
    try {
        var linkID = 'amenu-' + location.href.split("/").pop().split("?").shift();
    
        $("#headerTitle").text($("#" + linkID).attr('data-details'));
        $("#liHeaderTitle").text($("#" + linkID).attr('data-header'));
        $("#liDetailTitle").text($("#" + linkID).attr('data-details'));
        $("#pDesc").text($("#" + linkID).attr('data-description'));
    } catch(e) {
        console.log(e);
    }
});

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

function numOnly(selector){
    selector.value = selector.value.replace(/[^0-9]/g,'');
}

function JConfirm (message,confirmCallback, cancelCallback) {
	var [c_message,c_color] = message.split('-');
	var default_color;
	
	if (c_color == null) {
		default_color = "orange";
	} else {
		default_color = c_color;
	}
	
	$.confirm({
		title    : 'System Message',
		content  : c_message,
		type     : default_color,
		icon     : 'fa fa-question-circle',
		backgroundDismiss : false,
		backgroundDismissAnimation : 'glow',
		buttons: {
			confirm: confirmCallback,
			cancel: cancelCallback
		}
	});
}

function JAlert (message,type,confirmCallback) {
	$.alert({
		title    : 'System Message',
		content  : message,
		type     : type,
		icon     : 'fa fa-warning',
		backgroundDismiss : false,
		backgroundDismissAnimation : 'glow'
	});
}