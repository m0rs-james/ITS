<?php

    require '../config/connection.php';
    require '../validation/validation.php';

    switch ($_GET['action']) {

        case 'add':
            $customerName = validation($_POST['customer_name']);
            $customerAddress = validation($_POST['customer_address']);
            $productName = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $PaymentType = validation($_POST['payment_type']);
            $login_id = $_SESSION['login_id'];

            $stmt = "INSERT INTO sales (customer_name, address, payment_type, login_id) VALUES (?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'ssii', $customerName, $customerAddress, $PaymentType, $login_id);

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

                        $_SESSION['status'] = "New Sales has been saved.";
                        $_SESSION['status_code'] = "success";
                        header("Location: ../pages/sales.php");	
                    }
                }
                
            } else {
                die ('Error in updating database ' . mysqli_error($db));
            }
        break;

        case 'edit':
            $id = validation($_POST['sales_id']);
            $customerName = validation($_POST['customer_name']);
            $productName = validation($_POST['product_id']);
            $quantity = validation($_POST['quantity']);
            $PaymentType = validation($_POST['payment_type']);
            $salesStatus = validation($_POST['sales_status']);
            $login_id = $_SESSION['login_id'];

            $stmt = "UPDATE sales SET customer_name = ?, product_id = ?, sales_quantity = ?,
            payment_type = ?, sales_status = ?, login_id = ? WHERE sales_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'iiissii', $customerName, $productName, 
            $quantity, $PaymentType, $salesStatus, $login_id, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Sales has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/sales.php");
        break;

        case 'delete':
            $id = validation($_POST['sales_id']);

            $stmt = "DELETE FROM sales WHERE sales_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Sales has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/sales.php");
        break;
    }