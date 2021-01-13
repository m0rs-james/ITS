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
                                            // if product stock is zero, it will not be included in the list
                                            $sql = "SELECT * FROM product WHERE product_quantity > 0 ORDER BY product_name";
                                            /* $sql = "SELECT * FROM product ORDER BY product_name"; */
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

                <!-- Payment -->
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
                <button type="submit" name="registerbtn" class="btn btn-primary btn-icon-split">Save</button>
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
        <div class="col-auto">
            <i class="fas fa-trash-alt fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Delete Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="deleteBrand" action="../process/salesProcess.php?action=delete" method="POST">
            

            <div class="modal-body">

                <input type="hidden" name="sales_id" id="deleteId">

                <h4>Do you really want to delete this Sales?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteproductbtn" class="btn btn-danger">Yes</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Send Sales Modal -->
    <div class="modal fade" id="sendSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-auto">
            <i class="fas fa-truck fa-2x ml-n3"></i>
        </div>
            <h5 class="modal-title" id="exampleModalLabel">Send to shipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="sendSales" action="../process/salesProcess.php?action=send" method="POST">
            

            <div class="modal-body">

            <input type="hidden" name="sales_id" id="sendID">

                <!-- Payment -->
                <div class="form-group">
                    <label> Courier </label>
                    <select name="courier" id="courier" class="form-control" required>
                        <option value="">Choose a courier</option>
                            <?php 
                                $selectCourier = "SELECT * FROM delivery";
                                $selectCourierResult = mysqli_query($db, $selectCourier);

                                while ($selectCourierRow = mysqli_fetch_assoc($selectCourierResult)) {
                                    ?>
                                    <option value="<?php echo $selectCourierRow['delivery_id'] ?>"><?php echo $selectCourierRow['delivery_name'] ?></option>
                                    <?php
                                }
                            ?>
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <h6>Do you really want to send this for shipment?</h6>

                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" name="send" class="btn btn-primary btn-sm">Yes</button>
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

                    <table class="table table-bordered" id="salesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">Sales ID</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th width="1%">Total Product</th>
                                <th width="1%">Total Quantity</th>
                                <th >Total Price</th>
                                <th>Sales Date</th>
                                <th>Status</th>
                                <th width="12%">changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                /* $sql = "SELECT * FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id INNER JOIN product ON sales_products.product_id = product.product_id"; */
                                $sql = "SELECT *, COUNT(*) as productTotal, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales 
                                INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id 
                                GROUP BY sales.sales_id";
                                $result = mysqli_query($db, $sql) or die (mysqli_error($db));

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
                                        <td>₱ <?php echo number_format($row['totalPrice'], 2) ?></td>
                                        <!-- format date to example: Dec 12, 2020 -->
                                        <td><?php $date = new DateTime($row['sales_date']); echo $date->format('F j, Y'); ?></td>
                                        <!-- sales Status -->
                                        <td><?php if($row['sales_status'] == 0) { ?>
                                            <p class="px-2 py-2 bg-gradient-warning text-black btn-sm">Preparing</p>
                                        <?php } else if ($row['sales_status'] == 1) { ?>
                                            <p class="px-2 py-2 bg-gradient-info text-black btn-sm">For Pick-Up</p>
                                        <?php } else { ?>
                                            <p class="px-2 py-2 bg-gradient-success text-black btn-sm">Delivered</p>
                                            <?php } ?>
                                        </td>
                                        <td><?php if($row['sales_status'] == 0) {?>
                                            <button class="btn sendbtn btn-success btn-sm pr-3"><i class="fas fa-arrow-right"></i>Send</button>&nbsp
                                            <a href="../pages/viewOrder.php?id=<?php echo $row['sales_id']?>" class="btn btn-info btn-sm"><i class="fas fa-receipt"></i>Receipt</a>&nbsp
                                            <button class="btn deletebtn btn-danger btn-sm pr-2"><i class="fas fa-trash-alt"></i>Delete</button>
                                        <?php } else { ?>
                                            <a href="../pages/viewOrder.php?id=<?php echo $row['sales_id']?>" class="btn btn-info btn-sm"><i class="fas fa-receipt"></i>Receipt</a>&nbsp
                                        <button class="btn deletebtn btn-danger btn-sm pr-2"><i class="fas fa-trash-alt"></i>Delete</button>
                                        <?php } ?>
                                        </td>
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

<!-- Delete script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#salesTable').on('click', '.deletebtn', function() {
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

<!-- Send script (jQuery) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#salesTable').on('click', '.sendbtn', function() {
            $('#sendSales').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#sendID').val(data[0]);
        });
    });
</script>


<!-- DataTable -->
<script>
    $(document).ready(function() {
        $('#salesTable').DataTable( {
            // sort by recent inserted data
            aaSorting: [[0, 'desc']]
        });
    } );
</script>

<!-- End of contatiner fluid -->

<?php
    include '../includes/footer.php';
?>