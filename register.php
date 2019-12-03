<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $curYear = Date('Y');
    $phpScript = sanitizeInput($_SERVER['PHP_SELF']);
    $username = $password = '';
    $usernameError = $passwordError = '';

    function sanitizeInput($input) {
        return htmlspecialchars( stripslashes( trim($input) ) );
    }

    function attemptRegister($username, $password) {
        try {
            require 'includes/inc.db.php';
            $pdo = new PDO(DSN, USER, PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // check if the username is already taken
            $pdoStatement = $pdo->query("
                                        SELECT username FROM users WHERE username = '$username'
                                    ");
            // if a record is found then the username already exists in the db
            if($pdoStatement->rowCount() > 0) {
                // $usernameError = 'That username is already taken';
                return 'That username is taken';
            } else {
                $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
                $sql = "
                        INSERT INTO users 
                        (username, password)
                        VALUES
                        ('$username', '$encryptedPassword')
                        ";
                $pdoStatement = $pdo->exec($sql);
                header('Location: login.php');
                die;
            }
        } catch(PDOException $e) {
            die("An error occured. Try again.");
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        // set empty bool to true if fields are empty after sanitation
        // $isUsernameEmpty = empty($username);
        // $isPasswordEmpty = empty($password);

        // set errors if the fields are empty
        $usernameError = empty($username) || strlen($username) < 5 || strlen($username) > 20? 'Enter a username (5 character min, 20 character max)' : '';
        $passwordError = empty($password) || strlen($password) < 5 || strlen($password) > 20? 'Enter a password (5 character min, 20 character max)' : '';

        // hasEmptyFields = true if there are errors
        $hasEmptyFields = $usernameError || $passwordError;

        if(!$hasEmptyFields) {
            $usernameError = attemptRegister($username, $password);
        }
    }
    require 'includes/inc.header.php'; 
?>

<!--File: registerForm.php
    Author: Austin Nadler-->

<title>Register</title>
<h1>Parking Services</h1>
</header>
<h2 class="w3-center">Register</h2>
<h2 class="w3-center w3-large w3-text-red"> 
    <?php 
        if(!empty($usernameError))      {echo $usernameError . '<br>';} 
        if(!empty($passwordError))      {echo $passwordError;}           
    ?>
</h2>
<script src="js/login-register.js"></script>
<form id="loginRegister" class="w3-center" action="<?php echo $phpScript ?>" method="POST">
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
        <p class="w3-text-red w3-tiny">No special characters. 5-20 alphanumeric characters for both fields</p>
        <p class="w3-center">
            <!-- username and password variables are put into POST array thanks to the name field -->
            <!-- value field echos the $username php variable to make it sticky -->
            <input  class="w3-border w3-round" 
                    type="text" 
                    value="<?php echo $username?>"
                    name="username" 
                    id="username"
                    placeholder="Username" 
                    required>
                    <span id="usernameValidationIcon" class="w3-text-red"> *</span>
        </p>
        <p class="w3-center">
            <!-- Password type blocks out the characters being entered -->
            <!-- id pwd is used by js to toggle visibility -->
            <input  class="w3-border w3-round" 
                    type="password" 
                    value="<?php echo $password?>"
                    name="password" 
                    id="password"
                    placeholder="Password"
                    required>
                    <span id="passwordValidationIcon" class="w3-text-red"> *</span>
        </p>
        <p class="w3-center">
            <input type="checkbox" id="showPassword" class="w3-check"> Show password
        </p>
        <p class="w3-center">
            <button class="w3-btn w3-blue w3-round-large"  name="submit">Submit</button>
        </p>
        <p class="w3-center w3-small">
        <a href="login.php">Already have an account?</a>
        </p>
    </div>
</div>
</form>
<?php require 'includes/inc.footer.php'; ?>