<?php 

    require '../config/connection.php';
    require '../validation/validation.php';

    switch ($_GET['action']) {

        case 'add':
            $firstName = validation($_POST['first_name']);
            $lastName = validation($_POST['last_name']);
            $address = validation($_POST['user_address']);
            $phoneNumber = validation($_POST['user_number']);
            
            $stmt = "INSERT INTO users (first_name, last_name, user_address, user_number)
            VALUES (?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'ssss', $firstName, $lastName, $address, $phoneNumber);

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
                $area = "Category";
                $description = $name . " has added new category: " . $categoryName;
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

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