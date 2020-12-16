<?php

    include '../config/connection.php';

    switch ($_GET['action']) {

        case 'add':
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $city = $_POST['city'];
            $zipCode = $_POST['zip_code'];
            $phoneNumber = $_POST['phone_number'];

            $stmt = "INSERT INTO customer (cust_first_name, cust_last_name, cust_street, cust_barangay,
            cust_city, cust_zip_code, cust_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'sssssss', $firstName, $lastName, $street, $barangay,
            $city, $zipCode, $phoneNumber);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' .mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Customer has been saved";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountCustomer.php");
        break;

        case 'edit':
            $id = $_POST['customer_id'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $city = $_POST['city'];
            $zipCode = $_POST['zip_code'];
            $phoneNumber = $_POST['phone_number'];

            $stmt = "UPDATE customer SET cust_first_name = ?, cust_last_name = ?, cust_street = ?, cust_barangay = ?,
            cust_city = ?, cust_zip_code = ?, cust_number = ? WHERE customer_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'sssssssi', $firstName, $lastName, $street, $barangay,
            $city, $zipCode, $phoneNumber, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' .mysqli_error($db));

            mysqli_close($db);
            $_SESSION['status'] = "Customer has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountCustomer.php");
        break;

        case 'delete':
            $id = $_POST['customer_id'];

            $stmt = "DELETE FROM customer WHERE customer_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' .mysqli_error($db));

            mysqli_close($db);
            
            $_SESSION['status'] = "Customer has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountCustomer.php");
        break;
    }