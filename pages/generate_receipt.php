<?php 

//include connection file 
require("../config/connection.php");
include_once('../fpdf/fpdf.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // get customer details
    $sql = "SELECT *, SUM(total) as totalPrice FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id 
    INNER JOIN product ON sales_products.product_id = product.product_id WHERE sales.sales_id = ". $id;
    $results = $db->query($sql);
    $rows = $results->fetch_object();
    $customerName = $rows->customer_name;
    $address = $rows->address;
    $date = new DateTime($rows->sales_date);
    $totalPrice = $rows->totalPrice;
    $tPrice = number_format($totalPrice, 2);


    $pdf =  new FPDF();
    $pdf->AddPage(); // page create
    $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 

    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
    $pdf->SetFont("Times", "B", 14);
    $pdf->Cell(190, 10, 'Receipt', 0, 1, 'C');

    $pdf->Cell(50,10,"",0,1);  // new line 

    $pdf->SetFont("Arial", "", 10);
    $pdf->Cell(40, 10, 'Receipt #:', 0, 0, 'L');
    $pdf->Cell(40, 10, $id, 0, 1, 'L');
    $pdf->Cell(40, 10, 'Customer name:', 0, 0, 'L');
    $pdf->Cell(40, 10, $customerName, 0, 1, 'L');
    $pdf->Cell(40, 10, 'Address:', 0, 0, 'L');
    $pdf->Cell(40, 10, $address, 0, 1, 'L');
    $pdf->Cell(40, 10, 'Date:', 0, 0, 'L');
    $pdf->Cell(40, 10, $date->format('F j, Y'), 0, 1, 'L');


    $pdf->Cell(50,10,"",0,1);  // new line 

    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(90, 10, "Product Name", 1, 0, 'C');
    $pdf->Cell(40, 10, "Quantity",1 , 0, 'C');
    $pdf->Cell(30, 10, "Price", 1, 0, 'C');
    $pdf->Cell(30, 10, "SubTotal", 1, 1, 'C');

    // View Query
    $stmt = "SELECT * FROM sales_products INNER JOIN sales ON sales_products.sales_id = sales.sales_id 
    INNER JOIN product ON sales_products.product_id = product.product_id WHERE sales.sales_id = ". $id;
    $result = $db->query($stmt);

    while ($row = $result->fetch_object()) {
        $productName = $row->product_name;
        $quantity = $row->quantity;
        $price = $row->product_price;
        $subTotal = $row->quantity * $row->product_price;

        $p = number_format($price, 2);
        $sTotal = number_format($subTotal, 2);

        $pdf->SetFont("Arial", "", 10);    
        $pdf->Cell(90, 10, $productName, 1, 0, 'C');
        $pdf->Cell(40, 10, $quantity, 1, 0, 'C');
        $pdf->Cell(30, 10, $p, 1, 0, 'C');
        $pdf->Cell(30, 10, $sTotal, 1, 1, 'C'); 
        
         
    }
    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(160, 10, "Total:", 0, 0, 'R');
    $pdf->Cell(30, 10, $tPrice, 1, 1, 'C');

   $pdf->Output();
}