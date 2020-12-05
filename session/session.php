<?php

    // start the session
    session_start();

    // check if logged in 
    function logged_in() {
        return isset($_SESSION['MEMBER_ID']);
    }

    // if not logged in it will be redirected to login
    function confirm_logged_in() {
        if (!logged_in()) {
    ?>
            <script type="text/javascript">
				window.location = "../pages/login.php";
            </script>
        <?php
        }
    }
?>