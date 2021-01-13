<?php 

    require '../config/connection.php';
    require '../validation/validation.php';

    $login_id = $_SESSION['login_id'];

    switch ($_GET['action']) {
        
        case 'add':
            $categoryName = validation($_POST['category_name']);
            
            // Insert Statement
            $stmt = "INSERT INTO category (category_name, login_id) VALUES (?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'si', $categoryName, $login_id);

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

            $_SESSION['status'] = "New Category has been saved.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'edit':
            $id = validation($_POST['category_id']);
            $categoryName = validation($_POST['category_name']);

            // Get the category name
            $checkCategory = "SELECT * FROM category WHERE category_id = ". $id;
            $checkCategoryResult = mysqli_query($db, $checkCategory);
            $checkResult = mysqli_fetch_assoc($checkCategoryResult);

            // Update Statement
            $stmt = "UPDATE category SET category_name = ? WHERE category_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'si', $categoryName, $id);

            // Check if the previous statement is executed
            if (mysqli_stmt_execute($updateStmt) === true) {

                // Get the user details 
                $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
                INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
                $checkUserResult = mysqli_query($db, $checkUser);
                $result = mysqli_fetch_assoc($checkUserResult);

                // Initialize 
                $category = $checkResult['category_name'];
                $name = $result['first_name'] . " " . $result['last_name'];
                $privilege = $result['privileges_name'];
                $area = "Category";
                $description = $name . " has updated the category ". $category . " to ". $categoryName;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }

            mysqli_close($db);

            $_SESSION['status'] = "Category name has been updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");
        break;

        case 'delete':
            $id = validation($_POST['category_id']);

            // Get the category name
            $checkCategory = "SELECT * FROM category WHERE category_id = ". $id;
            $checkCategoryResult = mysqli_query($db, $checkCategory);
            $checkResult = mysqli_fetch_assoc($checkCategoryResult);
            $categoryName = $checkResult['category_name'];

            // Delete Statement
            $stmt = "DELETE FROM category WHERE category_id = ?";
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
                $area = "Category";
                $description = $name . " has deleted the category: ". $categoryName;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));
            }


            mysqli_close($db);

            $_SESSION['status'] = "A Category has been deleted.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/productCategory.php");   
        break;
    }