var currentCategoryName = "";
var currentCategoryID = 0;
var currentCategoryDescription = "";
var current_message = "";
var selectedCategoryID = 0;
var isfaq = 0;

$("#btnOpenChatBot").click(function(){
	currentCategoryName = "";
	currentCategoryID = 0;
	currentCategoryDescription = "";
	current_message = "";
	selectedCategoryID = 0;
	
	$("#dvChatFooter").show();
	$("#mdChat").modal("show");
	$("#dvChatArea").html("");
	$("#txtChatMessage").val("");
});

$("#btnSend").click(function(){
	chatMessage($("#txtChatMessage").val());
});

$("#txtChatMessage").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        chatMessage($("#txtChatMessage").val());
    }
});

function setCategory(categoryID,categoryName,categoryDescription) {
	currentCategoryID = categoryID;
	currentCategoryName = categoryName;
	currentCategoryDescription = categoryDescription;
	current_message = "display selected category";
}

function chatMessage(message) {	
	if (current_message != "display selected category") {
		current_message = message.toLowerCase();
    }
	
	if (message.toLowerCase() == "get started" || message.toLowerCase() == "return to start") {
        current_message = "get started";
		selectedCategoryID = 0;
    }
	
    var bot_reply = "";
	var colLeft = 6,colRight = 6;
	commandSet = "";
    
    if (message == "") {
        return;
    }
    
	if (selectedCategoryID != 0) {
		current_message = "find item";
    }
	
    $("#dvChatArea").append(`
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-secondary own-font" role="alert" style="margin-left: 10px; padding: 0.25rem 1.25rem;">
                    <b>Me:</b>
                    `+ message +`
                    <br>
                    <span>
                        <b style="font-size:8px">Sent at :` + new Date().toLocaleString() + `</b>
                    </span>
                </div>
            </div>
        </div>                            
    `);
	
	switch (current_message) {
		case "get started" :
		case "return to start" :
				commandSet = "getstarted";
				isfaq = 0;
			break;
		case "display category" :
				commandSet = "displaycategory";
				colLeft  = 1;
				colRight = 11;
			break;
		case "display selected category":
				commandSet = "displayselectedcategory";
				colLeft  = 4;
				colRight = 8;
			break;
		case "search items in the category" :
				commandSet = "searchitemsinthecategory";
			break;
		case "find item" :
				commandSet = "finditem";
			break;
		case "faq" :
				commandSet = "faq";
				isfaq = 0;
			break;
    }
    
	if (isfaq == 1) {
		commandSet = "answerfaq";
    }
	
    switch (commandSet) {
        case "getstarted" :
                bot_reply = `
                    Hi buyers, Good day. I am your Agri-merchants virtual assistant for today! What would you like to do first?
                    <br>
                    <button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Display Category')">Display Category</button>
                    <br>
                    <button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('FAQ')">FAQ</button>
                    <br>
                `;
            break;
		case "displaycategory" :
				
				$.ajax({
					url: "../code/php/web/chatbot_response",
					data: {
						command : 'displaycategory',
					},
					type: 'post',
					success: function (data) {
						var data = jQuery.parseJSON(data);
						var buttons = "";
						
						for (var i = 0; i < data.length; i++) {
							buttons += `
								<div class="col-md-6" style="margin-bottom: 2px;">
									<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="setCategory(` + data[i].id + `,'`+ data[i].category +`','` + data[i].description + `'); chatMessage('`+ data[i].category +`')">`+ data[i].category +`</button>
								</div>
							`;
							
                        }
						
						current_message = "display selected category"
						
						bot_reply = `This is the list of categories we have <br>` + `<div class="row">` + buttons + `</div>
							<div class="col-md-12" style="margin-bottom: 2px;">
								<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
							</div>
						`;
					}
				});
				
			break;
		case "displayselectedcategory" :
				
				$.ajax({
					url: "../code/php/web/chatbot_response",
					data: {
						command : 'categorysearch',
						search  : message
					},
					type: 'post',
					success: function (data) {
						var data = jQuery.parseJSON(data);
						
						if (data.length != 0) {
							bot_reply = `<b>` + data[0].category + "</b> : " + data[0].description + `
								<div class="col-md-12" style="margin-bottom: 2px;">
									<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Display Category')">Display Category</button>
								</div>
								<div class="col-md-12" style="margin-bottom: 2px;">
									<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Search Items in the Category')">Search Items in the Category</button>
								</div>
								<div class="col-md-12" style="margin-bottom: 2px;">
									<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
								</div>
							`;
							
							
							currentCategoryID = data[0].id;
							current_message = "";
                        }
					}
				});
			
			break;
		case "searchitemsinthecategory" :
			
				bot_reply = `
					Go ahead type in what you want to search 
				`;
				
				selectedCategoryID = currentCategoryID;
			
			break;
		case "finditem" :
			
				$.ajax({
					url: "../code/php/web/chatbot_response",
					data: {
						command : 'finditem',
						search  : message,
						categoryID : selectedCategoryID
					},
					type: 'post',
					success: function (data) {
						var data = jQuery.parseJSON(data);
						
						if (data.length != 0) {
							var data = data[0];
							
							bot_reply = `
								<br>
								<b>Name</b> : ` + data.itemName + `
								<br>
								<b>Category</b> : ` + data.itemName + `
								<br>
								<br>
								<b>Description</b> : ` + data.description + `
								<br>
								<br>
								<b>How to Use</b> : ` + data.howToUse + `
								<br>
								<div class="col-md-12" style="margin-bottom: 2px;">
									<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
								</div>
							`;
                        } else {
							$.ajax({
								url: "../code/php/web/chatbot_response",
								data: {
									command : 'finditem_like',
									search  : message,
									categoryID : selectedCategoryID
								},
								type: 'post',
								success: function (data) {
									var data = jQuery.parseJSON(data);
									
									if (data.length != 0) {
										var choices = "";										
										
										for (var i = 0; i < data.length; i++) {
											data = data[0];
											
											choices += data.itemName + "<br>";
                                        }
										
										bot_reply = `
											Sorry we did not find any items related to your search. Maybe check the following items below.
											
											<br>
											<br>
										` + choices + `
											<br>
											<div class="col-md-12" style="margin-bottom: 2px;">
												<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
											</div>
										`;
									} else {
										bot_reply = `
											Sorry we did not find any items related to your search.
											<br>
											<br>
											<div class="col-md-12" style="margin-bottom: 2px;">
												<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
											</div>
										`;
									}
								}
							});
						}
					}
				});
			
			break;
		case "faq" :
			
				//bot_reply = `
				//	<br>
				//	Q: Do you accept returns/exchange?
				//	<br>
				//	A: No
				//	<br>
				//	<br>
				//	Q: Do you allow refunds?
				//	<br>
				//	A: No
				//	<br>
				//	<br>
				//	Q: I cancel my order?
				//	<br>
				//	A: Yes if the product is not confirm yet
				//	<br>
				//	<br>
				//	Q: How long does it take to process my order?
				//	<br>
				//	A: if the location is near 2 to 3 days is the exact delivery time. And if your location is too far expect the 7 days to recieve your order
				//	<br>
				//	<br>
				//	Q: Where are your packages shipped from?
				//	<br>
				//	A: In manufacturers facility
				//	<br>
				//	<br>
				//	Q: Do you ship package internationally?
				//	<br>
				//	A: Not yet 
				//	<br>
				//	<br>
				//	Q: Do you ship package internationally?
				//	<br>
				//	A: Not Yer
				//	<br>
				//	<br>
				//	Q: What shipping method do you offer? 
				//	<br>
				//	A: COD Only 
				//	<br>
				//	<br>
				//	Q: When will I receive my item?
				//	<br>
				//	A: After 3 to 5 days you will recieve your order
				//	<br>
				//	<br>
				//	<div class="col-md-12" style="margin-bottom: 2px;">
				//		<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
				//	</div>
				//`;
				
				isfaq = 1;
				
				bot_reply = `
					Please select any question you want to know 
					<br>
					<br>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Do you accept returns/exchange?')">Do you accept returns/exchange?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Do you allow refunds?')">Do you allow refunds?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('I cancel my order?')">I cancel my order?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('How long does it take to process my order?')">How long does it take to process my order?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Where are your packages shipped from?')">Where are your packages shipped from?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Do you ship package internationally?')">Do you ship package internationally?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('What shipping method do you offer?')">What shipping method do you offer?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-primary btn-rounded waves-effect waves-light own-font" onClick="chatMessage('When will I receive my item?')">When will I receive my item?</button>
					</div>
					<div class="col-md-12" style="margin-bottom: 2px;">
						<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
					</div>
				`;
			
			break;
		case "answerfaq" :
				
				console.log(current_message);
				var answer = "";
			
				switch (current_message.toLocaleLowerCase()) {
					case "Do you accept returns/exchange?".toLocaleLowerCase():
							answer = "No";
						break;
					case "Do you allow refunds?".toLocaleLowerCase():
							answer = "No";
						break;
					case "I cancel my order?".toLocaleLowerCase():
							answer = "Yes if the product is not confirm yet".toLocaleLowerCase();
						break;
					case "How long does it take to process my order?".toLocaleLowerCase():
							answer = "if the location is near 2 to 3 days is the exact delivery time. And if your location is too far expect the 7 days to recieve your order";
						break;
					case "Where are your packages shipped from?".toLocaleLowerCase():
							answer = "In manufacturers facility";
						break;
					case "Do you ship package internationally?".toLocaleLowerCase():
							answer = "Not yet";
						break;
					case "What shipping method do you offer?".toLocaleLowerCase():
							answer = "COD Only";
						break;
					case "When will I receive my item?".toLocaleLowerCase():
							answer = "After 3 to 5 days you will recieve your order";
						break;
                }
				
				if (answer != "") {
					bot_reply = answer + `
						<br>
						<br>
						<div class="col-md-12" style="margin-bottom: 2px;">
							<button style="margin-top:2px; width:100%;" type="button" class="btn btn-warning btn-rounded waves-effect waves-light own-font" onClick="chatMessage('Return to Start')">Return to Start</button>
						</div>
					`;
                }
				
				
			
			break;
    }
	
	
	console.log(current_message);
	console.log(commandSet);
	
	var arrGreetings = ['good morning','good evening','good aftertoon','greetings'];
	
	if (contains(current_message.toLowerCase(),arrGreetings) || current_message == "hi" || current_message == "hello") {
		const greeting_reply = [
			"Good morning! What brings you to our site? What was the source you came to know about it?",
			"Hello! nice to meet you",
			"Greetings Customer! Enjoy your shopping"
		];
		
		bot_reply = greeting_reply[Math.floor(Math.random() * greeting_reply.length)];
    }
    
    if (bot_reply == "") {
        const idontKnow_reply = [
            "I'm probably not the best person to ask for that information",
            "I'm afraid. I have no idea",
            "It could be one of many possibilities, I'll look into it",
            "There are several possible answers, I'll need more information first",
            "I want to be sure and give you the correct information. Let me check",
            "I'll find out and let you know"
        ];
        
        bot_reply = idontKnow_reply[Math.floor(Math.random() * idontKnow_reply.length)];
    }
    
	$("#txtChatMessage").val("");
	$("#dvChatArea").scrollTop($("#dvChatArea")[0].scrollHeight);
	
    setTimeout(function() {
		$("#dvChatArea").append(`
			<div class="row" style="padding-right: 7px;">
				<div class="col-md-`+ colLeft +`">
				</div>
				<div class="col-md-`+ colRight +`">
					<div class="alert alert-primary own-font" role="alert" style="margin-left: 10px; padding: 0.25rem 1.25rem;">
						<b>Agri Merchants:</b>
						`+ bot_reply +`
						<br>
						<span>
							<b style="font-size:8px">Sent at :` + new Date().toLocaleString() + `</b>
						</span>
					</div>
				</div>
			</div>
		`);
		
		$("#dvChatArea").scrollTop($("#dvChatArea")[0].scrollHeight);
	}, 1500);
}

function contains(target, pattern){
    var value = 0;
    pattern.forEach(function(word){
      value = value + target.includes(word);
    });
    return (value === 1)
}