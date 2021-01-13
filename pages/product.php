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

    <!-- Add Product -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-plus-circle fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/productProcess.php?action=add" method="POST">
            

            <div class="modal-body">

                <div class="form-group">
                    <label> Product Name </label>
                    <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                </div>
                <!-- <div class="form-group">
                    <label> Product Description </label>
                    <input type="text" name="product_description" class="form-control" placeholder="Enter Product Description">
                </div> -->
                <!-- Brand is temporarly not available -->
                <!-- <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id"  class="form-control" required>
                        <option value="">Choose the brand of the product</option>
                        <?php 
                        $sql = "SELECT * FROM brand ORDER BY brand_name";
                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['brand_id']?>"><?php echo $row['brand_name']?></option>
                            <?php 
                        }
                        ?>
                    </select>
                   
                </div> -->
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="#category" class="form-control" required>
                    <option value="">Choose the category of the product</option>
                        <?php 
                        $sql = "SELECT * FROM category ORDER BY category_name";
                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Product Size </label>
                    <input type="text" name="product_size" class="form-control" placeholder="Enter Product Size">
                </div>
                <div class="form-group">
                    <label> Price </label>
                    <input type="number" step="any" name="product_price" class="form-control" placeholder="Enter Product Price" required>
                </div>
                <div class="form-group">
                    <label> Quantity </label>
                    <input type="number" name="product_quantity" class="form-control" placeholder="Enter Product Quantity" required>
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

    <!-- Edit Product -->
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fa fa-wrench fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/productProcess.php?action=edit" method="POST">

            <div class="modal-body">

                <input type="hidden" name="product_id" id="productId">

                <div class="form-group">
                    <label> Product Name </label>
                    <input type="text" name="product_name" id="productName" class="form-control" placeholder="Enter Product Name" required>
                </div>
                <!-- Product Description is temporarily unavailable -->
                <!-- <div class="form-group">
                    <label> Product Description </label>
                    <input type="text" name="product_description" id="productDescription" class="form-control" placeholder="Enter Product Description">
                </div> -->
                <!-- Brand is temporarily unavailable -->
                <!-- <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control" required>
                        <option value="">Choose the brand of the product</option>
                        <?php 
                        $sql = "SELECT * FROM brand ORDER BY brand_name";
                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['brand_id']?>"><?php echo $row['brand_name']?></option>
                            <?php 
                        }
                        ?>
                    </select>
                   
                </div> -->
                <!-- <div class="form-group">
                    <label>Category</label>
                    <select name="category_id"  class="form-control" required>
                        <option value="">Choose the category of the product</option>
                            <?php 
                            $sql = "SELECT * FROM category ORDER BY category_name";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div> -->
                <div class="form-group">
                    <label> Product Size </label>
                    <input type="text" name="product_size" id="productSize" class="form-control" placeholder="Enter New Product Size">
                </div>
                <div class="form-group">
                    <label> Price </label>
                    <input type="number" step="any" name="product_price" id="productPrice" class="form-control" placeholder="Enter New Product Price" required>
                </div>
                <div class="form-group">
                    <label> Quantity </label>
                    <input type="number" step="any" name="product_quantity" id="productQuantity" class="form-control" placeholder="Enter New Product Quantity" required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="editbtn" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fas fa-trash-alt fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteProduct" action="../process/productProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="product_id" id="deleteId">

                <h4>Do you really want to delete this Product?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteproductbtn" class="btn btn-danger">Yes</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                        Add Product
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Join Category and Brand table to Product table using INNER JOIN
                                $sql = "SELECT * FROM product INNER JOIN category ON product.category_id = category.category_id ORDER BY product_id";
                                $result = mysqli_query($db, $sql) or die (mysqli_error($sql));

                                // Check if there's a record in database
                                if( mysqli_num_rows($result) == 0) {
                                    $_SESSION['status'] = "No data found";
                                    $_SESSION['status_code'] = "warning";
                                } 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['product_id'] ?></td>
                                            <td><?php echo $row['product_name'] ?></td>
                                            <!-- <td><?php echo $row['product_description'] ?></td> -->
                                            <td><?php echo $row['category_name'] ?></td>
                                            <td><?php
                                            /* if ($row['product_size'] == 0 || $row['product_size'] == null) {
                                                echo "N/A";
                                            } else {
                                                echo $row['product_size'];
                                            } */
                                            echo $row['product_size']
                                             ?></td>
<!--                                             <td><?php echo $row['brand_name'] ?></td> -->
                                            <td><?php echo $row['product_price'] ?></td>
                                            <td><?php echo $row['product_quantity'] ?></td>
                                            <td>
                                                <!-- Check if the product quantity is available, not available or low stock -->
                                                <?php                    
                                                    if ($row['product_quantity'] == 0) { ?>
                                                        <p class="px-2 py-2 bg-gradient-danger text-white">Not available</p>
                                                        <?php
                                                    } else if ($row['product_quantity'] <= 20) { ?>
                                                        <p class="px-2 py-2 bg-gradient-warning text-black">Low stock</p>
                                                        <?php
                                                    } else { ?>
                                                        <p class="px-2 py-2 bg-gradient-success text-black">Available</p>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
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
        $('#productTable').DataTable();
    } );
</script>

<!-- Edit script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#productTable').on('click', '.editbtn', function() {
            $('#editProduct').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#productId').val(data[0]);
            $('#productName').val(data[1]);
            $('#productSize').val(data[3]);
            $('#productPrice').val(data[4]);
            /* $('#productQuantity').val(data[5]); */
             
        });
    });
</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#productTable').on('click', '.deletebtn', function() {
            $('#deleteProduct').modal('show');

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