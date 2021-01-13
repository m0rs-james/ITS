<?php
// for navigation active link
$page = "sales";

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';

include '../config/connection.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT *, SUM(total) as totalPrice FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id 
    INNER JOIN product ON sales_products.product_id = product.product_id WHERE sales.sales_id = ". $id;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<div id="content-wrapper" class="d-flex flex-column">
    
<div class="contatiner-fluid">
        <!-- Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-2 font-weight-bold- text-primary"> Receipt
                </h6>
            </div>

            <div style="padding: 10px 10px 10px 10px" class="form-inline">
                <label style="padding-right: 54px" >Receipt #:</label>
                <input type="text" name="sales_id" id="viewId" class="form-control" readonly="true" value="<?php echo $row['sales_id'] ?>">
            </div>

            <div style="padding: 0px 10px 10px 10px" class="form-inline">
                <label style="padding-right: 5px">Customer Name:</label>
                <input type="text" name="customer_name" id="customerName" class="form-control" readonly="true" value="<?php echo $row['customer_name'] ?>">
            </div>

            <div style="padding: 0px 10px 10px 10px" class="form-inline">
                <label style="padding-right: 64px">Address:</label>
                <input type="text" name="address" id="address" class="form-control" readonly="true" value="<?php echo $row['address'] ?>">
            </div>

            <div style="padding: 0px 10px 10px 10px" class="form-inline">
                <label style="padding-right: 88px">Date:</label>
                <input type="text" name="date" id="date" class="form-control" readonly="true" value="<?php $date = new DateTime($row['sales_date']); echo $date->format('F j, Y'); ?>">
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody id="new_sales">
                    <?php 
                        $view = "SELECT * FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id 
                        INNER JOIN product ON sales_products.product_id = product.product_id WHERE sales.sales_id = ". $id;
                        $viewResult = mysqli_query($db, $view);

                        while ($viewRows = mysqli_fetch_assoc($viewResult)) {

                    ?>
                    <tr>
                        <td><?php echo $viewRows['product_name'] ?></td>
                        <td><?php echo $viewRows['quantity'] ?></td>
                        <td>₱ <?php echo $viewRows['product_price'] ?></td>
                        <td>₱ <?php echo $viewRows['quantity'] * $viewRows['product_price'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="float-right">
                <div class="form-inline">
                    <h5 style="padding-right: 15px">Total:</h5>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo $row['totalPrice'] ?>" readonly="true">
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

</div>
    <div class="modal-footer">
        <h5>Do you want to generate a receipt?</h5> 
        <a href="../pages/sales.php" class="btn btn-secondary" style="cursor: pointer; text-decoration: none">No</a>
        <a href="../pages/generate_receipt.php?id=<?php echo $id ?>" class="btn btn-danger" style="cursor: pointer; text-decoration: none">Yes</a>
    </div>
</div>

<!-- ajax script for popup modal & sweetAlert -->
<?php
    include '../includes/scripts2.php';
?>

<?php
    include '../includes/footer.php';
?>

<?php
}

?>
