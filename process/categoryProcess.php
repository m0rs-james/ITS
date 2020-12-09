<?php 

    include '../config/connection.php';

    switch ($_GET['action']) {
        
        case 'add':
            $name = $_POST['category_name'];
            $stmt = "INSERT INTO category (category_name) VALUES (?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 's', $name);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Category has been saved.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'edit':
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];
            $stmt = "UPDATE category SET category_name = ? WHERE category_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'si', $name, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Category name has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'delete':
            $id = $_POST['category_id'];
            $stmt = "DELETE FROM category WHERE category_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "A Category has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");   
        break;
    }