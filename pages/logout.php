<?php

    switch ($_GET['action']) {
        case 'logout':
            session_destroy();
            unset($_SESSION['login_id']);

            header("Location: ../index.php");
        break;
    }