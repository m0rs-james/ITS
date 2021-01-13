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
            $PaymentType = validation($_POST['payment_type']);

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
                $stmt = "INSERT INTO sales (customer_name, address, payment_type, sales_status, login_id) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = mysqli_prepare($db, $stmt);
                mysqli_stmt_bind_param($insertStmt, 'ssiii', $customerName, $customerAddress, $PaymentType, $salesStatus, $login_id);
    
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

                            
                            // Alerts
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

        case 'delete':
            $id = validation($_POST['sales_id']);

            $stmt = "DELETE FROM sales WHERE sales_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            
            // Check if the previous statement is executed
            if (mysqli_stmt_execute($deleteStmt) === true) {

                // Get the user details 
                $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                $checkUserResult = mysqli_query($db, $checkUser);
                $result = mysqli_fetch_assoc($checkUserResult);
                
                // Initialize 
                $name = $result['first_name'] . " " . $result['last_name'];
                $privilege = $result['privileges_name'];
                $area = "Sales";
                $description = $name . " has deleted the sales with salesID of: " . $id;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

            mysqli_close($db);

            $_SESSION['status'] = "Sales has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/sales.php");
        break;

        case 'send':
            $id = validation($_POST['sales_id']);
            $courier = validation($_POST['courier']);
            $shipmentStatus = 0;

            // Insert to shipment table
            $insertShipment = "INSERT INTO shipment (sales_id, delivery_id, status, login_id) values (?, ?, ?, ?)";
            $insertShipmentResult = mysqli_prepare($db, $insertShipment);
            mysqli_stmt_bind_param($insertShipmentResult, 'iiii', $id, $courier, $shipmentStatus, $login_id);
            
            // Check if the previous statement is executed
            if (mysqli_stmt_execute($insertShipmentResult) === true) {

                $salesStatus = 1;
                // Update sales status
                $updateStatus = "UPDATE sales SET sales_status = ? WHERE sales_id = ?";
                $updateStatusResult = mysqli_prepare($db, $updateStatus);
                mysqli_stmt_bind_param($updateStatusResult, 'ii', $salesStatus, $id);
                mysqli_stmt_execute($updateStatusResult) or die (mysqli_error($db));


                // Get the user details 
                $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                $checkUserResult = mysqli_query($db, $checkUser);
                $result = mysqli_fetch_assoc($checkUserResult);
                
                // Initialize 
                $name = $result['first_name'] . " " . $result['last_name'];
                $privilege = $result['privileges_name'];
                $area = "Shipment";
                $description = $name . " has sent the sales with salesID of: " . $id . " to shipment";
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

            mysqli_close($db);

            $_SESSION['status'] = "Order has been sent to shipment.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/sales.php");
        break;
    }