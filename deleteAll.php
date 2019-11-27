<?php  
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    session_start();

    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
        die;
    }

    $customerID = $_GET['customerID'];
    deleteAllRecords($customerID);


    function deleteAllRecords($customerID) {
        try {
            require 'includes/inc.db.php';

            $pdo = new PDO(DSN, USER, PWD);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "
                DELETE FROM permits 
                WHERE customer\$id=$customerID;
            ";

            $result = $pdo->exec($sql);

            $sql = "                
                DELETE FROM vehicles
                WHERE customer\$id=$customerID;
            ";

            $result = $pdo->exec($sql);

            $sql = "                
                DELETE FROM customers
                WHERE id=$customerID;
            ";

            $result = $pdo->exec($sql);
            header('Location: index.php?updateMessage=Customer+information+deleted');
            die;

            $pdo = null;
        } catch (PDOException $e) {
            die ("Error deleting record. Try again.");
        }
    }
?>