<?php
	if(!isset($_SESSION)) { session_start(); } 
?>

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Agri-Merchants | Product Selling</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- plugin css -->
        <link href="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="../assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

          <!-- Custom Css -->
	    <link href="../assets/css/custom.css"rel="stylesheet" type="text/css" />
        <link href="../code/css/style.css" rel="stylesheet" type="text/css" />
        <style>
            .box-100 {
                width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
			
			body {
				background-image: linear-gradient(#FC8F30, #FDBB31) !important;
			}
        </style>
    </head>

    <body data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php
                include 'header.php';
            ?>
            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" id="miniaresult">
                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Update Profile Information</h4>
                                        <p class="card-title-desc">Always update your details for better transaction</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label own-font">Username</label>
                                                <code>*</code>
                                                <input id="txtUsername" class="form-control form-control-sm" type="text" placeholder="Enter Username" value="<?php echo $_SESSION["clientUsername"]; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label own-font">First Name</label>
                                                <code>*</code>
                                                <input id="txtFirstName" class="form-control form-control-sm" type="text" placeholder="Enter First Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" value="<?php echo $_SESSION["clientFirstName"]; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label own-font">Middle Name</label>
                                                <input id="txtMiddleName" class="form-control form-control-sm" type="text" placeholder="Enter Middle Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" value="<?php echo $_SESSION["clientMiddleName"]; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label own-font">Last Name</label>
                                                <code>*</code>
                                                <input id="txtLastName" class="form-control form-control-sm" type="text" placeholder="Enter Last Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" value="<?php echo $_SESSION["clientLastName"]; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label own-font">Email Address</label>
                                                <code>*</code>
                                                <input id="txtEmailAddress" class="form-control form-control-sm" type="text" placeholder="Enter Email Address" value="<?php echo $_SESSION["clientEmailAddress"]; ?>">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label own-font">Mobile Number</label>
                                                <code>*</code>
                                                <input id="txtMobileNumber" class="form-control form-control-sm" type="text" placeholder="Enter CP Number (09XXXXXXXXX)" maxlength="11" onkeyup="numOnly(this)" value="<?php echo $_SESSION["clientMobileNumber"]; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <label class="form-label own-font">Current Address</label>
                                                <code>*</code>
                                                <br>
                                                <textarea id="txtAddress" class="form-control form-control-sm" rows="4" placeholder="Enter Current Address"><?php echo $_SESSION["clientAddress"]; ?></textarea>
                                            </div>
                                        </div>
                                        <!--<br>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label own-font">Password</label>
                                                <code>*</code>
                                                <input id="txtPassword" class="form-control form-control-sm" type="password" placeholder="Enter Password" onkeyup="CheckPasswordStrength(this.value)">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label own-font">Confirm Password</label>
                                                <code>*</code>
                                                <input id="txtConfirmPassword" class="form-control form-control-sm" type="password" placeholder="Enter Confirm Password">
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
                                        <br>-->
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12"></div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <button id="btnUpdateAccount" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-save label-icon"></i>Update Account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Change Password</h4>
                                        <p id="pDesc" class="card-title-desc">Here you can edit your account like changing your Password</p>
                                    </div>
                                    <div class="card-body p-4" style="height: 431px;">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="row">
													<div class="mb-3">
														<div class="form-group">
															<label for="example-password-input own-font" class="form-label">Password</label>
															<input class="form-control own-font" type="password" placeholder="Enter your Password" id="txtPassword">
														</div>
                                                    </div>
												</div>
												<div class="row">
													<div class="mb-3">
														<div class="form-group">
															<label for="example-password-input own-font" class="form-label">Repeat Password</label>
															<input class="form-control own-font" type="password" placeholder="Repeat your Password" id="txtRepeatPassword">
														</div>
                                                    </div>
												</div>
												<br>
												<div class="row" style="margin-bottom: 53px;">
													<div class="col-md-12 col-sm-12">
														<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
															<i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Info</strong> - Password must be between 6 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character
														</div>
													</div>
												</div>
												<br>
												<!--<div class="row">
													<div class="col-md-8 col-xs-12"></div>
													<div class="col-md-4 col-xs-12">
														<button id="btnChangePassword" type="button" class="btn btn-block btn-primary btn-sm waves-effect waves-light pull-right button-max">Change</button>
													</div>
												</div>-->
												<div class="row">
													<div class="col-md-6 col-xs-12"></div>
													<div class="col-md-6 col-xs-12">
														<div class="form-group">
															<button id="btnChangePassword" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-lock label-icon"></i>Change Password</button>
														</div>
													</div>
												</div>
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- end page title -->
                    </div>
                </div>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

        <script src="../assets/js/app.js"></script>

        <!--<script src="../assets/js/ajax.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/register.js?random=<?php echo uniqid(); ?>"></script>
        <script src="../code/js/profile.js?random=<?php echo uniqid(); ?>"></script>

    </body>
</html>
