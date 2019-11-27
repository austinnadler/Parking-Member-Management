<!--File: logout.php
    Author: Austin Nadler -->
<!-- End session and redirect to login -->
<?php
    session_start();
    session_destroy();
    header('Location: login.php');
    die;
?>