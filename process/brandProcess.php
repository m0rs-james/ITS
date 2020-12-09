<?php

    include '../config/connection.php';


    switch ($_GET['action']) {

        case 'add':
            $name = $_POST['brand_name'];
            $stmt = "INSERT INTO brand (brand_name) VALUES (?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 's', $name);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Brand has been saved.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;

        case 'edit':
            $id = $_POST['brand_id'];
            $name = $_POST['brand_name'];
            $stmt = "UPDATE brand SET brand_name = ? WHERE brand_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'si', $name, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Brand name has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;

        case 'delete':
            $id = $_POST['brand_id'];
            $stmt = "DELETE FROM brand WHERE brand_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "A Brand has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;
    }