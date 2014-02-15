<?php
session_start();
include('Utils.php');

if($_POST) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $expected = array('email', 'password');
    $validationMessage = validateFields($expected, 'login');

    if($validationMessage) {
        $validationMessage['form'] = detailErrorMessage('Please amend your details');
    } else {
        $validationMessage['form'] = LogIn($username, $password);
    }
}

if($_GET){
    if(isset($_GET['logOut']) & $_GET['logOut'] == 'true'){
        LogOut();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gauge</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
</head>

<body>
<header>
    <div id="logo"><a href="#"><img src="img/Logo_Design1.png"></a></div>
    <nav>
        <ul>
            <li><a href="Mortgage.php">Mortgage</a></li>
            <li><a href="Budget.html#link">Budget</a></li>
            <li><a href="Account.php">Account</a></li>
        </ul>
    </nav>
</header>
<div class="cover"><a id="link" class="link"></a></div>
<div id="content">
    <section>
        <!--
            add proof of session
            $_SESSION['username'] = $result->Forename;
            $_SESSION['userId'] = $result->AccountId;
        -->
        <p>Welcome to <span class="bold">Gauge</span>, the online mortgage calculator</p>
        <p>Whats hatning <?php echo $_SESSION['username'] ?> you're are <?php echo $_SESSION['userId'] ?>nd favourite customer.</p>
    </section>
    <section>
        <p>Hello stranger, why don't you <span class="bold">Login</span> below.</p>
        <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p><label>Email</label><input type="text" class="input" name="email" id="login_email"><?php echo nullCheckOutput(@$validationMessage['email']); ?></p>
            <p><label>Password</label><input type="text" class="input" name="password" id="login_password"><?php echo nullCheckOutput(@$validationMessage['password']); ?></p>
            <p><input type="submit" value="Login"></p>
            <p><?php echo nullCheckOutput(@$validationMessage['form']); ?></p>
        </form>
    </section>
</div>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>