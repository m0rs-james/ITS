<?php 

    require '../config/connection.php';
    require '../validation/validation.php';

    $login_id = $_SESSION['login_id'];

    if(isset($_GET['id'])) {

        $id = $_GET['id'];
        $newStatus = 1;

        // Update shipment status
        $updateStatus = "UPDATE shipment SET status = ?, login_id = ? WHERE shipment_id = ?";
        $updateStatusResult = mysqli_prepare($db, $updateStatus);
        mysqli_stmt_bind_param($updateStatusResult, 'iii', $newStatus, $login_id, $id);
        
        // Check if the previous statement is executed
        if (mysqli_stmt_execute($updateStatusResult) === true) {

            // Get the sales_id
            $getSalesId = "SELECT sales_id FROM shipment WHERE shipment_id = ". $id;
            $getSalesIdResult = mysqli_query($db, $getSalesId);
            $salesId = mysqli_fetch_assoc($getSalesIdResult) or die(mysqli_error($db));
            $salesID = $salesId['sales_id'];
            $salesStatus = 2;

            // Update sales status
            $updateStatus = "UPDATE sales SET sales_status = ?, login_id = ? WHERE sales_id = ?";
            $updateStatusResult = mysqli_prepare($db, $updateStatus);
            mysqli_stmt_bind_param($updateStatusResult, 'iii', $salesStatus, $login_id, $salesID);
            mysqli_stmt_execute($updateStatusResult) or die(mysqli_error($db));

            // Get the user details 
            $checkUser = "SELECT * FROM login INNER JOIN users ON login.user_id = users.user_id
            INNER JOIN privileges ON login.privileges_id = privileges.privileges_id WHERE login_id = ". $login_id;
            $checkUserResult = mysqli_query($db, $checkUser);
            $result = mysqli_fetch_assoc($checkUserResult);
            
            // Initialize 
            $name = $result['first_name'] . " " . $result['last_name'];
            $privilege = $result['privileges_name'];
            $area = "Shipment";
            $description = $name . " has updated the status of shipment with id: ". $id ." to Complete.";
            
            // Insert activity to the database
            $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
            $addActivityStmt = mysqli_prepare($db, $addActivity);
            mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
            mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));

            $_SESSION['status'] = "Shipment status has been successfully updated.";
            $_SESSION['status_code'] = "success";
            header("Location: ../pages/deliveryShipment.php");
        } else {
            die(mysqli_error($db));
        }

        mysqli_close($db);
        
    }

    switch ($_GET['action']) {
        
        case 'add':
            $deliveryName = validation($_POST['courier_name']);
            $shippingFee = validation($_POST['shipping_fee']);
            
            // Insert Statement
            $stmt = "INSERT INTO delivery (delivery_name, shipping_fee, login_id) VALUES (?, ?, ?)";
            $insertStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($insertStmt, 'sii', $deliveryName, $shippingFee, $login_id);

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
                $area = "Delivery";
                $description = $name . " has added new category: " . $deliveryName;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));

                $_SESSION['status'] = "New Courier has been saved.";
                $_SESSION['status_code'] = "success";
                header("Location: ../pages/deliveryCourier.php");
            } else {
                /* die(mysqli_error($db)); */
                $_SESSION['status'] = "New Courier has not been saved.";
                $_SESSION['status_code'] = "error";
                header("Location: ../pages/deliveryCourier.php");
            }

            mysqli_close($db);

            
        break;

        case 'edit':
            $id = validation($_POST['courier_id']);
            $courierName = validation($_POST['courier_name']);
            $shippingFee = validation($_POST['shipping_fee']);

            // Get the delivery name
            $checkDelivery = "SELECT * FROM delivery WHERE delivery_id = ". $id;
            $checkDeliveryResult = mysqli_query($db, $checkDelivery);
            $checkResult = mysqli_fetch_assoc($checkDeliveryResult);
            $courier = $checkResult['delivery_name'];
            $fee = $checkResult['shipping_fee'];


            // Update Statement
            $stmt = "UPDATE delivery SET delivery_name = ?, shipping_fee = ? WHERE delivery_id = ?";
            $updateStmt = mysqli_prepare($db, $stmt);
            mysqli_stmt_bind_param($updateStmt, 'sii', $courierName, $shippingFee, $id);

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
                $area = "Delivery";

                if ($courierName != $courier && $shippingFee != $fee) {
                    $description = $name . " has updated the courier ". $courier . " to ". $courierName . " and shipping fee to " .$shippingFee;   
                } else if ($courierName == $courier && $shippingFee != $fee) {
                    $description = $name . " has updated the courier ". $courier . " shipping fee to " .$shippingFee;   
                } else if ($courierName != $courier && $shippingFee == $fee) {
                    $description = $name . " has updated the courier ". $courier . " to ". $courierName;
                } else {
                    // do nothing
                }
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));

                $_SESSION['status'] = "Courier name has been updated.";
                $_SESSION['status_code'] = "success";
                header("Location: ../pages/deliveryCourier.php");
            } else {
                $_SESSION['status'] = "Courier name has not been updated.";
                $_SESSION['status_code'] = "error";
                header("Location: ../pages/deliveryCourier.php");
            }

            mysqli_close($db);

            
        break;

        case 'delete':
            $id = validation($_POST['courier_id']);

            // Get the delivery name
            $checkDelivery = "SELECT * FROM delivery WHERE delivery_id = ". $id;
            $checkdeliveryResult = mysqli_query($db, $checkDelivery);
            $checkResult = mysqli_fetch_assoc($checkdeliveryResult);
            $deliveryName = $checkResult['delivery_name'];

            // Delete Statement
            $stmt = "DELETE FROM delivery WHERE delivery_id = ?";
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
                $area = "Delivery";
                $description = $name . " has deleted the courier: ". $deliveryName;
                
                // Insert activity to the database
                $addActivity = "INSERT INTO activityLog (permission, user, area, description) VALUES (?, ?, ?, ?)";
                $addActivityStmt = mysqli_prepare($db, $addActivity);
                mysqli_stmt_bind_param($addActivityStmt, 'ssss', $privilege, $name, $area, $description);
                mysqli_stmt_execute($addActivityStmt) or die ('Error in updating database ' . mysqli_error($db));

                $_SESSION['status'] = "A Courier has been deleted.";
                $_SESSION['status_code'] = "success";
                header("Location: ../pages/deliveryCourier.php");  
            } else {
                $_SESSION['status'] = "A Courier has not been deleted.";
                $_SESSION['status_code'] = "error";
                header("Location: ../pages/deliveryCourier.php");  
            }


            mysqli_close($db);
        break;
    }

    