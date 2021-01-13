<?php
include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/customerProcess.php?action=add" method="POST">
            
            <div class="modal-body">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                    <label> Street </label>
                    <input type="text" name="street" class="form-control" placeholder="Enter Street Name" required>
                </div>
                <div class="form-group">
                    <label> Barangay </label>
                    <input type="text" name="barangay" class="form-control" placeholder="Enter Barangay Name" required> 
                </div>
                <div class="form-group">
                    <label> City </label>
                    <input type="text" name="city" class="form-control" placeholder="Enter City Name" required>
                </div>
                <div class="form-group">
                    <label> Zip Code </label>
                    <input type="number" name="zip_code" class="form-control" placeholder="Enter Zip Code" required>
                </div>
                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="number" name="phone_number" class="form-control" placeholder="Enter Phone Number" required>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addbtn" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
        
    </div>
    </div>

    <!-- Edit Customer Modal -->
    <div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/customerProcess.php?action=edit" method="POST">
            
            <div class="modal-body">

                <input type="hidden" name="customer_id" id="customerId">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="first_name" id="firstName" class="form-control" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                    <label> Street </label>
                    <input type="text" name="street" id="street" class="form-control" placeholder="Enter Street Name" required>
                </div>
                <div class="form-group">
                    <label> Barangay </label>
                    <input type="text" name="barangay" id="barangay" class="form-control" placeholder="Enter Barangay Name" required> 
                </div>
                <div class="form-group">
                    <label> City </label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter City Name" required>
                </div>
                <div class="form-group">
                    <label> Zip Code </label>
                    <input type="number" name="zip_code" id="zipCode" class="form-control" placeholder="Enter Zip Code" required>
                </div>
                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="number" name="phone_number" id="phoneNumber" class="form-control" placeholder="Enter Phone Number" required>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addbtn" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
        
    </div>
    </div>

    <!-- Delete Customer Modal -->
    <div class="modal fade" id="deleteCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteBrand" action="../process/customerProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="customer_id" id="deleteId">

                <h4>Do you want to delete this Customer?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deletecustomerbtn" class="btn btn-danger">Yes</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">
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
                            <?php
                                $sql = "SELECT * FROM customer";
                                $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                                // Check if there's a record in database
                                if( mysqli_num_rows($result) == 0) {
                                    $_SESSION['status'] = "No data found";
                                    $_SESSION['status_code'] = "warning";
                                } 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['customer_id'] ?></td>
                                        <td><?php echo $row['cust_first_name'] ?></td>
                                        <td><?php echo $row['cust_last_name'] ?></td>
                                        <td><?php echo $row['cust_street'] ?></td>
                                        <td><?php echo $row['cust_barangay'] ?></td>
                                        <td><?php echo $row['cust_city'] ?></td>
                                        <td><?php echo $row['cust_zip_code'] ?></td>
                                        <td><?php echo $row['cust_number'] ?></td>
                                        <td><button class="btn editbtn btn-info">Edit</button>&nbsp
                                        <button class="btn deletebtn btn-danger">Delete</button></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- This div is not connected to anything but it fixes the position of the footer -->
</div>

<!-- ajax script for popup modal & sweetAlert -->
<?php
    include '../includes/scripts2.php';
?>

<!-- Edit script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editCustomer').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#customerId').val(data[0]);
            $('#firstName').val(data[1]);
            $('#lastName').val(data[2]);
            $('#street').val(data[3]);
            $('#barangay').val(data[4]);
            $('#city').val(data[5]);
            $('#zipCode').val(data[6]);
            $('#phoneNumber').val(data[7]);
        });
    });

</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {
            $('#deleteCustomer').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#deleteId').val(data[0]);
            
        });
    });
</script>

<!-- End of contatiner fluid -->

<?php
    include '../includes/footer.php';
?>