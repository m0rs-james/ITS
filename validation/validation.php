<?php 

// validate user input 
function validation($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = htmlentities($data, ENT_QUOTES, 'UTF-8');
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    return $data;
}