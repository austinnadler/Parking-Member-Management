<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    session_start();

    $curYear = Date('Y');
    $phpScript = sanitize($_SERVER['PHP_SELF']);
    $username = $password = '';
    $usernameError = $passwordError = $invalidLoginError = '';

    function sanitize($input) {
        return htmlspecialchars( stripslashes( trim($input) ) );
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);

        $invaidLoginError = (empty($username) || empty($password))? 'Invalid username / password combination try again' : '';
        $usernameError = (empty($username)? 'Enter your username' : '');
        $passwordError = (empty($password)? 'Enter your password' : '');

        if(!$invaidLoginError) {
            try {
                require 'includes/inc.db.php';
                $pdo = new PDO(DSN, USER, PWD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $pdoStatement = $pdo->query("
                    SELECT username, password FROM users WHERE username = '$username'"
                );
        
                if($pdoStatement->rowCount() > 0) { // if a row is fetched then the username exists
                    $userRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC); 
                    $dbUsername = $userRecord['username'];
                    $dbPassword = $userRecord['password'];
                    
                    if(password_verify($password, $dbPassword)) {
                        $_SESSION['username'] = $username;
                        header('Location: index.php?message=Welcome');
                        die;
                    } else {
                        $invalidLoginError = 'That username / password combination was not found';
                    }
                } else {
                    $invalidLoginError = 'That username / password combination was not found';
                }
            } catch(PDOException $e) {
                die($e->getMessage());
            }  
        }
    }
    require 'includes/inc.header.php';
?>

<!--File: login.php
    Author: Austin Nadler-->
    
<h1>Parking Services</h1>
<title>Login</title>
</header>
<h2 class="w3-center">Log in</h2>
<p id="errorField" class="w3-center w3-large w3-text-red"> 
    <?php
        if(!empty($invalidLoginError))  {echo $invalidLoginError . '<br>';}  
        if(!empty($usernameError))      {echo $usernameError . '<br>';} 
        if(!empty($passwordError))      {echo $passwordError;}           
    ?>
</p>
<script src="js/login-register.js"></script>
<form id="loginRegister" action="<?php echo $phpScript ?>" method="POST">
<div class="w3-content" style="max-width: 500px">
    <div class="w3-card-4 w3-containter w3-margin w3-round w3-padding">
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
            <input  class="w3-border w3-round password" 
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
            <a href="register.php">Click here to create an account</a>
        </p>
    </div>
</div>
</form>
<?php require 'includes/inc.footer.php'; ?>