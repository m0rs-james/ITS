<?php

    require '../config/connection.php';
    require '../validation/validation.php';
    
    $login_id = $_SESSION['login_id'];
    

    switch ($_GET['action']) {

        case 'add':
            $customerName = validation($_POST['customer_name']);
            $customerAddress = validation($_POST['customer_address']);
            $productName = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $courier = validation($_POST['courier']);
            $PaymentType = validation($_POST['payment_type']);

            $notificationId = validation($_POST['notificationId']);

            $status = true;

            // Check if input quantity is greater than product quantity in stock
            for ($y = 0; $y < count($productName); $y++) {
                $checkQuantity = "SELECT * FROM product WHERE product_id = " . $productName[$y];
                $checkQuantityResult = mysqli_query($db, $checkQuantity);
                
                $row = mysqli_fetch_assoc($checkQuantityResult);

                    if ($row['product_quantity'] < $quantity[$y]) {
                        $_SESSION['status'] = "Error! Insufficient stock in " . $row['product_name'];
                        $_SESSION['status_code'] = "error";
                        $status = false;
                        break;
                    } 
                    
            }
            if ($status == false) {

                // quantity requested is greater than quantity in stock
                header("Location: ../pages/sales.php");	
                
            } else {
                $salesStatus = 0;
                $stmt = "INSERT INTO sales (customer_name, address, payment_type, delivery_id, sales_status, login_id) VALUES (?, ?, ?, ?, ?, ?)";
                $insertStmt = mysqli_prepare($db, $stmt);
                mysqli_stmt_bind_param($insertStmt, 'ssiiii', $customerName, $customerAddress, $PaymentType, $courier, $salesStatus, $login_id);
    
                if (mysqli_stmt_execute($insertStmt) === true) {
    
                    // get the last inserted id
                    $id = $db->insert_id;
                    for ($x = 0; $x < count($productName); $x++) {
                        $updateQuantitySql = "SELECT * FROM product WHERE product_id = " . $productName[$x];
                        $updateResult = mysqli_query($db, $updateQuantitySql);
    
                        while ($row = mysqli_fetch_assoc($updateResult)) {
                            // Get the stock quantity substract it to the quantity entered 
                            $result[$x] = $row['product_quantity'] - $quantity[$x];
                            $total[$x] = $row['product_price'] * $quantity[$x];
    
                            // Set the new product quantity 
                            $finalUpdateQuantity = "UPDATE product SET product_quantity = ? WHERE product_id = ?";
                            $updateValue = mysqli_prepare($db, $finalUpdateQuantity);
                            mysqli_stmt_bind_param($updateValue, 'ii', $result[$x], $productName[$x]); 
                            mysqli_stmt_execute($updateValue) or die ('Error in updating database ' . mysqli_error($db));
    
                            // Insert to sales product
                            $sql = "INSERT INTO sales_products (sales_id, product_id, quantity, total) VALUES (?, ?, ?, ?)";
                            $insertSql = mysqli_prepare($db, $sql);
                            mysqli_stmt_bind_param($insertSql, 'iiii', $id, $productName[$x], $quantity[$x], $total[$x]);
                            mysqli_stmt_execute($insertSql) or die ('Error in updating database ' . mysqli_error($db));

                            // Update status of the notification
                            $notificationStatus = 1;
                            $updateStatus = "UPDATE notification SET status = ?";
                            $updateStatusResult = mysqli_prepare($db, $updateStatus);
                            mysqli_stmt_bind_param($updateStatusResult, 'i', $notificationStatus); 
                            mysqli_stmt_execute($updateStatusResult) or die ('Error in updating database ' . mysqli_error($db));
    
                            $_SESSION['status'] = "New Sales has been saved.";
                            $_SESSION['status_code'] = "success";
                            header("Location: ../pages/sales.php");	
                        }
                    }
                    
                    // Get the user details 
                    $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                    INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                    $checkUserResult = mysqli_query($db, $checkUser);
                    $result = mysqli_fetch_assoc($checkUserResult);

                    // Initialize 
                    $name = $result['first_name'] . " " . $result['last_name'];
                    $privilege = $result['privileges_name'];
                    $area = "Sales";
                    $description = $name . " has added new a new sales with ID of: ". $id;

                    // Insert activity to the database
                    $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                    $addActivityStmt = mysqli_prepare($db, $addActivity);
                    mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                    mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
                
                    
                } else {
                    die ('Error in updating database ' . mysqli_error($db));
                }
            }
            
        break;
    }