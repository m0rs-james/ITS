<?php
include '../includes/header.php';
include '../includes/sidebar.html';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Brand Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="productBrand" action="../process/brandProcess.php?action=add" method="POST">
            

            <div class="modal-body">

                <div class="form-group">
                    <label> Brand Name </label>
                    <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand Name" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addbrandbtn" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Edit Brand Modal -->
    <div class="modal fade" id="editBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Brand Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="editBrand" action="../process/brandProcess.php?action=edit" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="brand_id" id="brandId">

                <div class="form-group">
                    <label> Brand Name </label>
                    <input type="text" name="brand_name" id="brandName" class="form-control" placeholder="Enter New Brand Name" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="editbrandbtn" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Delete Brand Modal -->
    <div class="modal fade" id="deleteBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Brand Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="editBrand" action="../process/brandProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="brand_id" id="deleteId">

                <h4>Do you want to delete this brand?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deletebrandbtn" class="btn btn-danger">Yes</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBrand">
                        Add Brand
                    </button>
                </h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Brand ID</th>
                                <th>Brand Name</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT brand_id, brand_name FROM brand";
                                $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                                // Check if there's a record in database
                                if( mysqli_num_rows($result) == 0) {
                                    $_SESSION['status'] = "No data found";
                                    $_SESSION['status_code'] = "warning";
                                } 
                                while ($row = mysqli_fetch_assoc($result)) {    
                            ?>
                            <tr>
                                <td><?php echo $row['brand_id'] ?></td>
                                <td><?php echo $row['brand_name'] ?></td>
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
            $('#editBrand').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#brandId').val(data[0]);
            $('#brandName').val(data[1]);
        });
    });
</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {
            $('#deleteBrand').modal('show');

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