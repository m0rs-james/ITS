<?php 

    include '../config/connection.php';
    
    

    switch ($_GET['action']) {
        case 'add':
            $name = $_POST['category_name'];
            $sql = "INSERT INTO category (category_id, category_name) VALUES (NULL, '{$name}')";
            mysqli_query($db, $sql) or die ('Error in updating database ' . $sql);
            
            $_SESSION['status'] = "New Category has been saved.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'edit':
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];
            $sql = "UPDATE category set category_name = '$name' WHERE category_id = ". $id;
            mysqli_query($db, $sql) or die ('Error in updating database ' . $sql);

            $_SESSION['status'] = "Category name has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'delete':
            $id = $_POST['category_id'];
            $sql = "DELETE FROM category WHERE category_id =" .$id;
            mysqli_query($db, $sql) or die ('Error in updating database ' . $sql);

            $_SESSION['status'] = "A Category has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");   
        break;
    }