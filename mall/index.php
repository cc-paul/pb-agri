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

			.modal-content-img {
				margin: auto;
				display: block;
				width: 80%;
				max-width: 700px;
			}

			.modal-content-img { 
				animation-name: zoom;
				animation-duration: 0.6s;
			}
			
			@keyframes zoom {
				from {transform:scale(0)} 
				to {transform:scale(1)}
			}

			#img-viewer {
				display: none;
				position: fixed;
				z-index: 1000;
				padding-top: 100px;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: rgb(0,0,0);
			}
			
			#img-viewer .close {
				position: absolute;
				top: 15px;
				right: 35px;
				color: #f1f1f1;
				font-size: 40px;
				font-weight: bold;
				transition: 0.3s;
			}

			#img-viewer .close:hover{
				cursor: pointer;
			}
			
			.img-container{
				position:relative;
				width:300px;
			}
			.img-source{
				border:5px solid #ccc;
				border-radius:5px;
				width: 100%;
			}
			.expand-icon{
				position:absolute; 
				right:26px; 
				top:15px; 
				cursor:pointer;
			}
			
			.banner-custom {
				height:250px !important;
				width:100%;
				object-fit: cover;
				border-radius:0.25rem;
			}
			
			#fixedbutton {
				position: fixed;
				bottom: 0px;
				right: 0px;
				height: 50px;
				width: 50px;
				opacity: 1;
				margin: 10px;
				background-color: #5156be !important;
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

						<?php
							include '../code/php/connection/conn.php';
							
							$sql    = "
								SELECT
									a.id,
									a.category
								FROM
									eb_category a
								INNER JOIN
									eb_products b
								ON
									b.categoryID = a.id
								WHERE
									a.isActive = 1
								AND
									a.isSub = 0 
								AND
									a.id IN (SELECT categoryID FROM eb_products WHERE isActive = 1)
								GROUP BY
									a.id
								ORDER BY
									a.category ASC;
							";
							$result = mysqli_query($con,$sql);
							
							$jsonCategory = array();
							while ($row  = mysqli_fetch_row($result)) {
								$jsonCategory[] = array(
									'id'        => $row[0],
									'category'  => $row[1],
								);
							}

						?>

						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-inner" role="listbox">
										<div class="carousel-item">
											<img class="d-block img-fluid mx-auto banner-custom" src="https://i.pinimg.com/originals/bd/a5/e2/bda5e2a411b87e0dc47feec461adb919.jpg" alt="First slide">
										</div>
										<div class="carousel-item">
											<img class="d-block img-fluid mx-auto banner-custom" src="https://bonfruit.ca/wp-content/uploads/2020/05/280262173de9e218d47140e25de7ffeb.jpg" alt="Second slide" style="height:200px;">
										</div>
										<div class="carousel-item active">
											<img class="d-block img-fluid mx-auto banner-custom" src="https://cdn.rentokil.com/content/global/images/desktop/main_farming-agriculture-banner.jpg" alt="Third slide" style="height:200px;">
										</div>
									</div>
									<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
						</div>
						<br>
						<br>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="card">
                                    <div class="card-header">
                                        <div class="row">
											<div class="col-md-6 col-sm-6">
												<h4 class="card-title" style="margin-top: 3px;">Agricultural Products</h4>
											</div>
											<div class="col-md-6 col-sm-6">
												<i class="mdi mdi-leaf" style="float: right; font-size:20px;"></i>
											</div>
										</div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
													<a class="nav-link mb-2 active" id="v-pills-0-tab" data-toggle="pill" href="#v-pills-0" role="tab" aria-controls="v-pills-home" aria-selected="false" tabindex="-1">
														All Products
													</a>
													
													<?php
														$indexTitle = 0;
													
														foreach($jsonCategory as $category){
															?>
																<a class="nav-link mb-2" id="v-pills-<?php echo $category["id"]; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category["id"]; ?>" role="tab" aria-controls="v-pills-home" aria-selected="false" tabindex="-1">
																	<?php echo $category["category"];  ?>
																</a>
															<?php
															$indexTitle++;
														}
													?>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-md-10">
                                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
													<div class="tab-pane fade active show" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-0-tab">
														<p>
															<div class="row">
																<?php
																	$query_product = "";
																	$count = 0;
					
																	if (isset($_GET["search"])) {
																		if ($_GET["search"] != "") {																				
																			$query_product = "
																				AND
																					MATCH(a.itemName) AGAINST ('".$_GET["search"]."*' IN BOOLEAN MODE)
																			";
																		}
																	}
																	
																	$sql    = "
																		SELECT
																			a.itemName,
																			REPLACE(FORMAT(a.retailPrice,2),'.00','') AS retailPrice,
																			b.companyName,
																			IFNULL((SELECT fileName FROM eb_product_image WHERE productID = a.id AND isActive = 1 ORDER BY id LIMIT 1),'default') AS image,
																			a.id,
																			a.description,
																			a.howToUse,
																			FORMAT(a.stocks,0) AS stocks
																		FROM
																			eb_products a
																		INNER JOIN
																			eb_company_profile b
																		ON
																			a.createdBy = b.createdBy
																		INNER JOIN
																			eb_category c
																		ON
																			a.categoryID = c.id AND c.isSub = 0 
																		WHERE 1 
																		$query_product
																		AND
																			a.isActive = 1
																		ORDER BY
																			a.dateCreated ASC
																		LIMIT 30
																	";
																	$result = mysqli_query($con,$sql);
																	
																	while ($row  = mysqli_fetch_row($result)) {
																		$itemName = $row[0];
																		$retailPrice = "P" . $row[1];
																		$companyName = $row[2];
																		$image = $row[3];
																		$count++;
																		
																		?>
																		<!--<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab" role="tablist" aria-orientation="vertical" onclick="getDetails(<?php echo $row[4]; ?>);">
																				<a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill" href="#v-price-one" role="tab" aria-controls="v-price-one" aria-selected="true">
																					<div class="d-flex align-items-center">
																						<img class="img-thumbnail" alt="200x200" width="100" src="../assets/product/product-<?php echo $image . ".jpg"?>" data-holder-rendered="true">
																						&nbsp;&nbsp;&nbsp;&nbsp;
																						<div class="flex-1">
																							<h2 class="fw-medium"><?php echo $retailPrice; ?><span class="text-muted font-size-12">/ <?php echo $itemName;  ?></span></h2>
																							<p class="fw-normal mb-0 text-muted font-size-12"><?php echo $companyName; ?></p>
																							
																							
																							<?php
																								if (isset($_GET["search"])) {
																									if ($_GET["search"] == $row[5]) {
																										?>
																											<span class="badge bg-primary">
																												<?php
																													echo $row[5];
																												?>
																											</span>
																										<?php
																									}
																								}
																							?>
																						</div>
																					</div>
																				</a>
																			</div>
																		</div>-->
																		<div class="col-md-2">
																			<div class="card p-1 mb-xl-0">
																				<div class="p-3">
																					<div class="d-flex align-items-start">
																						<div class="flex-grow-1 overflow-hidden">
																							<h5 class="font-size-15 text-truncate"><a href="#" class="text-dark"><?php echo $itemName;  ?></a></h5>
																							<p class="font-size-13 text-muted mb-0"><b>Price :</b><?php echo $retailPrice; ?></p>
																							<p class="font-size-13 text-muted mb-0"><b>Stocks :</b> <?php echo $row[7]; ?></p>
																						</div>
																					</div>
																				</div>
																				
																				<div class="position-relative">
																					<img src="../assets/product/product-<?php echo $image . ".jpg"?>" alt="" class="img-thumbnail" style="max-height: 150px; height: 150px; width: 100%;">
																				</div>
				
																				<div class="p-3">
																					
																					<p class="text-muted text-truncate">
																						<?php echo $companyName; ?>
																					</p>
					
																					<div>
																						<a id="aReadMore<?php echo $row[4]; ?>" href="javascript: void(0);" onclick="getDetails(<?php echo $row[4]; ?>);" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
																					</div>
																					<div>
																						<a id="aReview<?php echo $row[4]; ?>" href="javascript: void(0);" onclick="getReview(<?php echo $row[4]; ?>);" class="text-primary">Customer Review <i class="mdi mdi-arrow-right"></i></a>
																					</div>
																				</div>
																			</div>
																			<br>
																		</div>
																		<?php
																	}
																	
																	if ($count == 0) {
																		?>
																			<div class="col-md-12 col-xs-12">
																				<center style="margin-top: 5%;">
																					<!--<img  src="../assets/product/nproduct.png" style="width: 50%; height:50%">-->
																					<span class="badge bg-primary" style="font-size: 30px;">No Products Found</span>
																				</center>
																			</div>
																		<?php
																	}
																?>
															</div>
														</p>
													</div>
													
													<?php
														$indexDiv = 0;
													
														foreach($jsonCategory as $category){
															?>
																<div class="tab-pane fade" id="v-pills-<?php echo $category["id"]; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category["id"]; ?>-tab">
																	<p>
																		<div class="row">
																			<?php
																				$query_product = "";
																				$count = 0;
                                
																				if (isset($_GET["search"])) {
																					if ($_GET["search"] != "") {																				
																						$query_product = "
																							AND
																								MATCH(a.itemName) AGAINST ('".$_GET["search"]."*' IN BOOLEAN MODE)
																						";
																					}
																				}
																				
																				$sql    = "
																					SELECT
																						a.itemName,
																						REPLACE(FORMAT(a.retailPrice,2),'.00','') AS retailPrice,
																						b.companyName,
																						IFNULL((SELECT fileName FROM eb_product_image WHERE productID = a.id AND isActive = 1 ORDER BY id LIMIT 1),'default') AS image,
																						a.id,
																						a.description,
																						a.howToUse
																					FROM
																						eb_products a
																					INNER JOIN
																						eb_company_profile b
																					ON
																						a.createdBy = b.createdBy
																					INNER JOIN
																						eb_category c
																					ON
																						a.categoryID = c.id
																					WHERE 1 
																					$query_product
																					AND
																						a.isActive = 1
																					AND
																						c.id = ".$category["id"]."
																					ORDER BY
																						a.dateCreated ASC
																				";
																				
																				
																				$result = mysqli_query($con,$sql);
																				
																				while ($row  = mysqli_fetch_row($result)) {
																					$itemName = $row[0];
																					$retailPrice = "P" . $row[1];
																					$companyName = $row[2];
																					$image = $row[3];
																					$count++;
																					
																					?>
																					<!--<div class="col-md-4 col-sm-12 col-xs-12">
																						<div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab" role="tablist" aria-orientation="vertical" onclick="getDetails(<?php echo $row[4]; ?>);">
																							<a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill" href="#v-price-one" role="tab" aria-controls="v-price-one" aria-selected="true">
																								<div class="d-flex align-items-center">
																									<img class="img-thumbnail" alt="200x200" width="100" src="../assets/product/product-<?php echo $image . ".jpg"?>" data-holder-rendered="true">
																									&nbsp;&nbsp;&nbsp;&nbsp;
																									<div class="flex-1">
																										<h2 class="fw-medium"><?php echo $retailPrice; ?><span class="text-muted font-size-12">/ <?php echo $itemName;  ?></span></h2>
																										<p class="fw-normal mb-0 text-muted font-size-12"><?php echo $companyName; ?></p>
																										
																										
																										<?php
																											if (isset($_GET["search"])) {
																												if ($_GET["search"] == $row[5]) {
																													?>
																														<span class="badge bg-primary">
																															<?php
																																echo $row[5];
																															?>
																														</span>
																													<?php
																												}
																											}
																										?>
																									</div>
																								</div>
																							</a>
																						</div>
																					</div>-->
																					<div class="col-md-2">
																						<div class="card p-1 mb-xl-0">
																							<div class="p-3">
																								<div class="d-flex align-items-start">
																									<div class="flex-grow-1 overflow-hidden">
																										<h5 class="font-size-15 text-truncate"><a href="#" class="text-dark"><?php echo $itemName;  ?></a></h5>
																										<p class="font-size-13 text-muted mb-0"><?php echo $retailPrice; ?></p>
																									</div>
																								</div>
																							</div>
																							
																							<div class="position-relative">
																								<img src="../assets/product/product-<?php echo $image . ".jpg"?>" alt="" class="img-thumbnail" style="max-height: 150px; height: 150px; width: 100%;">
																							</div>
							
																							<div class="p-3">
																								
																								<p class="text-muted text-truncate">
																									<?php echo $companyName; ?>
																								</p>
								
																								<div>
																									<a id="aReadMore<?php echo $row[4]; ?>" href="javascript: void(0);" onclick="getDetails(<?php echo $row[4]; ?>);" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
																								</div>
																							</div>
																						</div>
																						<br>
																					</div>
																					<?php
																				}
																				
																				if ($count == 0) {
																					?>
																						<div class="col-md-12 col-xs-12">
																							<center style="margin-top: 5%;">
																								<!--<img  src="../assets/product/nproduct.png" style="width: 50%; height:50%">-->
																								<span class="badge bg-primary" style="font-size: 30px;">No Products Found</span>
																							</center>
																						</div>
																					<?php
																				}
																			?>
																		</div>
																	</p>
																</div>
															<?php
															$indexDiv++;
														}
													?>
                                                </div>
                                            </div><!--  end col -->
                                        </div><!-- end row -->
                                    </div><!-- end card-body -->
                                </div>
								<br>
								<div class="row">
									<div class="col-md-12 col-xs-12">
											<div class="card">
												<div class="card-header">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<h4 class="card-title" style="margin-top: 3px;">Manufacturers</h4>
														</div>
														<div class="col-md-6 col-sm-6">
															<i class="mdi mdi-factory" style="float: right; font-size:20px;"></i>
														</div>
													</div>
												</div><!-- end card header -->
			
												<div class="card-body">
													<div class="row icon-demo-content" id="solid">
														<?php
															$count_man = 0;
															$query_man = "";
														
																if (isset($_GET["search"])) {
																	if ($_GET["search"] == "" || $_GET["search"] != "") {
																		$query_man = " AND a.manufacturersName LIKE '%" . $_GET["search"] . "%'";
																	}
																}
																	
															?>
															<div class="row">
																<?php		
																	$sql    = "
																		SELECT
																			UPPER(a.manufacturersName) AS manufacturersName
																		FROM
																			eb_products a
																		WHERE 1
																			$query_man
																		GROUP BY
																			a.manufacturersName
																		ORDER BY
																			a.manufacturersName
																	";
																	$result = mysqli_query($con,$sql);
																																								
																	while ($row  = mysqli_fetch_row($result)) {		
																		$count_man++;
																		?>
																			<div class="col-xl-2 col-lg-4 col-sm-6 text-truncate" style="cursor:pointer;">
																				<a href="manufacturer?man=<?php echo $row[0] ?>">
																					<i class="mdi mdi-factory"></i> <?php echo $row[0]; ?>
																				</a>
																			</div>
																		<?php
																	}
																?>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<?php
																		if ($count_man == 0) {
																			?>
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<center>
																							<!--<img  src="../assets/product/nproduct.png" style="width: 50%; height:50%">-->
																							<span class="badge bg-primary" style="font-size: 30px;">No Manufacturers Found</span>
																						</center>
																					</div>
																				</div>
																			<?php
																		}
																	?>
																</div>
															</div>
															<?php
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
		
		<div class="modal fade" id="mdItemDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title cust-label" id="staticBackdropLabel">Product Details</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div id="img-viewer">
								<span class="close" onclick="close_model()">&times;</span>
								<img class="modal-content-img" id="full-image" >
							</div>
							<div class="col-md-4 col-xs-12" style="height:250px;">
								<img id="imgProduct" class="img-thumbnail my-image" alt="200x200" width="100" src="../assets/product/product-default.jpg" data-holder-rendered="true" style="height: 100% !important; width: 100%; max-height: 100%;">
								<!--<img src="data:image/jpeg;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYEAYAAACw5+G7AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAABgAAAAYADwa0LPAAAAB3RJTUUH5gcBDC8iyDNppwAAAURJREFUWMPtmLFSAjEURY+U9jDwJfyIpY2FLa2lv2HnL1jaysIMDFRQ8AeW2ug4sci1YJfBYdd9gSysw94mszNJ3r152ZebIO8eYDKRnAPJ0A4gSYgMyd3DeGzmkfJuccEN9PsBsb5Aii0AeAfvzb0z3sUKvy9htZI+X6DXq4Dwn5CXh3Zbcq+wWBTxzBPwBsvlzrf/uIZOp3ri6ziFPEoFFCmvOCOGuFfQ7ZYKCJgwihAr8U3/HAEDSBLJ3cJwGJzSPbfWvvOW8T1kpUwZCV3x6ChcOe+eYDYrHS/3DPP5qYrErpCUuDWlmy2QjTs28QYNGqyxVY2yqmJyqZK7g9HoZD/xvy2jsQ6g6BZl6yKRuwVqaCV+8z3AzEU58kMzEsNOV+JVrELO4EJzbHcYmhGzgLq/SqRtC/EI02lArHq8SqS8fwCukS3bLvmYtAAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMi0wNy0wMVQxMjo0NzozNCswMDowMBMMqp4AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjItMDctMDFUMTI6NDc6MzQrMDA6MDBiURIiAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIyLTA3LTAxVDEyOjQ3OjM0KzAwOjAwNUQz/QAAAABJRU5ErkJggg=="  class='expand-icon' onclick="full_view(this);" >-->
								<button type="button" class="btn btn-sm btn-primary waves-effect waves-light expand-icon" onclick="full_view(this);"><i class="bx bx-expand font-size-16 align-middle"></i></button>
							</div>
							<div class="col-md-8 col-xs-12">
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Category:</b>
											<span id="spCategory" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Product Name:</b>
											<span id="spProductName" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Manufacturer:</b>
											<span id="spManufacturer" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Manufacturing Date:</b>
											<span id="spManufacturingDate" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Expiration Date:</b>
											<span id="spExpirationDate" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Retail Price:</b>
											<span id="spRetailPrice" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Stocks:</b>
											<span id="spStocks" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>FDA:</b>
											<span id="spFDA" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col-xl-12">
										<div class="own-font">
											<b>Description:</b>
											<br>
											<span id="spDescription" class="own-font">{{ Value Here }}</span>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-3 col-sm-12">
										<a id="aVideo1" class="form-check-label own-font"  target="_blank">Play Video</a>
									</div>
									<div class="col-md-6 col-sm-12">
										<a id="aYoutube1" class="form-check-label own-font"  target="_blank">Play Youtube</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<?php
							if (!isset($_SESSION["isClientLogin"])) {
								?>
									<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert" style="width:100%">
										<i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Info</strong> - Wanna buy this item? Please create an account or login to purchase our products or <a id="aKnowMore" href="#" onclick="return false;" style="text-decoration: underline !important;"><b>click here to know more about this product</b></a>
									</div>
								<?php
							} else {
								?>
									<div class="row" style="width:100%">
										<div class="col-xl-3 col-xs-12"></div>
										<div class="col-xl-3 col-xs-12">
											<button id="btnInfo" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-info-circle label-icon"></i>How to use</button>
										</div>
										<div class="col-xl-3 col-xs-12">
											<button id="btnContactSeller" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-message label-icon"></i>Contact Seller</button>
										</div>
										<div class="col-xl-3 col-xs-12">
											<button id="btnAddtoCart" type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light" style="width: 100%;"><i class="bx bx-cart label-icon"></i>Add to Cart</button>
										</div>
									</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<div id="btnOpenChatBot" style="cursor:pointer;">
			<span id="fixedbutton" class="avatar-title rounded-circle bg-soft-primary text-primary">
				<i class="mdi mdi-chat" style="font-size: 30px; color: #fff;"></i>
			</span>
		</div>
		
		<div class="modal fade" id="mdChat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title cust-label" id="staticBackdropLabel" style="margin-left: 12px;">Agri-Merchants Virtual Chatbot</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="dvChatArea" class="modal-body" style="height: 400px; max-height: 400px; overflow: auto;">
						
						
					</div>
					<div id="dvChatFooter" class="modal-footer">
						<div class="row" style="width: 100%;">
							<div class="col-md-8">
								<input id="txtChatMessage" type="text" class="form-control border bg-soft-light own-font" placeholder="Enter Message here or type 'Get Started' to continue..." style="width:100%;">
							</div>
							<div class="col-md-4">
								<button id="btnSend" style="width: 100%;" type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light own-font"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="mdReview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title cust-label" id="staticBackdropLabel" style="margin-left: 12px;">Item Reviews</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="dvReviewArea" class="modal-body" style="height: 400px; max-height: 400px; overflow: auto;">
						
						
					</div>
					<div id="dvChatFooter" class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>

        <!-- JAVASCRIPT -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../assets/js/app.js"></script>
		<script src="../code/js/startup.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/sell.js?random=<?php echo uniqid(); ?>"></script>
		<script src="../code/js/chatbot.js?random=<?php echo uniqid(); ?>"></script>

        <!--<script src="../assets/js/ajax.js"></script>-->

    </body>
</html>
