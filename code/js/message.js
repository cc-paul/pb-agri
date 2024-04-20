var selectedChatID;
var firstID;
var mode = $("#spFrom").text().trim();
var currentChatmateID;
var rChatID;
var rFullName;
var rInitial;
var rChatmateID;
var rCountUnread = 0;
var refID;
var isImageAdded;

console.log(mode);


function openReportModal() {
  $("#mdReport").modal("show");
  refID = (new Date()).getTime();
  $('#imgReport').attr('src', 'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg');
  isImageAdded = 0;
  $("#txtReportMessage").val("");
}

function openImage() {
    javascript:document.getElementById('image_uploader').click();
}

$("#btnSendReport").click(function(){
  var message = $("#txtReportMessage").val();
  
  if (message == "" || isImageAdded == 0) {
    JAlert("Please tell us the reason and also provide an image","red");
  } else {
    $.ajax({
        url: "../code/php/web/message",
        data: {
            command        : 'rerpot_user',
            userIDreported : rChatmateID,
            message        : message,
            ref            : refID
        },
        type: 'post',
        success: function (data) {
          var data = jQuery.parseJSON(data);
          
          JAlert(data[0].message,data[0].color);
              
          if (!data[0].error) {
            $("#mdReport").modal("hide");
          }
        }
    });
  }
});

$('#image_uploader').change(function (e) {
    var file_data = $('#image_uploader').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('productID', refID);
    $.ajax({
        url: '../code/php/web/upload_photo_product',
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
                  //loadImage();
                  isImageAdded = 1;
                  $('#imgReport').attr('src', '../assets/product/product-' + refID +  ".jpg");
              }
              
              //location.reload();
          }
    });
});

$(document).ready(function(){
    generateChatbox('');
    
    setTimeout(function() {
      if (firstID != 0) {
        $("#row" + firstID).click();
      }
    }, 200);
});

$('#txtSearchChat').on('input',function(e){
  generateChatbox($("#txtSearchChat").val());
});


function generateChatbox(name) {
    $("#ulSenderHolder").html('');
    
    $.ajax({
        url: "../code/php/web/message",
        data: {
            command  : 'chatbox_' + mode,
            name     : name 
        },
        type: 'post',
        success: function (data) {
            var data = jQuery.parseJSON(data);
            firstID = 0;
            
            for (var i = 0; i < data.length; i++) {
                
                if (firstID == 0) {
                  firstID = data[i].id;
                }
                
                var ago = time_ago(data[i].lastMessageDate);
                var unread = data[i].countUnread == 0 ? '' : '<span id="notif-row' + data[i].id + '" class="badge bg-danger rounded-pill">' + data[i].countUnread + '</span>';
                
                var element = `
                    <li id="row` + data[i].id + `" class="row-chat" onClick="setmeAsActive(`+ data[i].id +`,'` + data[i].fullName + `','` + data[i].initial + `',`+ data[i].chatmateID +`,` + data[i].countUnread + `)">
                        <a href="#">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            `+ data[i].initial +`
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-14 mb-1">` + data[i].fullName + `</h5>
                                    <p id="pRow` + data[i].id + `" class="text-truncate mb-0">` + data[i].lastMessage + `</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="dvTimRow` + data[i].id + `" class="font-size-11">` + ago + `</div>
                                </div>
                                <div id="dvUnread` + data[i].id + `" class="unread-message">
                                    `
                                        + unread +
                                    `
                                </div>
                            </div>
                        </a>
                    </li>
                `;
                
                $("#ulSenderHolder").append(element);
            }
        }
    });
}

setInterval(function() {
    setmeAsActive_1(rChatID,rFullName,rInitial,rChatmateID,rCountUnread);
}, 2000);

function setmeAsActive_1(id,fullName,initial,chatmateID,countUnread) {
  $('.row-chat').removeClass('active');
  $("#row" + id).addClass("active");
  
  rChatID = id;
  rFullName = fullName;
  rInitial = initial;
  rChatmateID = chatmateID;
  rCountUnread = countUnread;
  
  selectedChatID = id;
  currentChatmateID = chatmateID;
  
  $("#h5ReceiversName").text(fullName);
  $("#spInitial").text(initial);
  
  $.ajax({
    url: "../code/php/web/message",
    data: {
      command : 'messages_' + mode + '_1',
      chatID  : id
    },
    type: 'post',
    success: function (data) {
      var data = jQuery.parseJSON(data);
      
      var message = "";
      
      for (var i = 0; i < data.length; i++) {
    
        if (mode == "buyer") {
          if (data[i].messageMode != "Sender") {
            message += `
              <li>
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + $("#aMyName").html() + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          } else {
            message += `
              <li class="right">
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + fullName + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
            
            $("#pRow" + selectedChatID).text(data[i].message);
            $("#notif-row" + selectedChatID).text(Number(rCountUnread) + 1);
            rCountUnread = Number(rCountUnread) + 1;
            $("#dvUnread" + selectedChatID).html(
              `<span id="notif-row` + selectedChatID + `" class="badge bg-danger rounded-pill">` + rCountUnread + `</span>`
            );
          }
        } else {
          if (data[i].messageMode != "Sender") {
            message += `
              <li class="right">
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + fullName + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
            
            $("#pRow" + selectedChatID).text(data[i].message);
            $("#notif-row" + selectedChatID).text(Number(rCountUnread) + 1);
            rCountUnread = Number(rCountUnread) + 1;
            $("#dvUnread" + selectedChatID).html(
              `<span id="notif-row` + selectedChatID + `" class="badge bg-danger rounded-pill">` + rCountUnread + `</span>`
            );
          } else {
            message += `
              <li>
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + $("#aMyName").html() + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          }
        }
      }
      $("#ulMessageHolder").append(message);
    }
  });
}

