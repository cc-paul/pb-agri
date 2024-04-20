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

                        <div class="d-lg-flex">
                            <div class="chat-leftsidebar card">
                                <div class="p-3 px-4 border-bottom">
                                    <div class="d-flex align-items-start ">
                                        <div class="flex-shrink-0 me-3 align-self-center">
                                            <div class="avatar-sm align-self-center">
												<span class="avatar-title rounded-circle bg-soft-primary text-primary">
													<?php
														echo ucwords(substr($_SESSION["clientLastName"], 0,1));
													?>
												</span>
											</div>
                                        </div>
                                        
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-14 mb-1 text-truncate">
												<a id="aMyName" href="#" class="text-dark">
													<?php echo $_SESSION["clientLastName"] . ", " . $_SESSION["clientFirstName"] . " " . $_SESSION["clientMiddleName"]; ?>
												</a>
											</h5>
                                            <p class="text-muted mb-0">Available</p>
										</div>
                                    </div>
                                </div>

                                <div class="p-3">
									<span id="spFrom" style="visibility:hidden;">
										<?php
											$url = str_replace(".php","",basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']));
											echo $url == "message" ? "buyer" : "seller";
										?>
									</span>
                                    <div class="search-box position-relative">
                                        <input id="txtSearchChat" type="text" class="form-control rounded border" placeholder="Search...">
                                        <i class="bx bx-search search-icon"></i>
                                    </div>
                                </div>

                                <div class="chat-leftsidebar-nav">
                                    <ul class="nav nav-pills nav-justified bg-soft-light p-1" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active" aria-selected="true" role="tab">
                                                <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                                <span class="d-none d-sm-block">Chat</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="chat" role="tabpanel">
                                            <div class="chat-message-list" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -17px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                                <div class="pt-3">
                                                    <div class="px-3">
                                                        <h5 class="font-size-14 mb-3">Recent</h5>
                                                    </div>
													
													
                                                    <ul id="ulSenderHolder" class="list-unstyled chat-list">
														
                                                    </ul>
                                                </div>
                                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 686px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 39px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end chat-leftsidebar -->

                            <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
                                <div class="card" style="height: 706px;">
                                    <div class="p-3 px-lg-4 border-bottom">
                                        <div class="row">
                                            <div class="col-xl-4 col-7">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3 d-sm-block d-none">
                                                        <div class="avatar-sm align-self-center">
															<span id="spInitial" class="avatar-title rounded-circle bg-soft-primary text-primary">
																R
															</span>
														</div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 id="h5ReceiversName" class="font-size-14 mb-1 text-truncate"><a href="#" class="text-dark">Receivers Name</a></h5>
                                                        <div class="row">
															<div class="col-md-4 col-xs-6">
																<p class="text-muted text-truncate mb-0">Available</p>
															</div>
															<div class="col-md-8 col-xs-6">
																<a href="#" class="pull-right" onClick="openReportModal()">Report User</a>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-5">
                                                <!--<ul class="list-inline user-chat-nav text-end mb-0">
                                                    <li class="list-inline-item">
                                                        <div class="dropdown">
                                                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-search"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-2">
                                                                <form class="px-2">
                                                                    <div>
                                                                        <input type="text" class="form-control border bg-soft-light" placeholder="Search...">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
													</li>
                                                </ul>                -->                                                                                                                                                                                                                                                                        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat-conversation p-3 px-2" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -16px -8px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -17px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 16px 8px;">
                                        <div id="ulMessageHolder" class="list-unstyled mb-0">
        
                                            

                                        </div>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 824px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 53px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>

                                    <div class="p-3 border-top">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <input id="txtMessage" type="text" class="form-control border bg-soft-light" placeholder="Enter Message...">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button id="btnSend" type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end user chat -->
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
		
		<div class="modal fade" id="mdReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title cust-label" id="staticBackdropLabe">Report User Form</h6>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="col-md-12">
							<textarea id="txtReportMessage" rows="4" cols="50" class="form-control" placeholder="Please explain the reason why your reporting this user after that we will review your request and provide proper actions needed."></textarea>
						</div>
						<br>
						<div class="col-md-12">
							<div class="col-md-4 col-xs-12" style="height:250px; width:100%;">
								<img id="imgReport" class="img-thumbnail my-image" alt="200x200" style="width:100%; max-height: 250px; height: 250px;" src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg" data-holder-rendered="true" style="height: 100% !important; width: 100%; max-height: 100%;">
							</div>
						</div>
						<br>
						<input type="file" id="image_uploader" name="image_uploader" accept="image/png, image/jpeg" style='display: none;'> <!---->
					</div>
					<div class="modal-footer">
						<div class="row" style="width: 100%;">
							<div class="col-md-4" style="visibility:hidden">
								<input id="txtChatMessage" type="text" class="form-control border bg-soft-light own-font" placeholder="Enter Message here or type 'Get Started' to continue..." style="width:100%;">
							</div>
							<div class="col-md-4">
								<button id="btnAttachImage" style="width: 100%;" type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light own-font" onclick="openImage()"><span class="d-none d-sm-inline-block me-2">Attach Image</span> <i class="mdi mdi-upload float-end"></i></button>
							</div>
							<div class="col-md-4">
								<button id="btnSendReport" style="width: 100%;" type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light own-font"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

        <script src="../assets/js/app.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

        <!--<script src="../assets/js/ajax.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/message.js?random=<?php echo uniqid(); ?>"></script>

    </body>
</html>
