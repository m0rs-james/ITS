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
            <h5 class="modal-title" id="exampleModalLabel">Add Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="code.php" method="POST">
            

            <div class="modal-body">
                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="email" name="email" class="form-control checking_email" placeholder="Enter Last Name">
                    <small class="error_email" style="color: red;"></small>
                </div>
                <div class="form-group">
                    <label>Street</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Street Address">
                </div>
                <div class="form-group">
                    <label>Barangay</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Barangay Address">
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter City Address">
                </div>
                <div class="form-group">
                    <label>Zip Code</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Zip Code">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Phone Number">
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
                <h6 class="m-0 font-weight-bold- text-primary"> Account
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Customer
                    </button>
                </h6>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Street</th>
                                <th>Barangay</th>
                                <th>City</th>
                                <th>Zip Code</th>
                                <th>Phone Number</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1601528</td>
                                <td>James</td>
                                <td>Faelden</td>
                                <td>Amapola Street</td>
                                <td>Pembo</td>
                                <td>Makati City</td>
                                <td>1218</td>
                                <td>09123456789</td>
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