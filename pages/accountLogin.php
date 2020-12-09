<?php


include '../includes/header.php';
include '../includes/sidebar.html';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add Login Modal -->
    <div class="modal fade" id="addLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Login Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/loginProcess.php?action=add" method="POST">
            

            <div class="modal-body">

                <div class="form-group">
                    <label> Employee Name </label>
                    <select name="employee_id" class="form-control" required> 
                        <option value="">Choose the Employee</option>
                            <?php 
                            $sql = "SELECT * FROM users ORDER BY first_name";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['user_id']?>"><?php echo $row['first_name'] . " " . $row['last_name']?></option>
                                <?php 
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label> Password </label>
                    <input type="text" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                <label> Privilege </label>
                    <select name="privilege_id" class="form-control" required> 
                        <option value="">Choose the Privilege</option>
                            <?php 
                            $sql = "SELECT * FROM privileges ORDER BY privileges_name";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['privileges_id']?>"><?php echo $row['privileges_name']?></option>
                                <?php 
                            }
                            ?>
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

    <!-- Edit Login Modal -->
    <div class="modal fade" id="editLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Login Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/loginProcess.php?action=edit" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="login_id" id="loginId">

                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="username" id="userName" class="form-control" placeholder="Enter New Username" required>
                </div>
                <div class="form-group">
                    <label> New Password </label>
                    <input type="text" name="password" id="passWord" class="form-control" placeholder="Enter New Password" required>
                </div>
                <div class="form-group">
                    <label> Confirm New Password </label>
                    <input type="text" name="repeat_password" id="repeatPassword" class="form-control" placeholder="Enter New Password again" required>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="editloginbtn" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Delete Login Modal -->
    <div class="modal fade" id="deleteLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Login Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteBrand" action="../process/loginProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="login_id" id="deleteId">

                <h4>Do you want to delete this Login?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteloginbtn" class="btn btn-danger">Yes</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLogin">
                        Add Login
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Login ID</th>
                                <th>Employee Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Privilege</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id 
                                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id"; 
                                $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['login_id'] ?></td>
                                        <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['password'] ?></td>
                                        <td><?php echo $row['privileges_name'] ?></td>
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

<!-- Edit Script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editLogin').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#loginId').val(data[0]);
            /* $('#employeeId').val(data[1]); */
            $('#userName').val(data[2]);
            /* $('#passWord').val(data[3]); */
            /* $('#privilegeId').val(data[4]); */
        });
    });

</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {
            $('#deleteLogin').modal('show');

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