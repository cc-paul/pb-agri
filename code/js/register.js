var isPasswordOk = false;

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
    
    if (username == "" || firstName == "" || lastName == "" || emailAddress == "" || mobileNumber == "" || currentAddress == "" || password == "" || confirmPassword == "") {
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
            url: "../code/php/web/login",
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
                position : 'Client',
                status : 'Pending'
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
            
                
                if (!data[0].error) {
                    JConfirm(data[0].message + "-" + data[0].color, () => {
                        location.reload();
                    });
                } else {
                    JAlert(data[0].message,data[0].color);
                }
            }
        });
    }
});


$("#btnUpdateAccount").click(function(){
    var firstName = $("#txtFirstName").val();
    var middleName = $("#txtMiddleName").val();
    var lastName = $("#txtLastName").val();
    var emailAddress = $("#txtEmailAddress").val();
    var mobileNumber = $("#txtMobileNumber").val();
    var currentAddress = $("#txtAddress").val();
    var username = $("#txtUsername").val();
    
    if (username == "" || firstName == "" || lastName == "" || emailAddress == "" || mobileNumber == "" || currentAddress == "") {
        JAlert("Please fill in required fields","red");
    } else if (username.length < 5) {
        JAlert("Username must be at least 5 characters","red");
    } else if (!validateEmail(emailAddress)) {
        JAlert("Please provide proper Email Address","red");
    } else if (mobileNumber.length != 11) {
        JAlert("Mobile Number must be 11 digit","red");
    } else {
        $.ajax({
            url: "../code/php/web/login",
            data: {
                command : 'update_account',
                username : username,
                firstName : firstName,
                middleName : middleName,
                lastName : lastName,
                emailAddress : emailAddress,
                mobileNumber : mobileNumber,
                currentAddress : currentAddress,
                position : 'Client',
                status : 'Pending'
            },
            type: 'post',
            success: function (data) {
                var data = jQuery.parseJSON(data);
            
                
                if (data[0].error) {
                    JConfirm(data[0].message + "-" + data[0].color, () => {
                        location.reload();
                    });
                } else {
                    JAlert(data[0].message,data[0].color);
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

