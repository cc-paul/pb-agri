<?php
	if(!isset($_SESSION)) { session_start(); } 
	if (!isset($_SESSION['id'])) {
		header( "Location: ../" );
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Website | Agri-Merchants - Administrator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico" />

        <!-- preloader css -->
        <link rel="stylesheet" href="../assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Custom Css -->
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
		<link href="../code/css/style.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    </head>

    <body>
        <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm.svg" alt="" height="24" />
                                </span>
                                <span class="logo-lg"> <img src="../assets/images/logo-sm.svg" alt="" height="24" /> <span class="logo-txt">Agri-Merchants</span> </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm.svg" alt="" height="24" />
                                </span>
                                <span class="logo-lg"> <img src="../assets/images/logo-sm.svg" alt="" height="24" /> <span class="logo-txt">Agri-Merchants</span> </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." />
                                <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result" />
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                        <!--<div class="dropdown d-inline-block" style="margin-right: 20px;">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0">Notifications</h6>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Total Applicants</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">You have 3 new seller application</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>-->

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/images/users/avatar-<?php echo $_SESSION['id']; ?>.jpg?random=<?php echo rand(10,100); ?>" onerror="this.onerror=null; this.src='../assets/images/users/default.jpg'"/>
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">
									<?php
										echo $_SESSION['fullName'];
									?>
								</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="profile"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>
                            <!--<li class="mm-active">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="check-square"></i>
                                    <span data-key="t-apps">Apps</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a id="amenu-format" href="calendar.html">
                                            <span data-key="t-calendar">Calendar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <?php
                                include dirname(__FILE__,2) . '/code/php/sidebar/sidebar.php';
                            ?>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" id="miniaresult">
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 id="headerTitle" class="mb-sm-0 font-size-18">Account Settings</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li id="liHeaderTitle" class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                            <li id="liDetailTitle" class="breadcrumb-item active">Account Settings</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="d-lg-flex">
								<div class="chat-leftsidebar card">
									<div class="p-3 px-4 border-bottom">
										<div class="d-flex align-items-start ">
											<div class="flex-shrink-0 me-3 align-self-center">
												<div class="avatar-sm align-self-center">
													<span class="avatar-title rounded-circle bg-soft-primary text-primary">
														<?php
															echo ucwords(substr($_SESSION["fullName"], 0,1));
														?>
													</span>
												</div>
											</div>
											
											<div class="flex-grow-1">
												<h5 class="font-size-14 mb-1 text-truncate">
													<a id="aMyName" href="#" class="text-dark">
														<?php echo $_SESSION['fullName']; ?>
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
												echo $url == "message" ? "buyer" : "admin";
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
									<div class="card" style="height: 775px;">
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
															<p class="text-muted text-truncate mb-0">Available</p>
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
											<ul id="ulMessageHolder" class="list-unstyled mb-0">
			
												
	
											
	
											</ul>
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
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            &#169; Agri-Merchants.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">Design & Develop by <a href="#!" class="text-decoration-underline">IT Students</a></div>
                        </div>
                    </div>
                </div>
            </footer>

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
                        <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical" />
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-horizontal" value="horizontal" />
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light" value="light" />
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark" />
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="layout-width"
                            id="layout-width-fuild"
                            value="fuild"
                            onchange="document.body.setAttribute('data-layout-size',
                            'fluid')"
                        />
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="layout-width"
                            id="layout-width-boxed"
                            value="boxed"
                            onchange="document.body.setAttribute('data-layout-size',
                            'boxed')"
                        />
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="layout-position"
                            id="layout-position-fixed"
                            value="fixed"
                            onchange="document.body.setAttribute('data-layout-scrollable',
                            'false')"
                        />
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="layout-position"
                            id="layout-position-scrollable"
                            value="scrollable"
                            onchange="document.body.setAttribute('data-layout-scrollable',
                            'true')"
                        />
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="topbar-color"
                            id="topbar-color-light"
                            value="light"
                            onchange="document.body.setAttribute('data-topbar',
                            'light')"
                        />
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="topbar-color"
                            id="topbar-color-dark"
                            value="dark"
                            onchange="document.body.setAttribute('data-topbar',
                            'dark')"
                        />
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-size"
                            id="sidebar-size-default"
                            value="default"
                            onchange="document.body.setAttribute('data-sidebar-size',
                            'lg')"
                        />
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-size"
                            id="sidebar-size-compact"
                            value="compact"
                            onchange="document.body.setAttribute('data-sidebar-size',
                            'md')"
                        />
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-size"
                            id="sidebar-size-small"
                            value="small"
                            onchange="document.body.setAttribute('data-sidebar-size',
                            'sm')"
                        />
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-color"
                            id="sidebar-color-light"
                            value="light"
                            onchange="document.body.setAttribute('data-sidebar',
                            'light')"
                        />
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-color"
                            id="sidebar-color-dark"
                            value="dark"
                            onchange="document.body.setAttribute('data-sidebar',
                            'dark')"
                        />
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="sidebar-color"
                            id="sidebar-color-brand"
                            value="brand"
                            onchange="document.body.setAttribute('data-sidebar',
                            'brand')"
                        />
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr" />
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl" />
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>
                </div>
            </div>
            <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
		
        <!-- pace js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../assets/libs/pace-js/pace.min.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/profile.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/message.js?random=<?php echo uniqid(); ?>"></script>
    </body>
</html>
