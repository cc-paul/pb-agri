<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Agri-Merchants | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="code/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    </head>

    <body>
        <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="#" class="d-block auth-logo"> <img src="assets/images/logo-sm.svg" alt="" height="28" /> <span class="logo-txt">Agri-Merchants</span> </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Welcome Back !</h5>
                                            <p class="text-muted mt-2">Sign in to continue to Agri-Merchants.</p>
                                        </div>
                                        <div class="mt-4 pt-2">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input id="txtInputUsername" type="text" class="form-control" id="username" placeholder="Enter username" />
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label">Password</label>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="">
                                                            <a id="aForgotPassword1" href="#" class="text-muted">Forgot password?</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-group auth-pass-inputgroup">
                                                    <input id="txtInputPassword" type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" />
                                                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button id="btnLogin" class="btn btn-primary w-100 waves-effect waves-light">Log In</button>
                                            </div>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Are you a seller ? <a id="aSignUp" href="#" class="text-primary fw-semibold"> Signup here </a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-primary"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <!-- end carouselIndicators -->
                                            <!--<div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">
                                                            ?I feel confident imposing change on myself. It's a lot more progressing fun than looking back. That's why I ultricies enim at malesuada nibh diam on tortor neaded to throw curve
                                                            balls.?
                                                        </h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="..." />
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Richard Drews</h5>
                                                                    <p class="mb-0 text-white-50">Web Designer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">
                                                            ?Our task must be to free ourselves by widening our circle of compassion to embrace all living creatures and the whole of quis consectetur nunc sit amet semper justo. nature and
                                                            its beauty.?
                                                        </h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="..." />
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Rosanna French</h5>
                                                                    <p class="mb-0 text-white-50">Web Developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">
                                                            ?I've learned that people will forget what you said, people will forget what you did, but people will never forget how donec in efficitur lectus, nec lobortis metus you made them
                                                            feel.?
                                                        </h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="..." />
                                                                <div class="flex-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                                    <p class="mb-0 text-white-50">Manager</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <!-- end carousel-inner -->
                                        </div>
                                        <!-- end review carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>

        <div id="mdRegistration" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title own-font" id="myModalLabel">Sellers Registration Form</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label own-font">Username</label>
                                <code>*</code>
                                <input id="txtUsername" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Username">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label own-font">First Name</label>
                                <code>*</code>
                                <input id="txtFirstName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter First Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)">
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label own-font">Middle Name</label>
                                <input id="txtMiddleName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Middle Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)">
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label own-font">Last Name</label>
                                <code>*</code>
                                <input id="txtLastName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Last Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label own-font">Email Address</label>
                                <code>*</code>
                                <input id="txtEmailAddress" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Email Address">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label own-font">Mobile Number</label>
                                <code>*</code>
                                <input id="txtMobileNumber" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter CP Number (09XXXXXXXXX)" maxlength="11" onkeyup="numOnly(this)">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label class="form-label own-font">Current Address</label>
                                <code>*</code>
                                <br>
                                <textarea id="txtAddress" class="form-control form-control-sm" rows="4" placeholder="Enter Current Address"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label own-font">Password</label>
                                <code>*</code>
                                <input id="txtPassword" class="form-control form-control-sm" type="password" id="form-sm-input" placeholder="Enter Password">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label own-font">Confirm Password</label>
                                <code>*</code>
                                <input id="txtConfirmPassword" class="form-control form-control-sm" type="password" id="form-sm-input" placeholder="Enter Confirm Password">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label own-font">Bussiness Name</label>
                                <code>*</code>
                                <input id="txtCompanyName" class="form-control form-control-sm own-font" type="text" placeholder="Enter Bussiness Name">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label class="form-label own-font">Bussiness Address</label>
                                <code>*</code>
                                <br>
                                <textarea id="txtCompanyAddress" class="form-control form-control-sm own-font" placeholder="Enter Bussiness Address" rows="2" cols="50"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0 own-font" role="alert">
                                    <i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Info</strong> - Password must have Uppercase,Lowercase,Numeric and Special Characters 
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button id="btnRegisterAccount" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- JAVASCRIPT -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>
        <!-- password addon init -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="assets/js/pages/pass-addon.init.js"></script>
        <script src="code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
        <script src="code/js/login.js?random=<?php echo uniqid(); ?>"></script>
    </body>
</html>
<script>
$("#aForgotPassword1").click(function(){
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
                        url: "code/php/web/login",
                        data: {
                            command : 'send_email',
                            email : email
                        },
                        type: 'post',
                        success: function (data) {
                            var data = jQuery.parseJSON(data);
                            
                            
                            
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
                        url: "code/php/web/login",
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
</script>
