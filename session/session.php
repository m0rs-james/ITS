<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    // check if the user is logged in
    if(!$_SESSION['login_id']) {
        header("Location: ../index.php");
        die();
    }
