<?php

require '../config/connection.php';

    
// Initialize variables
$months = '';
$earnings = '';
$dates = '';

// Get earning list from database
$getChartData = "SELECT *, SUM(total) as totalPrice, SUM(quantity) as totalQuantity FROM sales INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id 
GROUP BY DAY(sales_date)";

$getChartDataResult = mysqli_query($db, $getChartData);
while ($row = mysqli_fetch_array($getChartDataResult)) {

    $earning = $row['totalPrice'];
    $date = date("F j, Y", strtotime($row['sales_date']));

    $dates = $dates.'"'.$date.'",';
    $earnings = $earnings.$earning.',';
}
$dates = trim($dates, ",");
$earnings = trim($earnings, ",");

/* ****************************************************************************************************************** */
// Initialize product variables
$products = '';
$quantities = '';


// Get product list 
$getProduct = "SELECT * FROM product";
$getProductResult = mysqli_query($db, $getProduct);

while ($rows = mysqli_fetch_array($getProductResult)) {

    $product = $rows['product_name'];
    $quantity = $rows['product_quantity'];

    $products = $products.'"'.$product.'",';
    $quantities = $quantities.'"'.$quantity.'",';

}
$products = trim($products, ",");
$quantities = trim($quantities, ",");
