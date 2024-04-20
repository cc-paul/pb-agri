<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Agri-Merchants</span>
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Agri-Merchants</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <?php
                if (!isset($_GET["man"])) {
                    $search = "";
                    
                    if (isset($_GET["search"])) {
                        if ($_GET["search"] == "" || $_GET["search"] != "") {
                            $search = $_GET["search"];
                        }
                    }
                    
                    ?>
                        <div class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input id="txtSearch" name="txtSearch" type="text" class="form-control" placeholder="Search..." value="<?php echo $search; ?>">
                                <button id="btnSearch" class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button  type="button" class="btn header-item" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <div class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input id="txtSearchSmall" type="text" class="form-control" placeholder="Search ..." aria-label="Search Result" value="<?php echo $search; ?>"> 

                                <button id="btnSearchSmall" class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>


            <!--<div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="../assets/images/users/defau.jpg"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Shawn L.</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-credit-card-outline font-size-16 align-middle me-1"></i> Billing</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-settings font-size-16 align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>-->

        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="index" id="topnav-dashboard" role="button">
                            <i data-feather="home"></i><span data-key="t-dashboards">Home</span>
                        </a>
                    </li>
                    
                    <?php
                        if (isset($_SESSION["isClientLogin"])) {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="profile.php" id="topnav-dashboard" role="button">
                                        <i data-feather="user"></i><span data-key="t-dashboards">Account</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="cart.php" id="topnav-dashboard" role="button">
                                        <i data-feather="shopping-cart"></i><span data-key="t-dashboards">Cart</span>
                                    </a>
                                </li>
                                
                                 <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="message.php" id="topnav-dashboard" role="button">
                                        <i data-feather="message-circle"></i><span data-key="t-dashboards">Message</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="logout.php" id="topnav-dashboard" role="button">
                                        <i data-feather="log-out"></i><span data-key="t-dashboards">Logout</span>
                                    </a>
                                </li>
                            <?php
                        } else {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="register.php" id="topnav-dashboard" role="button">
                                        <i data-feather="edit"></i><span data-key="t-dashboards">Register</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="login.php" id="topnav-dashboard" role="button">
                                        <i data-feather="lock"></i><span data-key="t-dashboards">Login</span>
                                    </a>
                                </li>
                            <?php
                        }
                    ?>
                
                </ul>
            </div>
        </nav>
    </div>
</div>

<script src="../assets/libs/jquery/jquery.min.js"></script>
<script type="application/x-javascript">
    $('#txtSearch').keyup(function (e) {
        if(e.keyCode == 13) {
            var url = "index?search=" + this.value;
            //alert(url);
            window.location.href = url;
        }
    });
    
    $("#btnSearch").click(function(){
        var url = "index?search=" + $("#txtSearch").val();
        window.location.href = url;
    });
    
    $("#btnSearchSmall").click(function(){
        var url = "index?search=" + $("#txtSearchSmall").val();
        window.location.href = url;
    });
</script>