<?php
include '../includes/header.php';
include '../includes/sidebar.html';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Add Sales Modal -->
    <div class="modal fade" id="addSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Sales Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/salesProcess.php?action=add" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="sales_id">

                <div class="form-group">
                    <label> Customer Name </label>
                    <input type="text" name="customer_name"  class="form-control" placeholder="Enter Customer Name" required>
                </div>

                <div class="form-group">
                    <label> Address </label>
                    <input type="text" name="customer_address" id="customerAddress" class="form-control" placeholder="Enter Customer Address" required>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th>SKU</th> -->
                                <th>Product Name</th>
                                <!-- <th>Total Quantity</th> -->
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="new_sales">
                            <tr>
                                <td>
                                    <select name="product_id[]" id="productId" class="form-control product_id" required>

                                    <option value="">Choose a product</option>
                                            <?php 
                                            $sql = "SELECT * FROM product ORDER BY product_name";
                                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                
                                                <option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] . " " . $row['product_size']?> </option> 
                                                <?php
                                            }
                                            ?>
                                    </select> 
                                </td>
                               <td><input name="quantity[]" type="number" class="form-control" value="1" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <center class="form-group"> 
                        <a class="btn btn-success" id="addmore"><i class="fa fa-fw fa-plus-circle"></i> Add More</a>
                        <button type="button" id="removerow" name="removerow" class="btn btn-danger"><i class="fa fa-trash"></i>Remove</button>
                    </center>
                </div>
            </div>

                <!-- <div class="form-group">
                    <label>Total</label>
                    <input readonly="true" type="number" name="total" class="form-control" placeholder="0" required>
                </div> -->
                <div class="form-group">
                    <label> Payment Type </label>
                    <select name="payment_type" id="paymentType"  class="form-control" required>
                        <option value="">Choose the Payment Type</option>
                            
                                <option value="1">Cash</option>
                                <option value="2">Cash on Delivery</option>
                           
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

    <!-- Edit Sales Modal -->
    <div class="modal fade" id="editSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Sales Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../process/salesProcess.php?action=edit" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="sales_id" id="salesId">

                <div class="form-group">
                    <label> Customer Name </label>
                    <select name="customer_id"  class="form-control" required>
                        <option value="">Choose the category of the product</option>
                            <?php 
                            $sql = "SELECT * FROM customer ORDER BY cust_first_name";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['customer_id'] ?>"><?php echo $row['cust_first_name'] . " " . $row['cust_last_name']?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Product Name </label>
                    <select name="product_id" id="productId"  class="form-control" required>
                        <option value="">Choose the Product</option>
                            <?php 
                            $sql = "SELECT * FROM product ORDER BY product_name";
                            $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name']?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter Product Quantity" required>
                </div>
                <div class="form-group">
                    <label> Payment Type </label>
                    <select name="payment_type"   class="form-control" required>
                        <option value="">Choose the Payment Type</option>
                            
                                <option value="1">Cash</option>
                                <option value="2">Cash on Delivery</option>
                           
                    </select>
                </div>
                <div class="form-group">
                    <label> Sales Status </label>
                    <select name="sales_status"  class="form-control" required>
                        <option value="">Choose the Sales Status</option>
                            
                                <option value="1">Pending</option>
                                <option value="2">Complete</option>
                           
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

    <!-- Delete Sales Modal -->
    <div class="modal fade" id="deleteSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Product Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteBrand" action="../process/salesProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="sales_id" id="deleteId">

                <h4>Do you want to delete this Sales?</h4>
                
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
                <h6 class="m-0 font-weight-bold- text-primary"> Sales
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSales">
                        Add Sales
                    </button>
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sales Number</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Total Product</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                                <th>Sales Date</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                /* $sql = "SELECT * FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id INNER JOIN product ON sales_products.product_id = product.product_id"; */
                                $sql = "SELECT *, COUNT(*) as productTotal, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id GROUP BY sales.sales_id";
                                $result = mysqli_query($db, $sql) or die (mysqli_error(($db)));

                                // Check if there's a record in database
                                if( mysqli_num_rows($result) == 0) {
                                    $_SESSION['status'] = "No data found";
                                    $_SESSION['status_code'] = "warning";
                                } 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $row['sales_id'] ?></td>
                                        <td><?php echo $row['customer_name'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['productTotal'] ?></td>
                                        <td><?php echo $row['totalQuantity'] ?></td>
                                        <td><?php echo $row['totalPrice'] ?></td>
                                        <!-- format date to example: Dec 12, 2020 -->
                                        <td><?php $date = new DateTime($row['sales_date']); echo $date->format('F j, Y'); ?></td>
                                        <!-- sales Status -->
                                        <td><a href="../pages/viewOrder.php?id=<?php echo $row['sales_id']?>" class="btn btn-info"><i class="fas fa-receipt"></i>Receipt</a>&nbsp
                                        <button class="btn deletebtn btn-danger"><i class="fas fa-trash-alt"></i>Delete</button></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Add row -->
<script>
    var html = '<tr><td><select name="product_id[]" id="productId" class="form-control product_id" required><option value="">Choose a product</option><?php $sql = "SELECT * FROM product ORDER BY product_name"; $result = mysqli_query($db, $sql) or die (mysqli_error($db)); while ($row = mysqli_fetch_assoc($result)) {?><option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] . " " . $row['product_size']?> </option> <?php }?></select> </td><td><input name="quantity[]" type="number" class="form-control" value="1" required></td></tr>';
    $(function() {
        $('#addmore').click(function() {
            $('#addSales').find('.modal-body .table tbody').append(html);
        });

        $("#removerow").click(function(){
            $("#new_sales").children("tr:last").remove();
        });
    });
</script>

<!-- Edit script (jQuery) -->
<script type="text/javascript"> 
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editSales').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#salesId').val(data[0]);
            $('#customerName').val(data[1]);
            $('#quantity').val(data[3]);
            
        });
    });
</script>

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {
            $('#deleteSales').modal('show');

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