function setmeAsActive(id,fullName,initial,chatmateID,countUnread) {
  $('.row-chat').removeClass('active');
  $("#row" + id).addClass("active");
  
  rChatID = id;
  rFullName = fullName;
  rInitial = initial;
  rChatmateID = chatmateID;
  rCountUnread = countUnread;
  
  selectedChatID = id;
  currentChatmateID = chatmateID;
  
  $("#h5ReceiversName").text(fullName);
  $("#spInitial").text(initial);
  $("#ulMessageHolder").html('');
  
  $.ajax({
    url: "../code/php/web/message",
    data: {
      command : 'messages_' + mode,
      chatID  : id
    },
    type: 'post',
    success: function (data) {
      var data = jQuery.parseJSON(data);
      
      var message = "";
      
      for (var i = 0; i < data.length; i++) {
    
        if (mode == "buyer") {
          if (data[i].messageMode != "Sender") {
            message += `
              <li>
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + $("#aMyName").html() + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          } else {
            message += `
              <li class="right">
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + fullName + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          }
        } else {
          if (data[i].messageMode != "Sender") {
            message += `
              <li class="right">
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + fullName + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          } else {
            message += `
              <li>
                  <div class="conversation-list">
                      <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                              <h5 class="conversation-name"><a href="#" class="user-name">` + $("#aMyName").html() + `</a> <span class="time">` + data[i].dateCreated + `</span></h5>
                              <p class="mb-0">` + data[i].message + `</p>
                          </div>
                      </div>
                  </div>
              </li>
            `;
          }
        }
        
      }
      
      
      $("#ulMessageHolder").append(message);
    }
  });
}

$("#btnSend").click(function(){
  sendMessage($("#txtMessage").val());
});

$("#txtMessage").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      sendMessage($("#txtMessage").val());
    }
});

function sendMessage(message) {
  var fullName    = $("#aMyName").text();
  var currentDate = new Date().toLocaleString();
  
  if (message == "") {
    return;
  }
  
  
  $.ajax({
    url: "../code/php/web/message",
    data: {
      command    : 'send_message',
      chatID     : selectedChatID,
      chatmateID : currentChatmateID,
      message    : message
    },
    type: 'post',
    success: function (data) {
      var data = jQuery.parseJSON(data);
      
      if (data[0].error) {
        JAlert(data[0].message,data[0].color);
      } else {
        
        
        $("#ulMessageHolder").append(`
          <li class="focus" tabindex="1">
              <div class="conversation-list">
                  <div class="ctext-wrap">
                      <div class="ctext-wrap-content">
                          <h5 class="conversation-name"><a href="#" class="user-name">` + fullName + `</a> <span class="time">` + moment().format('MM/DD/YYYY hh:mm A') + `</span></h5>
                          <p class="mb-0">` + message + `</p>
                      </div>
                  </div>
              </div>
          </li>                             
        `);
      
        $('.focus').last().addClass('active-li').focus();
        $('.simplebar-content').scrollTop($('.simplebar-content').height())
        $("#dvTimRow" + selectedChatID).html(time_ago(currentDate));  
        $("#pRow" + selectedChatID).text(message);  
        $("#txtMessage").val("");
      }
    }
  });
}

function time_ago(time) {

  switch (typeof time) {
    case 'number':
      break;
    case 'string':
      time = +new Date(time);
      break;
    case 'object':
      if (time.constructor === Date) time = time.getTime();
      break;
    default:
      time = +new Date();
  }
  var time_formats = [
    [60, 'sec', 1], // 60
    [120, '1 min', '1 min'], // 60*2
    [3600, 'min', 60], // 60*60, 60
    [7200, '1 hr', '1 hr'], // 60*60*2
    [86400, 'hr', 3600], // 60*60*24, 60*60
    [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
    [604800, 'days', 86400], // 60*60*24*7, 60*60*24
    [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
    [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
    [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
    [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
    [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
    [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
    [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
    [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
  ];
  var seconds = (+new Date() - time) / 1000,
    token = '',
    list_choice = 1;

  if (seconds == 0) {
    return 'Just now'
  }
  if (seconds < 0) {
    seconds = Math.abs(seconds);
    token = 'from now';
    list_choice = 2;
  }
  var i = 0,
    format;
  while (format = time_formats[i++])
    if (seconds < format[0]) {
      if (typeof format[2] == 'string')
        return format[list_choice];
      else
        return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
    }
  return time;
}