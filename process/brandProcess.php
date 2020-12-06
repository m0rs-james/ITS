<?php

    include '../config/connection.php';


    switch ($_GET['action']) {

        case 'add':
            $name = $_POST['brand_name'];
            $sql = "INSERT INTO brand (brand_id, brand_name) VALUES (NULL, '{$name}')";
            mysqli_query($db, $sql) or die ('Error in updating database' . $sql);

            $_SESSION['status'] = "New Brand has been saved.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;

        case 'edit':
            $id = $_POST['brand_id'];
            $name = $_POST['brand_name'];
            $sql = "UPDATE brand SET brand_name = '$name' WHERE brand_id = " . $id;
            mysqli_query($db, $sql) or die ('Error in updating database' . $sql);

            $_SESSION['status'] = "Brand name has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;

        case 'delete':
            $id = $_POST['brand_id'];
            $sql = "DELETE FROM brand WHERE brand_id = " .$id;
            mysqli_query($db, $sql) or die ('Error in updating database.' . $sql);

            $_SESSION['status'] = "A Brand has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productBrand.php");
        break;
    }