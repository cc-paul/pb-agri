var currentEmailAddress;

$("#btnRegisterAccount").click(function(){
    var firstName = $("#txtFirstName").val();
    var middleName = $("#txtMiddleName").val();
    var lastName = $("#txtLastName").val();
    var emailAddress = $("#txtEmailAddress").val();
    var mobileNumber = $("#txtMobileNumber").val();
    var currentAddress = $("#txtAddress").val();
    var password = $("#txtPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    var username = $("#txtUsername").val();
    var companyName = $("#txtCompanyName").val();
    var companyAddress = $("#txtCompanyAddress").val();
 
    
    if (username == "" || firstName == "" || lastName == "" || emailAddress == "" || mobileNumber == "" || currentAddress == "" ||
        password == "" || confirmPassword == "" || companyName == "" || companyAddress == "") {
        JAlert("Please fill in required fields","red");
    } else if (username.length < 5) {
        JAlert("Username must be at least 5 characters","red");
    } else if (!validateEmail(emailAddress)) {
        JAlert("Please provide proper Email Address","red");
    } else if (mobileNumber.length != 11) {
        JAlert("Mobile Number must be 11 digit","red");
    } else if (password != confirmPassword) {
        JAlert("Password does not match","red");
    } else if (!checkPassword(password)) {
        JAlert("Password must be between 6 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character","red");
    } else {
        $.ajax({
            url: "code/php/web/login",
            data: {
                command : 'register_account',
                username : username,
                firstName : firstName,
                middleName : middleName,
                lastName : lastName,
                emailAddress : emailAddress,
                mobileNumber : mobileNumber,
                currentAddress : currentAddress,
                password : password,
                position : 'Seller',
                status : 'Pending',
                companyName : companyName,
                companyAddress : companyAddress
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                JAlert(data[0].message,data[0].color);
                
                if (!data[0].error) {
                    $("#mdRegistration").modal("hide");
                }
            }
        });
    }
});


$("#aSignUp").click(function(){
	$("#txtUsername").val(null);
    $("#txtFirstName").val(null);
    $("#txtMiddleName").val(null);
    $("#txtLastName").val(null);
    $("#txtEmailAddress").val(null);
    $("#txtMobileNumber").val(null);
    $("#txtAddress").val(null);
    $("#txtPassword").val(null);
    $("#txtConfirmPassword").val(null);
    $("#mdRegistration").modal('show');
});

$("#btnLogin").click(function(){
	var username = $("#txtInputUsername").val();
    var password = $("#txtInputPassword").val();
    
    if (username == "" || password == "") {
        JAlert("Please provide username and password","red");
    } else {
        $.ajax({
            url: "code/php/web/login",
            data: {
                command : 'login_account',
                username : username,
                password : password
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                if (!data[0].error) {
                    if (data[0].position == "Administrator") {
                        window.location.href = "admin/profile";
                    } else {
                        window.location.href = "seller/profile";
                    }
                } else {
                    JAlert(data[0].message,data[0].color);
                }
            }
        });
    }
});

$("#btnClientLogin").click(function(){
	var username = $("#txtUsername").val();
    var password = $("#txtPassword").val();
    
    if (username == "" || password == "") {
        JAlert("Please provide username and password","red");
    } else {
        $.ajax({
            url: "../code/php/web/login",
            data: {
                command : 'login_client',
                username : username,
                password : password
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
                
                if (!data[0].error) {
                    window.location.href = "index";
                } else {
                    JAlert(data[0].message,data[0].color);
                }
            }
        });
    }
});

$("#aForgotPassword").click(function(){
    $.confirm({
        title: 'Forgot Password',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Email Address</label>' +
        '<input type="text" placeholder="Enter your Email Address" class="email form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var email = this.$content.find('.email').val();
                    
                    if (email == "") {
                        JAlert("Please provide an email","red");
                        return false;
                    }
                    
                    if (!validateEmail(email)) {
                        JAlert("Please provide an proper email","red");
                        return false;
                    }
                    
                    $.ajax({
                        url: "../code/php/web/login",
                        data: {
                            command : 'send_email',
                            email : email
                        },
                        type: 'post',
                        success: function (data) {
                            var data = jQuery.parseJSON(data);
                            
                            
                            
                            if (!data[0].error) {
                                if (!data[0].error) {
                                    $.ajax({
                                        url: "https://apps.project4teen.online/agri-merchants/code/php/web/email_sender.php",
                                        data: {
                                            email : email,
                                            body : data[0].message
                                        },
                                        type: 'post',
                                        success: function (data) {
                                            var data = jQuery.parseJSON(data);
                                            
                                            displayChangePass(email);
                                        }
                                    });   
                                } else {
                                    JAlert(data[0].message,data[0].color);
                                }
                            } else {
                                JAlert(data[0].message,data[0].color);
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
});

function displayChangePass(emailAddress) {
    $.confirm({
        title: 'Change Password',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<code>An OTP has been sent to your Email. Please check your inbox or spam</code>' +
        '<br>'+
        '<br>'+
        '<label>Email Address</label>' +
        '<input type="text" placeholder="Enter your Email Address" class="email form-control" value= "' + emailAddress + '" disabled />' +
        '<br>'+
        '<label>OTP</label>' +
        '<input type="text" placeholder="Enter your OTP" class="otp form-control" value= ""/>' +
        '<br>'+
        '<label>New Password</label>' +
        '<input type="password" placeholder="Enter your New Password" class="password form-control" value= "" />' +
        '<br>'+
        '<label>Repeat Password</label>' +
        '<input type="password" placeholder="Repeat the Password" class="repeatpassword form-control" value= "" />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var email = this.$content.find('.email').val();
                    var otp = this.$content.find('.otp').val();
                    var password = this.$content.find('.password').val();
                    var repeatpassword = this.$content.find('.repeatpassword').val();
                    
                    if (otp == "") {
                        JAlert("Please input your OTP","red");
                        return false;
                    } else if (password != repeatpassword) {
                        JAlert("Password does not match","red");
                        return false;
                    } else if (!checkPassword(password)) {
                        JAlert("Password must be between 6 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character","red");
                        return false;
                    }
                    
                    $.ajax({
                        url: "../code/php/web/login",
                        data: {
                            command  : 'change_pass',
                            email    : email,
                            otp      : otp,
                            password : password
                        },
                        type: 'post',
                        success: function (data) {
                            var data = jQuery.parseJSON(data);
                            
                            JAlert(data[0].message,data[0].color);
                            
                            if (!data[0].error) {
                                return;
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

function checkPassword(password) {
    var decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,15}$/;
    
    if (password.match(decimal)) { 
        return true;
    } else { 
        return false;
    }
}