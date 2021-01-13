<?php
// for navigation active link
$page = "sales";

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-plus-circle fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productCategory" action="../process/categoryProcess.php?action=add" method="POST">          

            <div class="modal-body">

                <div class="form-group">
                    <label> Category Name </label>
                    <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="categorybtn" class="btn btn-primary">Save</button>
            </div>
        </form>
        

        </div>
    </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-wrench fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productCategory" action="../process/categoryProcess.php?action=edit" method="POST">          
            
            <div class="modal-body">

                <input type="hidden" name="category_id" id="categoryId">

                <div class="form-group">
                    <label> Category Name </label>
                    <input type="text" name="category_name" id="categoryName" class="form-control" placeholder="Enter New Category Name" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="editCategory" class="btn btn-primary">Update</button>
            </div>
        </form>
        

        </div>
    </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fas fa-trash-alt fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productCategory" action="../process/categoryProcess.php?action=delete" method="POST">          
            
            <div class="modal-body">

                <input type="hidden" name="category_id" id="deleteId">
                <h4>Do you really want to delete this category?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteCategory" class="btn btn-danger">Yes</button>
            </div>
        </form>
        

        </div>
    </div>
    </div>

    <div class="contatiner-fluid">
        <!-- Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold- text-primary"> Product
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
                        Add Category
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Name</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT category_id, category_name FROM category";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            // Check if there's a record in database
                            if( mysqli_num_rows($result) == 0) {
                                $_SESSION['status'] = "No data found";
                                $_SESSION['status_code'] = "warning";
                            } 
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                            <tr>
                                <td><?php echo $row['category_id'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><button type="button" class="btn editbtn btn-info btn-sm" id="editbtn"><i class="far fa-edit"></i>Edit</button>
                                &nbsp<button class="btn deletebtn btn-danger btn-sm" id="deletebtn"><i class="fas fa-trash-alt"></i>Delete</button></td>
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
        $('#categoryTable').DataTable();
    } );
</script>

<!-- Edit script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#categoryTable').on('click', '.editbtn', function() {
            $('#editCategory').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#categoryId').val(data[0]);
                $('#categoryName').val(data[1]);
        });
    });
</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#categoryTable').on('click', '.deletebtn', function() {
            $('#deleteCategory').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#deleteId').val(data[0]);

        });
    });
</script>




<?php
    include '../includes/footer.php';
?>