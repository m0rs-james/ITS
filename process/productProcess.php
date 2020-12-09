<?php

    include '../config/connection.php';

    switch ($_GET['action']) {
        
        case 'add':
            $name = $_POST['product_name'];
            $description = $_POST['product_description'];
            $category = $_POST['category_id'];
            $brand = $_POST['brand_id'];
            $price = $_POST['product_price'];
            $quantity = $_POST['product_quantity'];

            $stmt = "INSERT INTO product (category_id, brand_id, product_name, 
            product_description, product_quantity, product_price) VALUES (?,?,?,?,?,?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'iissid', $category, $brand, $name, $description, $quantity, $price);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Product has been saved.";
            $_SESSION['status_type'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'edit':
            $id = $_POST['product_id'];
            $name = $_POST['product_name'];
            $description = $_POST['product_description'];
            $category = $_POST['category_id'];
            $brand = $_POST['brand_id'];
            $price = $_POST['product_price'];
            $quantity = $_POST['product_quantity'];

            $stmt = "UPDATE product SET category_id = ?, brand_id = ?, product_name = ?, product_description = ?,  
             product_quantity = ?, product_price = ? WHERE product_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'iissidi', $category, $brand, $name, $description, $quantity, $price, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Product has been updated";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'delete':
            $id = $_POST['product_id'];
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