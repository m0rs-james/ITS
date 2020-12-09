<?php


include '../includes/header.php';
include '../includes/sidebar.html';
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
            <h5 class="modal-title" id="exampleModalLabel">Add Category Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productCategory" action="../process/categoryProcess.php?action=add" method="POST">          

            <div class="modal-body">

                <div class="form-group">
                    <label> Brand Name </label>
                    <input type="text" name="category_name" class="form-control" placeholder="Enter Brand Name" required>
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
            <h5 class="modal-title" id="exampleModalLabel">Update Category Data</h5>
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
            <h5 class="modal-title" id="exampleModalLabel">Delete Category Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productCategory" action="../process/categoryProcess.php?action=delete" method="POST">          
            
            <div class="modal-body">

                <input type="hidden" name="category_id" id="deleteId">
                <h4>Do you want to delete this category?</h4>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                            <tr>
                                <td><?php echo $row['category_id'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><button type="button" class="btn editbtn btn-info" id="editbtn">Edit</button>
                                &nbsp<button class="btn deletebtn btn-danger" id="deletebtn">Delete</button></td>
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
        $('.deletebtn').on('click', function() {
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