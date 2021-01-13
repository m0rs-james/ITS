<?php

use function PHPSTORM_META\type;

// for navigation active link
$page = "account";

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add User Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-plus-circle fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/userProcess.php?action=add" method="POST">
            

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
                    <label> Address </label>
                    <input type="text" name="user_address" class="form-control" placeholder="Enter Address" required>
                </div>
                <!-- Phone number has a min and max of 11 digits -->
                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="number" name="user_number" class="form-control" placeholder="Enter Phone Number" required>
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

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-wrench fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/userProcess.php?action=edit" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="user_id" id="userId">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="first_name" id="firstName" class="form-control" placeholder="Enter New First Name" required>
                </div>
                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Enter New Last Name" required>
                </div>
                <div class="form-group">
                    <label> Address </label>
                    <input type="text" name="user_address" id="address" class="form-control" placeholder="Enter New Address" required>
                </div>
                <!-- Phone number has a min and max of 11 digits -->
                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="number" name="user_number" id="userNumber" class="form-control" placeholder="Enter New Phone Number" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="registerbtn" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
        
    </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fas fa-trash-alt fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteUser" action="../process/userProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="user_id" id="deleteId">

                <h4>Do you really want to delete this User?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteuserbtn" class="btn btn-danger">Yes</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                        Add User
                    </button>
                </h6>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Join Privileges table to Users table using INNER JOIN
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                                // Check if there's a record in database
                                if( mysqli_num_rows($result) == 0) {
                                    $_SESSION['status'] = "No data found";
                                    $_SESSION['status_code'] = "warning";
                                } 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['user_id'] ?></td>
                                        <td><?php echo $row['first_name'] ?></td>
                                        <td><?php echo $row['last_name'] ?></td>
                                        <td><?php echo $row['user_address'] ?></td>
                                        <td><?php echo $row['user_number'] ?></td>
                                        <td><button class="btn editbtn btn-info btn-sm"><i class="far fa-edit"></i>Edit</button>&nbsp
                                        <button class="btn deletebtn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button></td>
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
<!-- DataTable -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    } );
</script>

<!-- Edit script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#userTable').on('click', '.editbtn', function(){
            $('#editUser').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#userId').val(data[0]);
            $('#firstName').val(data[1]);
            $('#lastName').val(data[2]);
            $('#address').val(data[3]);
            $('#userNumber').val(data[4]);;
        });
    });
</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#userTable').on('click', '.deletebtn', function() {
            $('#deleteUser').modal('show');

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