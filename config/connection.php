<?php
    // database connection
    $db = mysqli_connect('localhost', 'root', '') or 
    die ('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'new_its') or die (mysqli_error($db));
    
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
