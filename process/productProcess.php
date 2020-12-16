<?php

    require '../config/connection.php';
    require '../validation/validation.php';

    switch ($_GET['action']) {
        
        case 'add':
            $name = validation($_POST['product_name']);
            $category = validation($_POST['category_id']);
            $size = validation($_POST['product_size']);
            $price = validation($_POST['product_price']);
            $quantity = validation($_POST['product_quantity']);
            $login_id = $_SESSION['login_id'];

            $stmt = "INSERT INTO product (category_id, product_name, product_size, product_quantity, product_price, login_id) VALUES (?,?,?,?,?,?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'issidi', $category, $name, $size, $quantity, $price, $login_id);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Product has been saved.";
            $_SESSION['status_type'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'edit':
            $id = validation($_POST['product_id']);
            $name = validation($_POST['product_name']);
            $category = validation($_POST['category_id']);
            $size = validation($_POST['product_size']);
            $price = validation($_POST['product_price']);
            $quantity = validation($_POST['product_quantity']);
            $login_id = $_SESSION['login_id'];

            // update product: product quantity will get updated by adding the 
            // quantity stored in the database plus the new quantity 
            $stmt = "UPDATE product SET product_name = ?, product_size = ?, 
            product_quantity = product_quantity + ?, product_price = ?, login_id = ? WHERE product_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'ssidii', $name, $size, $quantity, $price, $login_id, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));
            
            mysqli_close($db);

            $_SESSION['status'] = "Product has been updated";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'delete':
            $id = validation($_POST['product_id']);
            $stmt = "DELETE FROM product WHERE product_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "A product has been deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/product.php");
        break;
    }