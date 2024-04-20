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
		<!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />

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
                            <a href="#" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm.svg" alt="" height="24" />
                                </span>
                                <span class="logo-lg"> <img src="../assets/images/logo-sm.svg" alt="" height="24" /> <span class="logo-txt">Agri-Merchants</span> </span>
                            </a>

                            <a href="#" class="logo logo-light">
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
                                    <h4 id="headerTitle" class="mb-sm-0 font-size-18">Website Title</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li id="liHeaderTitle" class="breadcrumb-item"><a href="javascript: void(0);">Administrator</a></li>
                                            <li id="liDetailTitle" class="breadcrumb-item active">Website Title</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <p id="pDesc" class="card-title-desc own-font">
											
										</p>
                                    </div>
                                    <div class="card-body">
										<div class="row">
											<div class="col-md-10 col-xs-12">
												<div class="form-group">
													<input id="txtSearchUser" class="form-control form-control-sm" type="text" placeholder="Search account here...">
												</div>
											</div>
											<div class="col-md-2 col-xs-6">
												<div class="form-group">
													<!--<button id="btnExportUser" type="button" class="btn btn-sm btn-success waves-effect waves-light button-max own-font">
														<i class="bx bx-copy-alt font-size-16 align-middle me-2"></i>
														&nbsp;
														Export to Excel
													</button>-->
													<button id="btnExportUser" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-folder-open label-icon"></i>Export to Excel</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-sm-12" >
												<div class="table-container">
													<table id="tblAccount" name="tblAccount" class="table table-bordered nowrap w-100 dataTable no-footer dtr-inline own-font" style="width: 100% !important; margin-top: 0px !important;">
														<thead>
															<tr>
																<th>Username</th>
																<th>First Name</th>
																<th>Middle Name</th>
																<th>Last Name</th>
																<th>Email Address</th>
																<!--<th>Mobile Number</th>-->
																<!--<th>Address</th>-->
																<th>Status</th>
																<th>Approval</th>
																<th>Position</th>
																<th>Date Created</th>
															</tr>
														</thead>
														<tbody>
															
														</tbody>
													</table>
													<br>
													<br>
												</div>
											</div>
										</div>
										<br>
										<br>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
											<div class="col-md-12">
												<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0 own-font" role="alert">
													<i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Info</strong> - Please see below the details of the applicant and the necessary task that needs to finish
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="card-body">
										<div class="row">
											<div class="col-md-4 col-sm-12">
												<label class="form-label own-font">Username</label>
												<code>*</code>
												<input id="txtUsername" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Username" disabled>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-4 col-sm-12">
												<label class="form-label own-font">First Name</label>
												<code>*</code>
												<input id="txtFirstName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter First Name" disabled>
											</div>
											<div class="col-md-4 col-sm-12">
												<label class="form-label own-font">Middle Name</label>
												<input id="txtMiddleName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Middle Name" disabled>
											</div>
											<div class="col-md-4 col-sm-12">
												<label class="form-label own-font">Last Name</label>
												<code>*</code>
												<input id="txtLastName" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Last Name" disabled>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<label class="form-label own-font">Email Address</label>
												<code>*</code>
												<input id="txtEmailAddress" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter Email Address" disabled>
											</div>
											<div class="col-md-6 col-sm-12">
												<label class="form-label own-font">Mobile Number</label>
												<code>*</code>
												<input id="txtMobileNumber" class="form-control form-control-sm" type="text" id="form-sm-input" placeholder="Enter CP Number (09XXXXXXXXX)" maxlength="11" onkeyup="numOnly(this)"  disabled>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<label class="form-label own-font">Current Address</label>
												<code>*</code>
												<br>
												<textarea id="txtAddress" class="form-control form-control-sm" rows="4" placeholder="Enter Current Address" disabled></textarea>
											</div>
										</div>
                                    </div>
									<div class="card-footer">
										<div class="row">
											<div class="col-md-4 col-sm-12">
												<select id="cmbPosition" class="form-select own-font" disabled>
													<option selected disabled value="">Select</option>
													<option value="Seller">Seller</option>
													<option value="Administrator">Administrator</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-12">
												<!--<button id="btnApprove" type="button" class="btn btn-sm btn-success waves-effect waves-light button-max own-font" disabled>
													<i class="bx bx-check-double font-size-16 align-middle me-2"></i> Aprove User
												</button>-->
												
												<button id="btnApprove" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;" disabled>
													<i class="bx bx-check-square label-icon"></i>Approve
												</button>
											</div>
											<div class="col-md-4 col-sm-12">
												<!--<button id="btnReject" type="button" class="btn btn-sm btn-danger waves-effect waves-light button-max own-font" disabled>
													<i class="bx bx-block font-size-16 align-middle me-2"></i> Decline It
												</button>-->
												
												<button id="btnReject" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;" disabled>
													<i class="bx bx-error label-icon"></i> Ban
												</button>
											</div>
										</div>
									</div>
                                </div>
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
        <!-- pace js -->
		 <!-- Required datatable js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/libs/jszip/jszip.min.js"></script>
        <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="../assets/js/pages/datatables.init.js"></script>   
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../assets/libs/pace-js/pace.min.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/seller.js?random=<?php echo uniqid(); ?>"></script>
    </body>
</html>
