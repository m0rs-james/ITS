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
            <h5 class="modal-title" id="exampleModalLabel">Add Login Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="code.php" method="POST">
            

            <div class="modal-body">

                <div class="form-group">
                    <label> Employee ID </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Employee ID">
                </div>
                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label> Password </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label> Confirm Password </label>
                    <input type="text" name="username" class="form-control" placeholder="Confirm Password">
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
                        Add Login
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TestAccount</td>
                                <td>***********</td>
                                <td>James Faelden</td>
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