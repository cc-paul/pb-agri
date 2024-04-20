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
		
		<!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
		
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
			
			::-webkit-scrollbar {
				width: 0;  /* Remove scrollbar space */
				background: transparent;  /* Optional: just make scrollbar invisible */
			}
			/* Optional: show position indicator in red */
			::-webkit-scrollbar-thumb {
				background: #FF0000;
			}
			
			.w1 {
				display: block;
				font-size: 14px;
				white-space: nowrap;
				overflow: hidden;
				/* text-overflow: ellipsis; */
				width: 194px;
			}
			
			.w2 {
				/* display: block; */
				overflow: hidden;
				/* text-overflow: ellipsis; */
				display: block;
				font-size: 14px;
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
							<div class="col-md-3 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="mb-3 font-size-13" style="margin-bottom: 0rem!important;"><i class="mdi mdi-cart text-secondary font-size-18 me-2" ></i>Shopping Cart</p>
                                    </div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
												<input id="txtItemSearch" class="form-control own-font" type="text" placeholder="Search Item Here" id="txtSearchCart">
											</div>
										</div>
									</div>
                                    <div class="card-body" style="height:524px; overflow:auto;">
										<div id="dvCart" class="row">
											
										</div>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-9 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="mb-3 font-size-13" style="margin-bottom: 0rem!important;"><i class="mdi mdi-credit-card-check-outline text-secondary font-size-18 me-2" ></i>Check Out and Billing Details</p>
                                    </div>
                                    <div class="card-body p-4" style="height:600px;">
										<div class="row" style="height:100% !important; overflow:auto;">
											<div class="col-md-9">
												<div class="card" style="height:100% !important;">
													<div class="card-body" style="overflow:auto; height: 385px;">
														<div id="dvCheckOut" class="row">
															
														</div>
													</div>
													<div class="card-footer">
														<div class="row">
															<div class="col-md-2 col-xs-12">
																<span class="own-font">Total Price: </span>
																<h4 class="mb-3">
																	P<span id="spTotalAmount" class="counter-value">0</span>
																</h4>
															</div>
															<div class="col-md-2 col-xs-12">
																<span class="own-font">Total Item: </span>
																<h4 class="mb-3">
																	<span id="spTotalItem" class="counter-value">0</span>
																</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="row">
													<div class="col-md-12">
														<div class="card">
															<div class="card-body">
																<div class="row">
																	<div class="col-md-12">
																		<p class="mb-3 font-size-13" style="margin-bottom: 0rem!important;"><i class="mdi mdi-truck text-secondary font-size-18 me-2" ></i>Deliver To</p>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-12">
																		<div class="own-font">
																			<b>Name:</b>
																			<span class="own-font"><?php echo $_SESSION["clientFirstName"] . ' ' . $_SESSION["clientMiddleName"] . ' ' . $_SESSION["clientLastName"]; ?></span>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-12">
																		<div class="own-font">
																			<b>Email:</b>
																			<span class="own-font"><?php echo $_SESSION["clientEmailAddress"]; ?></span>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-12">
																		<div class="own-font">
																			<b>Mobile Number:</b>
																			<span class="own-font"><?php echo $_SESSION["clientMobileNumber"]; ?></span>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-12">
																		<div class="own-font">
																			<b>Address:</b>
																			<span class="own-font"><?php echo $_SESSION["clientAddress"]; ?></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<button id="btnCompletePurchase" type="button" class="btn btn-sm btn-primary waves-effect btn-label waves-light" style="width:100%"><i class="bx bxs-wallet-alt label-icon" style="color:#ffffff"></i> Complete Purchase</button>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">
														<button id="btnPurchaseList" type="button" class="btn btn-sm btn-warning waves-effect btn-label waves-light" style="width:100%"><i class="bx bx bx-list-ol label-icon" style="color:#ffffff"></i> View Purchased Transactions</button>
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
		
		
		<div id="mdRegistration" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title own-font" id="myModalLabel">Purchased Transactions</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<div class="row">
							<div class="col-md-2 col-xs-12">
								<span class="own-font">Total Price: </span>
								<h4 class="mb-3">
									P<span id="spTotalAmount2" class="counter-value">0</span>
								</h4>
							</div>
							<div class="col-md-2 col-xs-12">
								<span class="own-font">Total Item: </span>
								<h4 class="mb-3">
									<span id="spTotalItem2" class="counter-value">0</span>
								</h4>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-3 col-xs-12">
								<table id="tblRef" name="tblRef" class="table table-bordered nowrap w-100 dataTable no-footer dtr-inline own-font" style="width: 100% !important; margin-top: 0px !important;">
									<thead>
										<tr>
											<th>Reference Number</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							<div class="col-md-9 col-xs-12">
								<div class="table-container">
									<table id="tblRefItems" name="tblRefItems" class="table table-bordered nowrap w-100 dataTable no-footer dtr-inline own-font" style="width: 100% !important; margin-top: 0px !important;">
										<thead>
											<tr>
												<th>Item Name</th>
												<th>Price</th>
												<th>Qty</th>
												<th>Total</th>
												<th>Seller</th>
												<th>Status</th>
												<th>Delivery Date</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		
		<div id="mdReview" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title own-font" id="myModalLabel">Give Feedback and Rate</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<label class="form-label own-font">Product Name</label>
								<input id="txtItemNameRev" class="form-control form-control-sm own-font" type="text" placeholder="Enter Product Name" disabled>
							</div>
							<div class="col-md-8 col-sm-12">
								<label class="form-label own-font">Description</label>
								<input id="txtDescriptionRev" class="form-control form-control-sm own-font" type="text" placeholder="Enter Description" disabled>
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<label class="form-label own-font">Rate</label>
								<code>*</code>
								<input id="txtItemNameRate"  class="form-control form-control-sm own-font" type="number" placeholder="Enter Rate">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<label class="form-label own-font">Feedback</label>
								<code>*</code>
								<input id="txtFeedBack" class="form-control form-control-sm own-font" type="text" placeholder="Enter Feedback">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button id="btnSendFeedback" type="button" class="btn btn-sm btn-primary waves-effect btn-label waves-light">
							<i class="bx bxs-send label-icon" style="color:#ffffff"></i>
							Send Feedback
						</button>
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
				</div>
			</div>
		</div>
					

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
		
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
		
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

        <script src="../assets/js/app.js"></script>
		
		

        <!--<script src="../assets/js/ajax.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/sell.js?random=<?php echo uniqid(); ?>"></script>

    </body>
</html>
