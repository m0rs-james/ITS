<?php
    
    session_start();

    if (isset($_POST['logout'])) {

        session_destroy();
        unset($_SESSION['login_id']);
        unset($_SESSION['name']);
        unset($_SESSION['type']);

        header("Location: ../index.php");
    }