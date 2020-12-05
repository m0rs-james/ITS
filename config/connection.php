<?php
    // database connection
    $db = mysqli_connect('localhost', 'root', '1234') or 
    die ('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'its') or die (mysqli_error($db));
    
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
