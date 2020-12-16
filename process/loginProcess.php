<?php

    session_start();
    require '../config/connection.php';
    require '../validation/validation.php';

    switch ($_GET['action']) {

        case 'add':
            $employee = validation($_POST['employee_id']);
            $username = validation($_POST['username']);
            $password = validation($_POST['password']);
            $privilege = validation($_POST['privilege_id']);

            // Hash the password
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = "INSERT INTO login (user_id, username, password, privileges_id) VALUES (?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'issi', $employee, $username, $hash_password, $privilege);
            mysqli_stmt_execute($insertStmt) or die (mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "New Login has been saved";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountLogin.php");
        break;

        case 'edit':
            $id = validation($_POST['login_id']);
            $username = validation($_POST['username']);
            $password = validation($_POST['password']);
            $repeatPassword = validation($_POST['repeat_password']);

            if ($password == $repeatPassword) {
                $hash_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = "UPDATE login SET username = ?, password = ? WHERE login_id = ?";
                $updateStmt = mysqli_prepare($db, $stmt);
                mysqli_stmt_bind_param($updateStmt, 'ssi', $username, $hash_password, $id);
                mysqli_stmt_execute($updateStmt) or die (mysqli_error($db));

                mysqli_close($db);

                $_SESSION['status'] = "Login has been updated";
                $_SESSION['status_code'] = "success";
                header("Location: ../pages/accountLogin.php");
            } else {

                $_SESSION['status'] = "Password does not match";
                $_SESSION['status_code'] = "warning";
                header("Location: ../pages/accountLogin.php");
            }

        break;

        case 'delete':
            $id = validation($_POST['login_id']);

            $stmt = "DELETE FROM login WHERE login_id = ?";
            $deleteStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($deleteStmt, 'i', $id);
            mysqli_stmt_execute($deleteStmt) or die (mysqli_error($db));

            mysqli_close($db);

            $_SESSION['status'] = "Login has been delete";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/accountLogin.php");
        break;

        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id 
            INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE username = ?";
            $loginStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($loginStmt, 's', $username);
            mysqli_stmt_execute($loginStmt) or die ('Error in updating database ' . mysqli_error($db));

            $result = mysqli_stmt_get_result($loginStmt);

            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $hash_password = $row['password'];
                if (password_verify($password, $hash_password)) {

                    // Store the login_id of the user in session
                    $_SESSION['type'] = $row['privileges_id'];
                    $_SESSION['login_id'] = $row['login_id'];
                    $_SESSION['name'] = $row['first_name'] . " " . $row['last_name'];

                    $_SESSION['status'] = "Welcome back, " . $row['first_name'] . "!";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../pages/dashboard.php");
                } else {

                    $_SESSION['status'] = "Login Failed: Incorrect Password";
                    $_SESSION['status_code'] = "error";
                    header("Location: ../pages/login.php");
                }

            } else {
                $_SESSION['status'] = "Invalid Username or Password";
                $_SESSION['status_code'] = "error";
                header("Location: ../pages/login.php");
            }
        break;

        case 'logout':
            session_destroy();
            unset($_SESSION['login_id']);

            header("Location: ../index.php");
        break;

    }