<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');   

    session_start();
    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
        die;
    }
    
    $first = $last = $phone = $make = $model = $license = '';
    $error = $licenseError = $phoneError = $firstNameError = $lastNameError = $makeError = $modelError = '';

    $phpScript = sanitize($_SERVER['PHP_SELF']);

    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    function savePermit($first, $last, $phone, $license, $make, $model) {
        try {
            $license = strtoupper($license);
            require 'includes/inc.db.php';
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insert the vehicle and customer
            $sql = "
                INSERT INTO customers
                (first, last, phone)
                VALUES
                ('$first', '$last', '$phone');

                INSERT INTO vehicles
                (customer\$id, licensePlate, make, model)
                VALUES
                (LAST_INSERT_ID(), '$license', '$make', '$model');
            ";
            $statement = $pdo->exec($sql);

            // retrieve the id of the vehicle and customer that we just added
            $sql = "
                SELECT id FROM vehicles ORDER BY id DESC LIMIT 1;
            ";
            $vehicleStatement = $pdo->query($sql);
            $recordV = $vehicleStatement->fetch();
            $vehicleFK = $recordV['id'];

            $statement = $pdo->query($sql);
            $sql = "
                SELECT id FROM customers ORDER BY id DESC LIMIT 1;
            ";
            $customerStatement = $pdo->query($sql);
            $recordC = $customerStatement->fetch();
            $customerFK = $recordC['id'];

            // use the customer and vehicle ID to
            $sql = "
                INSERT INTO permits
                (customer\$id, vehicle\$id)
                VALUES
                ('$customerFK', '$vehicleFK');
            ";
            $statement = $pdo->exec($sql);

            $pdo = null;
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $first   = sanitize($_POST['first']);
        $last    = sanitize($_POST['last']);
        $phone   = sanitize($_POST['phone']);
        $make    = sanitize($_POST['make']);
        $model   = sanitize($_POST['model']);
        $license = sanitize($_POST['licensePlate']);

        // Are any of the fields empty?
        $isEmptyFirst       = empty($first);
        $isEmptyLastName    = empty($last);
        $isEmptyPhone       = empty($phone);
        $isEmptyMake        = empty($make);
        $isEmptyModel       = empty($model);   
        $isEmptyLicense     = empty($license);

        $error = $isEmptyFirst || $isEmptyLastName || 
                 $isEmptyPhone || $isEmptyMake     || 
                 $isEmptyModel || $isEmptyLicense
                 ? 'All fields are required' : '';
        
        $firstNameError = (strlen($first) > 15)     ? 'First name cannot be longer than 15 characters'          : '';
        $lastNameError  = (strlen($last) > 20)      ? 'Last name cannot be longer than 20 characters'           : '';
        $makeError      = (strlen($make) > 15)      ? 'Make cannot be longer than 15 characters'                : '';
        $modelError     = (strlen($model) > 20)     ? 'Model cannot be longer than 20 characters'               : '';
        $licenseError   = (strlen($license) > 10)   ? 'License plate cannot be longer than 10 characters'       : '';
        $phoneError     = (strlen($phone) != 10 || !is_numeric($phone))? 'Phone number must be 10 digits long'  : '';

        !$hasError = $error || $firstNameError || $lastNameError || $makeError || $modelError || $licenseError || $phoneError;

        if(!$hasError) {
            if(savePermit($first, $last, $phone, $license, $make, $model)) {
                header('Location: index.php?updateMessage=Permit+created');
                die;
            }
        }
    }
    require 'includes/inc.headerCrud.php';
?>

<!--File: create.php
    Author: Austin Nadler -->
<title>Create New Permit</title>
<h1 class=w3-center>Create New Permit</h1>
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
        <form class="w3-center" id="permitForm" action="<?php echo $phpScript?>" method="POST">
            <p><b>Customer Information</b></p>
            <p class="w3-text-red w3-small">No special characters or leading/trailing spaces in any fields.</p>
            <p>
                <span class="w3-tiny">First name, max 15 characters</span><br>
                <input  required
                        autofocus
                        type="text" 
                        name="first"
                        id="first"
                        placeholder="First name"
                        value="<?php echo $first ?>">
                        <span id="firstValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">Last name, max 20 characters</span><br>
                <input  required
                        type="text" 
                        name="last"
                        id="last"
                        placeholder="Last name"
                        value="<?php echo $last ?>">
                        <span id="lastValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">Phone number, 10 digits</span><br>
                <input  required
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="10-digit phone"
                        value="<?php echo $phone ?>">
                        <span id="phoneValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p><b>Vehicle Information</b></p>
                <span class="w3-tiny">Make, max 15 characters</span><br>
                <input  required
                        type="text" 
                        name="make"
                        id="make"
                        placeholder="Make"
                        value="<?php echo $make ?>">
                        <span id="makeValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">Model, max 30 characters</span><br>
                <input  required
                        type="text" 
                        name="model"
                        id="model"
                        placeholder="Model"
                        value="<?php echo $model ?>">
                        <span id="modelValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">License Plate, max 10 characters</span><br>
                <input  required
                        type="text" 
                        name="licensePlate"
                        id="licensePlate"
                        placeholder="License Plate"
                        value="<?php echo $license ?>">
                        <span id="licensePlateValidIcon" class="w3-text-red"> *</span>  
            </p>
            <p>
                <button class="w3-btn w3-round-large w3-blue" name="submit">Submit</button>
            </p>
        </form>
    </div>
        <p class="w3-text-red w3-center">
            <?php if(!empty($error))            { echo $error; }
                  if(!empty($firstNameError))   { echo '<br>' . $firstNameError;}
                  if(!empty($lastNameError))    { echo '<br>' . $lastNameError; } 
                  if(!empty($phoneError))       { echo '<br>' . $phoneError; } 
                  if(!empty($makeError))        { echo '<br>' . $makeError; } 
                  if(!empty($modelError))       { echo '<br>' . $modelError; } 
                  if(!empty($licenseError))     { echo '<br>' . $licenseError; } 

            ?>
        </p>
</div>

<?php require 'includes/inc.footer.php' ?>