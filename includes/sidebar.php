<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../pages/dashboard.php">
            <div class="sidebar-brand-icon rotate-n-0">
                <i class="fas fa-magicx">
					<div class="bgaol m-auto">
				        <img src="../img/logo.jpg" class="rounded-circle" width="50" height="50">
				    </div>
				</i>
            </div>
            <div class="sidebar-brand-text mx-1">Skin Magical <sup>Southside</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php echo ($page == "dashboard" ? "active" : "")?>">
            <a class="nav-link" href="../pages/dashboard.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Order Collapse Menu -->
        <li class="nav-item <?php echo ($page == "sales" ? "active" : "")?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Sales</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                
                    <a class="collapse-item" href="../pages/sales.php">Sales</a>
                    

                    <h6 class="collapse-header">Product:</h6>

                    <a class="collapse-item" href="../pages/product.php">Products</a>
                    <a class="collapse-item" href="../pages/productCategory.php">Category</a>

                    <h6 class="collapse-header">Delivery:</h6>
                    <a class="collapse-item" href="../pages/deliveryShipment.php">Shipment</a>
                    <a class="collapse-item" href="../pages/deliveryCourier.php">Courier</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Accounts
        </div> -->

        <?php
            if ($_SESSION['type'] != 1) {

            } else {
                ?>
                <li class="nav-item <?php echo ($page == "account" ? "active" : "")?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Accounts</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../pages/accountUsers.php">Users</a>
                            <a class="collapse-item" href="../pages/accountLogin.php">Login</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <?php
            }
        ?>
        
        <!-- Activity Log -->
        <?php
            if ($_SESSION['type'] != 1) {

            } else {
                ?>
                <li class="nav-item <?php echo ($page == "report" ? "active" : "")?>">
                    <a class="nav-link" href="../pages/accountActivityLog.php">
                        <i class="fa fa-users"></i>
                        <span>Activity Log</span></a>
                </li>
                <?php
            }
        ?>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card">
            <!-- <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt=""> -->
            <p class="text-center mb-2"><strong>Hello</strong> need help?</p>
            <a class="btn btn-success btn-sm" href="#">Contact Us!</a>
        </div>
    </ul>