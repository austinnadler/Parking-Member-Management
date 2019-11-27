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
        die;
    }

    $first = $last = $dfirst = $dlast = $phone = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $customerID = $_GET['id'];
           // fetch customer information and cache
        try {
            // Include the db connection string.
            require 'includes/inc.db.php';
            // Connect to the db.
            $pdo = new PDO(DSN, USER, PWD);
            // Configure the error handling.
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Create the query.
            $sql = "
                SELECT 
                first, last, phone
                FROM customers
                WHERE id=$customerID;
            ";
            // Execute the query.
            $pdoStatement = $pdo->query($sql);
            $pdo = null;

            $row = $pdoStatement->fetch();
            $first = $row['first'];
            $last = $row['last'];
            $phone = $row['phone'];
        } catch(PDOException $e) {
            die ($e->getMessage() );
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo 'Saving changes to database...';
        $id      = sanitize($_POST['id']);
        $first   = sanitize($_POST['first']);
        $last    = sanitize($_POST['last']);
        $phone   = sanitize($_POST['phone']);

        // Are any of the fields empty?
        $isEmptyFirst   = empty($first);
        $isEmptyLast    = empty($last);
        $isEmptyPhone   = empty($phone);

        $error = $isEmptyFirst || $isEmptyLast || $isEmptyPhone ? 'All fields are required' : '';
        
        $firstNameError = (strlen($first) > 15) ? 'First name cannot be longer than 15 characters' : '';
        $lastNameError  = (strlen($last) > 20)  ? 'Last name cannot be longer than 20 characters'  : '';
        $phoneError     = (strlen($phone) != 10 || !is_numeric($phone))? 'Phone number must be 10 digits long'  : '';

        !$hasError = $error || $firstNameError || $lastNameError || $phoneError;

        if(!$hasError) {
            require 'includes/inc.db.php';
            try {
                $pdo = new PDO(DSN, USER, PWD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "
                    UPDATE customers
                    SET 
                    first='$first', last='$last', phone='$phone'
                    WHERE id=$id;
                ";
                $pdoStatement = $pdo->exec($sql);
                $pdo = null;
                $name = $last . ', ' . $first;
                header("Location: listCustomerInfo.php?id=$id&message=Customer+changes+saved");
                die;
            } catch(PDOException $e) {
                // die ('Database error');
                die($e->getMessage());
            }        
        }
    }
    require 'includes/inc.headerCrud.php';
?>
<title>Edit Customer Information</title>
<p class="w3-center w3-large">Edit Customer Information</p>
<p class="w3-center">
    <a onclick="history.back()"><i class="fa fa-arrow-left w3-btn w3-blue w3-round-large"></i></a>
</p>
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
        <form id="customerForm" class="w3-center" action="<?php echo $phpScript ?>" method="POST">
            <p>
                <p><b>Customer Information</b></p>
                <p class="w3-text-red w3-small">No special characters or leading/trailing spaces in any fields.</p>
                <input readonly type="hidden" name='id' value="<?php echo $customerID ?>">
                <input readonly type="hidden" name='name' value ="<?php echo $customerName ?>">
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
            ?>
        </p>
</div>

<?php require 'includes/inc.footer.php'?>