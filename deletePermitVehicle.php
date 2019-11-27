<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    session_start();

    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
        die;
    }

    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    $permitID = $_GET['permitID'];
    $vehicleID = $_GET['vehicleID'];
    $customerID = $_GET['customerID'];
    $fromPage = $_GET['fromPage'];

    try {
        require 'includes/inc.db.php';
        $pdo = new PDO(DSN, USER, PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            DELETE FROM permits 
            WHERE id=$permitID;
        ";
        $result = $pdo->exec($sql);
        
        $sql = "                
            DELETE FROM vehicles
            WHERE id=$vehicleID;
        ";
        $result = $pdo->exec($sql);            
        $pdo = null;
        // Don't delete customer even if the vehicle deleted is their only one. 
        // May have meant to add another vehicle before deleting, putting all info back in would be annoying
    } catch (PDOException $e) {
        die ("Error deleting record. Try again.");
    }
    header("Location: listCustomerInfo.php?id=$customerID&message=Vehicle+and+permit+deleted");
    die;
?>
<!--File: permitDelete.php
    Author: Austin Nadler -->