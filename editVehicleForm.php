<?php 
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

    session_start();
    $curYear = Date('Y');

    $phpScript = sanitize($_SERVER['PHP_SELF']);

    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
    }

    $make = $model = $license = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $vehicleID = $_GET['vehicleID'];
        try {
            require 'includes/inc.db.php';
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
                SELECT 
                make, model, licensePlate
                FROM vehicles
                WHERE id=$vehicleID;
            ";
            $pdoStatement = $pdo->query($sql);
            $pdo = null;
            $row = $pdoStatement->fetch();
            $make = $row['make'];
            $model = $row['model'];
            $license = $row['licensePlate'];
        } catch(PDOException $e) {
            die ('Error retreiving vehicle information');
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo 'Saving changes to database...';
        $id      = sanitize($_POST['id']);
        $make    = ucwords(sanitize($_POST['make']));
        $model   = ucwords(sanitize($_POST['model']));
        $license = sanitize($_POST['licensePlate']);

        $isEmptyMake    = empty($make);
        $isEmptyModel   = empty($model);
        $isEmptyLicense = empty($license);

        $error = $isEmptyMake || $isEmptyModel || $isEmptyLicense ? 'All fields are required' : '';
        
        $makeError    = (strlen($make) > 15)      ? 'Make cannot be longer than 15 characters'                : '';
        $modelError   = (strlen($model) > 20)     ? 'Model cannot be longer than 20 characters'               : '';
        $licenseError = (strlen($license) > 10)   ? 'License plate cannot be longer than 10 characters'       : '';

        !$hasError = $error || $makeError || $modelError || $licenseError;

        if(!$hasError) {
            require 'includes/inc.db.php';
            $license = strtoupper($license);
            try {
                $pdo = new PDO(DSN, USER, PWD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "
                    UPDATE vehicles
                    SET 
                    make='$make', model='$model', licensePlate='$license'
                    WHERE id=$id;
                ";
                $pdoStatement = $pdo->exec($sql);

                $sql = "
                    SELECT customer\$id
                    FROM vehicles
                    WHERE id=$id;
                ";
                $pdoStatement = $pdo->query($sql);
                $customerRecord = $pdoStatement->fetch();
                $customerID = $customerRecord['customer$id'];

                $sql = "
                    SELECT CONCAT(last, ', ', first) as customerName
                    FROM customers
                    WHERE id=$customerID;
                ";

                $pdoStatement = $pdo->query($sql);
                $customerRecord = $pdoStatement->fetch();
                $customerName = $customerRecord['customerName'];
                $pdo = null;
                header("Location: listCustomerInfo.php?id=$customerID&message=Vehicle+changes+saved");
                die;            
            } catch(PDOException $e) {
                die ('Error updating vehicle information');
            }        
        }
    }
    
    require 'includes/inc.headerCrud.php';
?>

<title>Edit Vehicle Information</title>
<p class="w3-center w3-large">Edit Vehicle Information</p>
<p class="w3-center">
    <a onclick="history.back()"><i class="fa fa-arrow-left w3-btn w3-blue w3-round-large"></i></a>
</p>
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
        <form id="vehicleForm" class="w3-center" action="<?php echo $phpScript?>" method="POST">
            <input type="hidden" name='id' value="<?php echo $vehicleID ?>">
            <?php require 'includes/inc.editVehicle-createVehicle.php'?>