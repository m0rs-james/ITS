<?php

    require '../config/connection.php';
    require '../validation/validation.php';

    $login_id = $_SESSION['login_id'];

    switch ($_GET['action']) {
        
        case 'add':
            $productName = validation($_POST['product_name']);
            $category = validation($_POST['category_id']);
            $size = validation($_POST['product_size']);
            $price = validation($_POST['product_price']);
            $quantity = validation($_POST['product_quantity']);

            // Insert statement
            $stmt = "INSERT INTO product (category_id, product_name, product_size, product_quantity, product_price, login_id) VALUES (?,?,?,?,?,?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'issidi', $category, $productName, $size, $quantity, $price, $login_id);

            // Check if the previous statement is executed
            if (mysqli_stmt_execute($insertStmt) === true) {

                // Get the user details 
                $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                $checkUserResult = mysqli_query($db, $checkUser);
                $result = mysqli_fetch_assoc($checkUserResult);

                // Initialize 
                $name = $result['first_name'] . " " . $result['last_name'];
                $privilege = $result['privileges_name'];
                $area = "Product";
                $description = $name . " has added new product: " . $productName;

                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

            mysqli_close($db);

            $_SESSION['status'] = "New Product has been saved.";
            $_SESSION['status_type'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'edit':
            $id = validation($_POST['product_id']);
            $productName = validation($_POST['product_name']);
            $category = validation($_POST['category_id']);
            $size = validation($_POST['product_size']);
            $price = validation($_POST['product_price']);
            $quantity = validation($_POST['product_quantity']);

            // Check which is updated by the user
            $checkUpdate = "SELECT * FROM product WHERE product_id = " . $id;
            $checkUpdateResult = mysqli_query($db, $checkUpdate);
            $checkUpdateRow = mysqli_fetch_assoc($checkUpdateResult);

            $pName = $checkUpdateRow['product_name'];
            $pSize = $checkUpdateRow['product_size'];
            $pPrice = $checkUpdateRow['product_price'];
            $pQuantity = 0;

            // update product: product quantity will get updated by adding the 
            // quantity stored in the database plus the new quantity 
            $stmt = "UPDATE product SET product_name = ?, product_size = ?, 
            product_quantity = product_quantity + ?, product_price = ?, login_id = ? WHERE product_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'ssidii', $productName, $size, $quantity, $price, $login_id, $id);
            
            // Check if the previous statement is executed
            if (mysqli_stmt_execute($updateStmt) === true) {

                // Get the user details 
                $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                $checkUserResult = mysqli_query($db, $checkUser);
                $result = mysqli_fetch_assoc($checkUserResult);

                // Initialize 
                $name = $result['first_name'] . " " . $result['last_name'];
                $privilege = $result['privileges_name'];
                $area = "Product";

                // Description will depend on what the user edited
                if ($productName != $pName && $size != $pSize && $price != $pPrice && $quantity != $pQuantity) {
                    // name, size , price, quantity
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", size to " . $size . ", price to ₱" . $price . ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName != $pName && $size != $pSize && $price == $pPrice && $quantity != $pQuantity) {
                    // name, size, quantity
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", size to " . $size . ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName != $pName && $size != $pSize && $price != $pPrice && $quantity == $pQuantity) {
                    // name, size, price
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", size to " . $size . ", price to ₱" . $price;
                } else if ($productName != $pName && $size == $pSize && $price == $pPrice && $quantity != $pQuantity) {
                    // name, quantity
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName != $pName && $size == $pSize && $price != $pPrice && $quantity == $pQuantity) {
                    // name, price
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", price to ₱" . $price;
                } else if ($productName != $pName && $size != $pSize && $price == $pPrice && $quantity == $pQuantity) {
                    // name, size
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName . 
                    ", size to " . $size;
                } else if ($productName != $pName && $size == $pSize && $price == $pPrice && $quantity == $pQuantity) {
                    // name
                    $description = $name . " has updated the product: ". $pName .". Product name to " . $productName;
                } else if ($productName == $pName && $size != $pSize && $price != $pPrice && $quantity != $pQuantity) {
                    // size, price, quantity
                    $description = $name . " has updated the product: ". $pName .". Product size to " . $size . 
                    ", price to ₱" . $price . ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName == $pName && $size != $pSize && $price == $pPrice && $quantity != $pQuantity) {
                    // size, quantity
                    $description = $name . " has updated the product: ". $pName .". Product size to " . $size . 
                    ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName == $pName && $size != $pSize && $price != $pPrice && $quantity == $pQuantity) {
                    // size, price
                    $description = $name . " has updated the product: ". $pName .". Product size to " . $size . 
                    ", price to ₱" . $price;
                } else if ($productName == $pName && $size != $pSize && $price == $pPrice && $quantity == $pQuantity) {
                    // size
                    $description = $name . " has updated the product: ". $pName .". Product size to " . $size;
                } else if ($productName == $pName && $size == $pSize && $price != $pPrice && $quantity != $pQuantity) {
                    // price, quantity
                    $description = $name . " has updated the product: ". $pName .". Product price to ₱" . $price . 
                    ", and has added " . $quantity . " quantity to the product.";
                } else if ($productName == $pName && $size == $pSize && $price != $pPrice && $quantity == $pQuantity) {
                    // price
                    $description = $name . " has updated the product: ". $pName .". Product price to ₱" . $price;
                } else if ($productName == $pName && $size == $pSize && $price == $pPrice && $quantity != $pQuantity) {
                    // quantity
                    $description = $name . " has updated the product: ". $pName .". Has added " . $quantity . " quantity to the product.";
                } else {
                    // do nothing
                }
                
                
                // Insert activity to the database
                if (!$description == null) {
                    $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                    $addActivityStmt = mysqli_prepare($db, $addActivity);
                    mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                    mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
                }
                
            }
            
            mysqli_close($db);

            $_SESSION['status'] = "Product has been updated";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/product.php");
        break;

        case 'delete':
            $id = validation($_POST['product_id']);

            // Check which is to be deleted by the user
            $checkUpdate = "SELECT * FROM product WHERE product_id = " . $id;
            $checkUpdateResult = mysqli_query($db, $checkUpdate);
            $checkUpdateRow = mysqli_fetch_assoc($checkUpdateResult);
            $pName = $checkUpdateRow['product_name'];

            // Delete Statement
            $stmt = "DELETE FROM product WHERE product_id = ?";
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
                $area = "Product";
                $description = $name . " has deleted the product: ". $pName;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

            mysqli_close($db);

            $_SESSION['status'] = "A product has been deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/product.php");
        break;
    }