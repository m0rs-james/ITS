<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Nav Item - Alerts -->
                <?php 
                    $notification = "SELECT *, COUNT(notification_id) as notif FROM notification WHERE status = 0";
                    $notificationResult = mysqli_query($db, $notification);
                    $result = mysqli_fetch_assoc($notificationResult);
                ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"><?php echo $result['notif'] ?></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifications
                        </h6>
                        
                        <?php 
                            $notification = "SELECT * FROM notification WHERE status = 0";
                            $notificationResult = mysqli_query($db, $notification);
                            
                            while ($resultRow = mysqli_fetch_assoc($notificationResult)) {
                                ?>
                                <a id="notif" class="dropdown-item d-flex align-items-center" style="cursor: pointer; text-decoration: none">
                                    <div>
                                        <input type="hidden" id="notifyID" name="id" value="<?php echo $resultRow['notification_id'] ?>"> 
                                        <div class="small text-gray-500"><?php $date = new DateTime($resultRow['updated_at']); echo $date->format('F j, Y g:i a'); ?></div>
                                        <span class="font-weight-bold">You receive a new order</span>
                                    </div>
                                </a>
                                <?php
                            }
                        ?>    
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
                <!-- Script for notification -->
                        <script type="text/javascript">
                        $(function () {
                            $("a[id='notif']").click(function () {
                                $("#notification").modal("show");
                                return false;
                            });
                            });
                        </script>
                                    
                        <!-- View notification Stock Modal -->
                        <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x ml-n3"></i>
                            </div>
                                <h5 class="modal-title" id="exampleModalLabel">New Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <form action="../process/notificationProcess.php?action=add" method="POST">
                                
                                <div class="modal-body">

                                <input type="hidden" name="notificationId">


                                <?php 
                                    $viewNotif = "SELECT * FROM notification INNER JOIN product ON notification.product_id = product.product_id";
                                    $viewNotifResult = mysqli_query($db, $viewNotif);

                                    $viewResult = mysqli_fetch_assoc($viewNotifResult);
                                ?>
                                
                                
                                <div class="form-group">
                                    <label> Customer Name </label>
                                    <input type="text" name="customer_name"  class="form-control" value="<?php echo $viewResult['customer_name'] ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label> Address </label>
                                    <input type="text" name="customer_address" id="customerAddress" class="form-control" value="<?php echo $viewResult['address'] ?>" readonly>
                                </div>

                                <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <!-- <th>SKU</th> -->
                                                <th>Product Name</th>
                                                <!-- <th>Total Quantity</th> -->
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="new_sales">
                                            <tr>
                                                <td>
                                                    <!-- <select name="product_id[]" id="productId" class="form-control product_id" readonly>
          
                                                        <option value="<?php echo $viewResult['product_id'] ?>"><?php echo $viewResult['product_name'] ?></option> 

                                                    </select> -->
                                                    <input type="hidden" name="product_id[]" id="productId" value="<?php echo $viewResult['product_id'] ?>">
                                                    <input type="text"  class="form-control" value="<?php echo $viewResult['product_name'] ?>" readonly> 

                                                </td>
                                            <td><input name="quantity[]" type="number" class="form-control" value="<?php echo $viewResult['quantity'] ?>" readonly></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                            
                                <div class="form-group">
                                    <label> Payment Type </label>

                                        <input type="hidden" name="payment_type" value="<?php echo $viewResult['payment_type'] ?>">
                                        <input type="text"  class="form-control" value="<?php if($viewResult['payment_type'] == 1) { echo "Cash"; } else { echo "Cash on Delivery"; } ?>" readonly>          
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <h6>Do you want to accept the order?</h4> 
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="send" class="btn btn-primary btn-sm">Accept</button>
                                </div>
                            </form>

                            </div>
                        </div>
                        </div>

                
                

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php 
                                    $message = "SELECT *, COUNT(shipment_id) as notif FROM shipment WHERE status = 1";
                                    $messageResult = mysqli_query($db, $message);
                                    $msgresult = mysqli_fetch_assoc($messageResult);
                                ?>
                                <span class="badge badge-danger badge-counter"><?php echo $msgresult['notif'] ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Messages
                                </h6>
                                <?php 
                                    // get login user data
                                    $userLoginSql = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id WHERE login_id = " . $_SESSION['login_id'];
                                    $userLoginResult = mysqli_query($db, $userLoginSql);
                                    $userLogin = mysqli_fetch_assoc($userLoginResult);
                                    //
                                    $notification = "SELECT * FROM shipment WHERE status = 1 LIMIT 4";
                                    $notificationResult = mysqli_query($db, $notification);
                                    
                                    while ($resultRow = mysqli_fetch_assoc($notificationResult)) {
                                ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="font-weight-bold">
                                            <div class="text-truncate" style="max-width: 300px;">Order has been Transfered to the courier.</div>
                                            <div class="small text-gray-500"><?php echo $userLogin['first_name'] . " " . $userLogin['last_name'] ?></div>
                                        </div>
                                    </a>
                                <?php 
                                }
                                ?>
                               
                                
                                
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']?></span>
                        <!-- <img class="img-profile rounded-circle"
                            src="../img/shock.jpg"> -->
                            <i class="fa fa-caret-down fa-1x text-gray-300 rounded-circle"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a> -->
                        <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a> -->
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>