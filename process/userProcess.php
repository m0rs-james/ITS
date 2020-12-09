<?php 

    include '../config/connection.php';

    switch ($_GET['action']) {

        case 'add':
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $address = $_POST['user_address'];
            $phoneNumber = $_POST['user_number'];


            $stmt = "INSERT INTO users (first_name, last_name, user_address, user_number)
            VALUES (?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'ssss', $firstName, $lastName, $address, $phoneNumber);
            mysqli_stmt_execute($insertStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New user has been saved";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountUsers.php");
        break;

        case 'edit':
            $id = $_POST['user_id'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $address = $_POST['user_address'];
            $phoneNumber = $_POST['user_number'];

            $stmt = "UPDATE users SET first_name = ?, last_name = ?, user_address = ?, user_number = ? WHERE user_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'ssssi', $firstName, $lastName, $address, $phoneNumber, $id);
            mysqli_stmt_execute($updateStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "User has been updated";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountUsers.php");
        break;

        case 'delete':
            $id = $_POST['user_id'];

            $stmt = "DELETE FROM users WHERE user_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die ('Error in updating database ' . mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "A user has been deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountUsers.php");
        break;
    }