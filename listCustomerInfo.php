<?php 
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

    session_start();
    $curYear = Date('Y');
    $customerID = sanitize($_GET['id']);
    // If message is empty, set to empty string, else set to sanitized message
    $message = empty($_GET['message'])? '' : sanitize($_GET['message']);

    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
        die;
    }

    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    function echoCustomerInformation() {
        global $customerID;
        try {
            require 'includes/inc.db.php';
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
                SELECT 
                CONCAT(last, ', ', first) AS name,
                phone,
                licenseNum
                FROM customers
                WHERE id=$customerID
            ";
            $pdoStatement = $pdo->query($sql);
            $row = $pdoStatement->fetch();
            $name = $row['name'];   
            $phone = $row['phone'];    
            $phone = '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . ' - ' . substr($phone, 6,4);  
            $pdo = null;
            echo $name . '<br>' . $phone;
        } catch(PDOException $e) {
            die ('Database error');
        }
    }
    
    function fetchAndDisplayRecords() {
        global $customerID;
        try {
            // require 'includes/inc.db.php'; already included in echoName()
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
                SELECT 
                p.id AS 'permitID',
                p.dateIssued AS issued,
                p.dateExpires AS expires,
                c.id AS 'customerID', 
                c.licenseNum as licenseNum,
                CONCAT(c.last, ', ', c.first) AS 'customer', 
                c.phone AS phone, 
                v.id AS vehicleID, 
                v.make AS make, 
                v.model AS model, 
                v.licensePlate AS license 
                FROM customers AS c, vehicles AS v, permits AS p
                WHERE c.id=$customerID AND c.id=p.customer\$id AND v.id=p.vehicle\$id;
            ";
            $pdoStatement = $pdo->query($sql);
            echo createTable($pdoStatement);
            $row = $pdoStatement->fetch();
            $pdo = null;
        } catch(PDOException $e) {
            die ($e->getMessage() );
        }
    }

    function createTable(PDOStatement $pdoStatement) : string {
        $table = '
            <form action="" method="GET">
                <table class="w3-table-all w3-card-4">
                    <tr class="w3-red">
                        <th>Permit ID</th>
                        <th>Issued On</th>
                        <th>Expires On</th>
                        <th>Vehicle ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>License Plate</th>
                        <th></th>
                    </tr>
        ';

        // Fetch each row as an associative array.
        while ( $row = $pdoStatement->fetch() ) {
            $customerID = $row['customerID'];
            $issued = $row['issued'];
            $expires = $row['expires'];
            $permitID = $row['permitID'];
            $vehicleID = $row['vehicleID'];
            $make = $row['make'];
            $model = $row['model'];
            $licensePlate = $row['license'];
            $licenseNum = $row['licenseNum'];

            // add each row, and buttons to delete or edit them.
            $table .= "
                <tr>
                    <td>$permitID</td>
                    <td>$issued</td>
                    <td>$expires</td>
                    <td>$vehicleID</td>
                    <td>$make</td>
                    <td>$model</td>
                    <td>$licensePlate</td>
                    <td>
                        <a href='editVehicleForm.php?vehicleID=$vehicleID' class='fa fa-pencil w3-btn w3-text-blue w3-round-large' title='Edit vehicle info'>
                        <a href='deletePermitVehicle.php?permitID=$permitID&vehicleID=$vehicleID&customerID=$customerID&fromPage=listCustomerInfo' class='fa fa-trash  w3-btn w3-text-blue w3-round-large' title='Delete permit and vehicle'>                         
                    </td>
                </tr>
            ";
        }
        $table .= "</table></form><p class='w3-center w3-small w3-text-grey'>Driver's License #: $licenseNum</p>";
        return $table;
    }
    require 'includes/inc.headerCrud.php';
?>
<?php 
    if(!empty($updateMessage)) { echo $updateMessage; }
?>
<title>Customer Information</title>
<h2 class=w3-center>
    <?php echoCustomerInformation() ?>
</h2>
<p class="w3-center">
    <a  href="editCustomerForm.php?id=<?php echo $customerID ?>" 
        title="Edit customer information" 
        class="fa fa-pencil w3-btn w3-blue w3-round-large">&ensp;&ensp;Edit Customer
    </a>
    <a  href="deleteAll.php?customerID=<?php echo $customerID ?>" 
        title="Delete customer, their vehicles, and their permits" 
        class="fa fa-trash w3-btn w3-blue w3-round-large">&ensp;&ensp;Delete Customer
    </a>
</p>
<div class="w3-content me-listCustomerInfoUpdateMessage">
    <h2 id="updateField" class="w3-green w3-center w3-round">
        <?php if(!empty($message)) { echo ($message . "<i id='hideMessage' class='w3-large fa fa-times w3-btn'></i>"); } ?>
    </h2>
</div>

<div class="w3-content me-vehicleTable">
    <div class="w3-panel">
        <?php fetchAndDisplayRecords() ?>
    </div>
</div>
<p class=w3-center>
    <a  href="createPermitVehicle.php?id=<?php echo $customerID ?>" 
        title="New Vehicle & Permit"
        class="fa fa-plus w3-btn w3-blue w3-round-large">&ensp;&ensp;New Vehicle & Permit
    </a>
</p>
<script src="js/index-listCustomerInfo.js"></script>
<?php require 'includes/inc.footer.php'; ?>