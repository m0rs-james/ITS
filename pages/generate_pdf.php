<?php 

//include connection file 
require("../config/connection.php");
include_once('../fpdf/fpdf.php');

    // Selected Option
    $selectedDate = $_POST['selectDate'];
    // Day
    $selectedDay = date('Y-m-d',strtotime($_POST['selDay']));
    // Month
    $sMonth = date('Y-m-d',strtotime($_POST['selMonth']));
    $selectedMonth = new DateTime($sMonth);
    $selectedMonth = $selectedMonth->format('F Y');
    // Year
    $sYear = date('Y-m-d',strtotime($_POST['selYear']));
    $selectedYear = new DateTime($sYear);
    $selectedYear = $selectedYear->format('Y');
    // Date Range
    $selectedDayFrom = date('Y-m-d',strtotime($_POST['from']));
    $selectedDayTo = date('Y-m-d',strtotime($_POST['to']));
    

    // For summary
    if ($selectedDate == 1) {
        $sql = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales 
        INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id WHERE DAY(sales_date) = DAY('$selectedDay')";
        $results = $db->query($sql) or die(mysqli_error($db));
        $row2 = $results->fetch_object();

        // Initialization
        $totalSales = $row2->totalPrice;
        $totalProductSold = $row2->totalQuantity;
        $dateInDB = date('Y-m-d',strtotime($row2->sales_date));

        // convert date to dateTime
        $date = new DateTime($row2->sales_date);
        $date2 = new DateTime($selectedDay);
        
        // convert to number format
        $tS = number_format($totalSales);
        $tSP = number_format($totalProductSold);

        if ($selectedDay === $dateInDB) {

            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
        
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
        
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(50, 10, "Summary: ".$date->format('F j, Y'), 0 ,1 , 'C');
            $pdf->SetFont("Arial", "", 8);
            $pdf->Cell(30, 10, "Total Sales:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tS, 0, 1, 'C');
            $pdf->Cell(30, 10, "Total Product Sold:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tSP, 0, 1, 'C');
        
            $pdf->Cell(50,10,"",0,1);  // new line 
        
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(20,10,"Sales detail:",0,0,'C');
        
            $pdf->Cell(50,10,"",0,1);  // new line 
        
            $pdf->SetFont("Arial", "B", 8);
            $pdf->Cell(100,10,"Product",1,0,'C');
            $pdf->Cell(50,10,"Quantity",1,0,'C');
            $pdf->Cell(40,10,"Total Price",1,1,'C');
        
            // View Query
            $stmt = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales_products 
            INNER JOIN sales ON sales_products.sales_id = sales.sales_id
            WHERE DAY(sales_date) = DAY('$selectedDay')
            GROUP BY product_id
            ORDER BY totalQuantity DESC";
            $result = $db->query($stmt);
        
            // View sales report
            while ($row = $result->fetch_object()) {
                $pName = $row->product_id;
                $productSql = "SELECT product_name FROM product WHERE product_id = " .$pName;
                $productResult = $db->query($productSql);
                $row1 = $productResult->fetch_object();
                
                $productName = $row1->product_name;
                $totalQ = $row->totalQuantity;
                $totalPr = $row->totalPrice;
        
                $pdf->SetFont("Arial", "", 8);
                $pdf->Cell(100,10,$productName,1,0,'C');
                $pdf->Cell(50,10,$totalQ,1,0,'C');
                $pdf->Cell(40,10,$totalPr,1,1,'C');
            }
          
           $pdf->Output();
        
        } else {
            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
        
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, $date2->format('F j, Y'), 0, 1, 'C');
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'No Record', 0, 1, 'C');
        
            $pdf->Output();
        }
    
        
    } else if ($selectedDate == 2) {
        $sql = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales 
        INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id 
        WHERE YEAR(sales_date) = YEAR('$sMonth') AND MONTH(sales_date) = MONTH('$sMonth')";
        $results = $db->query($sql) or die(mysqli_error($db));
        $row2 = $results->fetch_object();

        // Initialization
        $totalSales = $row2->totalPrice;
        $totalProductSold = $row2->totalQuantity;
        $dateInDB = date('Y-m-d',strtotime($row2->sales_date));
        $dateInDBmonth = date('Y-m-d',strtotime($row2->sales_date));

        // convert date to dateTime
        $date = new DateTime($row2->sales_date);
        $date2 = new DateTime($selectedDay);
        
        // convert to number format
        $tS = number_format($totalSales);
        $tSP = number_format($totalProductSold);

        if ($totalSales != 0) {

            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
    
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
    
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(50, 10, "Summary: ".$selectedMonth, 0 ,1 , 'C');
            $pdf->SetFont("Arial", "", 8);
            $pdf->Cell(30, 10, "Total Sales:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tS, 0, 1, 'C');
            $pdf->Cell(30, 10, "Total Product Sold:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tSP, 0, 1, 'C');
    
            $pdf->Cell(50,10,"",0,1);  // new line 
    
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(20,10,"Sales detail:",0,0,'C');
    
            $pdf->Cell(50,10,"",0,1);  // new line 
    
            $pdf->SetFont("Arial", "B", 8);
            $pdf->Cell(100,10,"Product",1,0,'C');
            $pdf->Cell(50,10,"Quantity",1,0,'C');
            $pdf->Cell(40,10,"Total Price",1,1,'C');
    
            // View Query
            $stmt = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales_products 
            INNER JOIN sales ON sales_products.sales_id = sales.sales_id
            WHERE YEAR(sales_date) = YEAR('$sMonth') AND MONTH(sales_date) = MONTH('$sMonth')
            GROUP BY product_id
            ORDER BY totalQuantity DESC";
            $result = $db->query($stmt);
    
            // View sales report
            while ($row = $result->fetch_object()) {
                $pName = $row->product_id;
                $productSql = "SELECT product_name FROM product WHERE product_id = " .$pName;
                $productResult = $db->query($productSql);
                $row1 = $productResult->fetch_object();
                
                $productName = $row1->product_name;
                $totalQ = $row->totalQuantity;
                $totalPr = $row->totalPrice;
    
                $pdf->SetFont("Arial", "", 8);
                $pdf->Cell(100,10,$productName,1,0,'C');
                $pdf->Cell(50,10,$totalQ,1,0,'C');
                $pdf->Cell(40,10,$totalPr,1,1,'C');
            }
        
        $pdf->Output();
    
        } else {
            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
    
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, $selectedMonth, 0, 1, 'C');
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'No Record', 0, 1, 'C');
    
            $pdf->Output();
        }
    } else if ($selectedDate == 3) {
        $sql = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales 
        INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id 
        WHERE YEAR(sales_date) = YEAR('$sYear')";
        $results = $db->query($sql) or die(mysqli_error($db));
        $row2 = $results->fetch_object();

        // Initialization
        $totalSales = $row2->totalPrice;
        $totalProductSold = $row2->totalQuantity;
        $dateInDB = date('Y-m-d',strtotime($row2->sales_date));
        $dateInDBmonth = date('Y-m-d',strtotime($row2->sales_date));

        // convert date to dateTime
        $date = new DateTime($row2->sales_date);
        $date2 = new DateTime($selectedDay);
        
        // convert to number format
        $tS = number_format($totalSales);
        $tSP = number_format($totalProductSold);

        if ($totalSales != 0) {

            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
    
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
    
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(50, 10, "Summary: ".$selectedYear, 0 ,1 , 'C');
            $pdf->SetFont("Arial", "", 8);
            $pdf->Cell(30, 10, "Total Sales:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tS, 0, 1, 'C');
            $pdf->Cell(30, 10, "Total Product Sold:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tSP, 0, 1, 'C');
    
            $pdf->Cell(50,10,"",0,1);  // new line 
    
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(20,10,"Sales detail:",0,0,'C');
    
            $pdf->Cell(50,10,"",0,1);  // new line 
    
            $pdf->SetFont("Arial", "B", 8);
            $pdf->Cell(100,10,"Product",1,0,'C');
            $pdf->Cell(50,10,"Quantity",1,0,'C');
            $pdf->Cell(40,10,"Total Price",1,1,'C');
    
            // View Query
            $stmt = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales_products 
            INNER JOIN sales ON sales_products.sales_id = sales.sales_id
            WHERE YEAR(sales_date) = YEAR('$sYear')
            GROUP BY product_id
            ORDER BY totalQuantity DESC";
            $result = $db->query($stmt);
    
            // View sales report
            while ($row = $result->fetch_object()) {
                $pName = $row->product_id;
                $productSql = "SELECT product_name FROM product WHERE product_id = " .$pName;
                $productResult = $db->query($productSql);
                $row1 = $productResult->fetch_object();
                
                $productName = $row1->product_name;
                $totalQ = $row->totalQuantity;
                $totalPr = $row->totalPrice;
    
                $pdf->SetFont("Arial", "", 8);
                $pdf->Cell(100,10,$productName,1,0,'C');
                $pdf->Cell(50,10,$totalQ,1,0,'C');
                $pdf->Cell(40,10,$totalPr,1,1,'C');
            }
        
        $pdf->Output();
    
        } else {
            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
    
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
    
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, $selectedYear, 0, 1, 'C');
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'No Record', 0, 1, 'C');
    
            $pdf->Output();
        }
    } else if ($selectedDate == 4) {
        $sql = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales 
        INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id 
        WHERE DAY(sales_date) BETWEEN DAY('$selectedDayFrom') AND DAY('$selectedDayTo')";
        $results = $db->query($sql) or die(mysqli_error($db));
        $row2 = $results->fetch_object();

        // Initialization
        $totalSales = $row2->totalPrice;
        $totalProductSold = $row2->totalQuantity;

        // convert date to dateTime
        $date1 = new DateTime($selectedDayFrom);
        $date2 = new DateTime($selectedDayTo);
        
        // convert to number format
        $tS = number_format($totalSales);
        $tSP = number_format($totalProductSold);

        if ($totalSales != 0) {

            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
        
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
        
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(98, 10, "Summary: From ".$date1->format('F j, Y'). ' To ' .$date2->format('F j, Y'), 0 ,1 , 'C');
            $pdf->SetFont("Arial", "", 8);
            $pdf->Cell(30, 10, "Total Sales:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tS, 0, 1, 'C');
            $pdf->Cell(30, 10, "Total Product Sold:",0 , 0, 'R');
            $pdf->Cell(30, 10, $tSP, 0, 1, 'C');
        
            $pdf->Cell(50,10,"",0,1);  // new line 
        
            $pdf->SetFont("Arial", "B", 10);
            $pdf->Cell(20,10,"Sales detail:",0,0,'C');
        
            $pdf->Cell(50,10,"",0,1);  // new line 
        
            $pdf->SetFont("Arial", "B", 8);
            $pdf->Cell(100,10,"Product",1,0,'C');
            $pdf->Cell(50,10,"Quantity",1,0,'C');
            $pdf->Cell(40,10,"Total Price",1,1,'C');
        
            // View Query
            $stmt = "SELECT *, SUM(quantity) as totalQuantity, SUM(total) as totalPrice FROM sales_products 
            INNER JOIN sales ON sales_products.sales_id = sales.sales_id
            WHERE DAY(sales_date) BETWEEN DAY('$selectedDayFrom') AND DAY('$selectedDayTo')
            GROUP BY product_id
            ORDER BY totalQuantity DESC";
            $result = $db->query($stmt);
        
            // View sales report
            while ($row = $result->fetch_object()) {
                $pName = $row->product_id;
                $productSql = "SELECT product_name FROM product WHERE product_id = " .$pName;
                $productResult = $db->query($productSql);
                $row1 = $productResult->fetch_object();
                
                $productName = $row1->product_name;
                $totalQ = $row->totalQuantity;
                $totalPr = $row->totalPrice;
        
                $pdf->SetFont("Arial", "", 8);
                $pdf->Cell(100,10,$productName,1,0,'C');
                $pdf->Cell(50,10,$totalQ,1,0,'C');
                $pdf->Cell(40,10,$totalPr,1,1,'C');
            }
          
           $pdf->Output();
        
        } else {
            $pdf =  new FPDF();
            $pdf->AddPage(); // page create
            $pdf->Image('../img/logo.jpg', 165, 5, 25, 24); 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'Skin Magical Southside', 0, 1, 'C');
            $pdf->SetFont("Times", "B", 14);
            $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
        
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
            $pdf->Cell(50, 10, "", 0, 1);  // new line 
        
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, $date1->format('F j, Y'). ' To ' .$date2->format('F j, Y'), 0, 1, 'C');
            $pdf->SetFont("Arial", "B", 14);
            $pdf->Cell(190, 10, 'No Record', 0, 1, 'C');
        
            $pdf->Output();
        }
    }
    
 