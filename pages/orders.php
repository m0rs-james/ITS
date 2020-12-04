<?php
include '../includes/header.html';
include '../includes/sidebar.html';
include '../includes/topbar.html';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">
    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Order Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="code.php" method="POST">
            

            <div class="modal-body">
                <div class="form-group">
                    <label> Customer Name </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label>Product</label>
                    <input type="email" name="email" class="form-control checking_email" placeholder="Enter Last Name">
                    <small class="error_email" style="color: red;"></small>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label>Subtotal</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label>Order Date</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label>Courier Name</label>
                    <select name="" id="" class="form-control">
                        <option value="">Ninja Van</option>
                        <option value="">Lalamove</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Shipping Address</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label>Payment Status</label>
                    <select name="" id="" class="form-control">
                        <option value="">Due</option>
                        <option value="">Paid</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
        
    </div>
    
    </div>

    <div class="contatiner-fluid">
        <!-- Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold- text-primary"> Orders
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Order
                    </button>
                </h6>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Order Date</th>
                                <th>Courier Name</th>
                                <th>Shipping Address</th>
                                <th>Total</th>
                                <th>Payment Status</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>7135320</td>
                                <td>James Faelden</td>
                                <td>Safeguard Fresh Green soap with Family Germ Protection</td>
                                <td>2</td>
                                <td>₱100.00</td>
                                <td>12/03/2020 12:00PM</td>
                                <td>Ninja Van</td>
                                <td>Amapola Street Pembo, Makati City 1218</td>
                                <td>₱150.00</td>
                                <td><p class="px-3 py-1 bg-gradient-success text-white">Paid</p></td>
                                <td><button class="btn btn-info">Edit</button>&nbsp<button class="btn btn-danger">Delete</button></td>
                            </tr>
                            <tr>
                                <td>8217420</td>
                                <td>Jonathan Narag</td>
                                <td>Kojic Acid Soap with Glutathione</td>
                                <td>1</td>
                                <td>₱89.00</td>
                                <td>12/03/2020 09:00AM</td>
                                <td>Lalamove</td>
                                <td>Molave Street North Signal, Taguig City 1630</td>
                                <td>₱139.00</td>
                                <td><p class="px-3 py-1 bg-gradient-warning text-white">Due</p></td>
                                <td><button class="btn btn-info">Edit</button>&nbsp<button class="btn btn-danger">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- This div is not connected to anything but it fixes the position of the footer -->
</div>

<!-- End of contatiner fluid -->

<?php
    include '../includes/footer.php';
?>