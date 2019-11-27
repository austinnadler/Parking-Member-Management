<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');   
    
    session_start();
    if(!isset($_SESSION['username'])) { 
        header('Location: login.php');
        die;
    }

    require 'includes/inc.db.php';
    $phpScript = sanitize($_SERVER['PHP_SELF']);
    // $message = empty($_GET['message'])? 'Welcome' : sanitize($_GET['message']);

    $customerID = empty($_GET['id'])? '' : sanitize($_GET['id']);
    $make = $model = $license = "";
    
    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    function echoName() {
        global $customerID;
        try {
            
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
                SELECT CONCAT(last, ', ', first) AS name
                FROM customers
                WHERE id=$customerID
            ";
            $pdoStatement = $pdo->query($sql);
            $row = $pdoStatement->fetch();
            $name = $row['name'];         
            $pdo = null;
            echo $name;
        } catch(PDOException $e) {
            // die ('Database error');
            die($e->getMessage());
        }
    }

    function savePermit($id, $license, $make, $model) {
        try {
            $license = strtoupper($license);
            // require 'includes/inc.db.php'; // included above
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insert the vehicle and customer
            $sql = "
                INSERT INTO vehicles
                (customer\$id, licensePlate, make, model)
                VALUES
                ($id, '$license', '$make', '$model');

                INSERT INTO permits
                (customer\$id, vehicle\$id)
                VALUES
                ($id, LAST_INSERT_ID()); 
            ";

            $statement = $pdo->exec($sql);

            $pdo = null;
            return true;
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerID = sanitize($_POST['id']);
        $make       = sanitize($_POST['make']);
        $model      = sanitize($_POST['model']);
        $license    = sanitize($_POST['licensePlate']);

        $isEmptyMake    = empty($make);
        $isEmptyModel   = empty($model);   
        $isEmptyLicense = empty($license);

        $error = ($isEmptyMake || $isEmptyModel || $isEmptyLicense)? 'All fields are required' : '';
        
        $makeError    = (strlen($make) > 15)      ? 'Make cannot be longer than 15 characters'                : '';
        $modelError   = (strlen($model) > 20)     ? 'Model cannot be longer than 20 characters'               : '';
        $licenseError = (strlen($license) > 10)   ? 'License plate cannot be longer than 10 characters'       : '';

        $hasError = $error ||  $makeError || $modelError || $licenseError;

        if(!$hasError) {
            if(savePermit($customerID, $license, $make, $model)) {
                header("Location: listCustomerInfo.php?id=$customerID&message=Vehicle+and+permit+created");
                die;
            }
        }
    }
    require 'includes/inc.headerCrud.php';
?>
<p class="w3-center w3-large">Create new vehicle for <?php echoName() ?></p>
<p class="w3-center">
    <a onclick="history.back()"><i class="fa fa-arrow-left w3-btn w3-blue w3-round-large"></i></a>
</p>
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
        <form id="vehicleForm" class="w3-center" action="<?php echo $phpScript?>" method="POST">
        <input type="hidden" name='id' value="<?php echo $customerID ?>">
            <?php require 'includes/inc.editVehicle-createVehicle.php'?>