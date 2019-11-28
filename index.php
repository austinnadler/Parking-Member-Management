<?php
    
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

    session_start();
    $curYear = Date('Y');
    
    if(!isset($_SESSION['username'])) { // redirect to login if not signed in
        header('Location: login.php');
        die;
    }

    $updateMessage = empty($_GET['updateMessage'])? '' : sanitize($_GET['updateMessage']); // if coming from a create or delete page, update message will give confirmation
    $message = empty($_GET['message'])? 'Welcome' : sanitize($_GET['message']);
    $prompt = '<h1>'. $message . ', '. $_SESSION['username'] . '!</h1>';
    $pdoStatement = '';

    function sanitize($value) {
        return htmlspecialchars(stripslashes(trim($value)));
    }
    
    function FetchAndDisplayRecords() {
        try {
            require 'includes/inc.db.php';
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Select all customers sorted by last name then first name
            $sql = "
                SELECT 
                id, 
                CONCAT(last, ', ', first) AS 'customer', 
                phone
                FROM customers
                ORDER BY last, first;
            ";
            $pdoStatement = $pdo->query($sql);
            echo createTable($pdoStatement);
            $pdo = null;
        } catch(PDOException $e) {
            die ($e->getMessage() );
        }
    }

    function createTable(PDOStatement $pdoStatement) : string {

        $table = '
                <table class="w3-table-all w3-card-4">
                    <tr class="w3-red">
                        <th>Customer ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                    </tr>
        ';

        // Fetch each row as an associative array.
        while ( $row = $pdoStatement->fetch() ) {

            $customerID = $row['id'];
            $customerName = $row['customer'];
            $phone = $row['phone'];
            $phone = '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . ' - ' . substr($phone, 6,4);

            // add each row, and buttons to delete or edit them.
            $table .= "
                <tr>
                <td>$customerID</td>
                <td><a href='listCustomerInfo.php?id=$customerID'>$customerName</a></td>
                <td>$phone</td>
                </tr>
            ";
        }
        $table .= '</table>';
        return $table;
    }
    require 'includes/inc.header.php';
?>

<!--File: index.php
    Author: Austin Nadler -->
<?php echo $prompt; ?>
<p>All customers are listed below. Click on a name to view vehicles & permits.</p>

</header>
<p class="w3-center">
    <a href="logout.php" title="Sign out" class="fa fa-sign-out w3-round-large w3-btn w3-blue"> Sign Out</a>
</p>
<div class="w3-content me-indexUpdateMessage">
    <h2 id="updateField" class="w3-card-4 w3-round-large w3-green w3-center">
        <?php if(!empty($updateMessage)) { echo ($updateMessage . "<span id='hideMessage' class='w3-large w3-btn w3-right-align'> X</span>"); } ?>
    </h2>

</div>
<title>Home</title>
<div class="w3-content me-customerTable">
    <div class="w3-panel">
        <?php echo FetchAndDisplayRecords() ?>
    </div>
</div>
    <div class="w3-center">
        <p>
            <a href="createPermit.php" title='Create new customer, vehicle, and permit' class="fa fa-plus w3-btn w3-blue w3-round-large">&ensp;&ensp;New Customer</a>
        </p>
</div>
<!-- To do -->
<ul class="w3-red">
</ul>
<script src="js/index-listCustomerInfo.js"></script>
<?php require 'includes/inc.footer.php'; ?>