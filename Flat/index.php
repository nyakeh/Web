<?php
session_start();
include('Utils.php');
if($_POST) {
    if($_POST['method'] === 'register') {
        $register_forename = $_POST['register_forename'];
        $register_surname = $_POST['register_surname'];
        $register_email = $_POST['register_email'];
        $register_password = $_POST['register_password'];
        $register_confirm_password = $_POST['register_confirm_password'];

        $expected = array('register_forename', 'register_surname','register_email', 'register_password','register_confirm_password');
        $validationMessage = validateFields($expected, 'register');

        if($validationMessage) {
            $validationMessage['register_form'] = detailErrorMessage('Please amend your details');
        } else {
            $validationMessage['register_form'] = Register($register_forename, $register_surname, $register_email, $register_password, $register_confirm_password);
        }
    } else {		
        $email = $_POST['email'];
        $password = $_POST['password'];

        $expected = array('email', 'password');
        $validationMessage = validateFields($expected, 'login');
		
        if($validationMessage) {
            $validationMessage['form'] = detailErrorMessage('Please amend your details');
        } else {
            $validationMessage['form'] = LogIn($email, $password);			
        }		
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
    <link rel="icon" type="image/icon" href="img/favicon.ico">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
    <link rel="icon" type="image/icon" href="img/favicon.ico">
	<?php if(isset($_SESSION['userId'])) { ?>
	<script type='text/javascript'> window.onload=loadCalculationHistory(<?php echo $_SESSION['userId'] ?>); </script>
	<?php } ?>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="#"><img src="img/logo.png" id="logo"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">MORTGAGE</a></li>
                    <li><a href="compare">COMPARE</a></li>
                    <li><a href="borrow">BORROW</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($_SESSION['userId'])) { ?>
    <div class="customer">
        <div class="container">
            <div id="customerAccount"><a href="account.php"><?php echo $_SESSION['username'] ?></a> <a href="favourite.php">Favourites</a> <a href="index.php?logOut=true">Log off</a></div>
        </div>
    </div>
    <?php } ?>
	<div class="heading">
		<h2>WELCOME TO <span class="greyText">GAUGE</span></h2>
		<h1>THE ONLINE MORTGAGE CALCULATOR</h1>
		<hr>
	</div>
	<div class="content">
		<?php if(isset($_SESSION['userId'])) { ?>
		<div class="section overlap whiteBox">
			<div id="calculationHistory">
				<h4 class="intro">HERE'S YOUR MOST RECENT CALCULATIONS</h4>
				<div id="calculationHistoryResults" class="topMargin"><p class="center_message"><img src="img/loader.gif"></p></div>
			</div>		
		</div>
		<?php } ?>	
		<?php if(!isset($_SESSION['userId'])) { ?>
		<div class="section overlap">
			<div class="half">
				<h4 class="intro">LOGIN TO YOUR ACCOUNT</h4>
				<form id="login" class="account_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<p><label>Email</label><input type="text" class="input" name="email" id="login_email" tabindex="1" <?php echo addValueTag(@$email); ?>><?php echo nullCheckOutput(@$validationMessage['email']); ?></p>
					<p><label>Password</label><input type="password" class="input" name="password" id="login_password" tabindex="2"><?php echo nullCheckOutput(@$validationMessage['password']); ?></p>
					<input type="hidden" name="method" value="login">
					<p><input type="submit" value="LOGIN NOW" tabindex="3"></p>
					<p><?php echo nullCheckOutput(@$validationMessage['form']); ?></p>
				</form>
			</div>
			<div class="half halfRight">
				<h4 class="intro">ACCOUNT REGISTRATION</h4>
				<form id="register" class="account_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<p><label>Email</label><input type="text" class="input" name="register_email" id="register_email" tabindex="4" <?php echo addValueTag(@$register_email); ?>><?php echo nullCheckOutput(@$validationMessage['register_email']); ?></p>
					<p><label>Forename(s)</label><input type="text" class="input" name="register_forename" id="register_forename" tabindex="5" <?php echo addValueTag(@$register_forename); ?>><?php echo nullCheckOutput(@$validationMessage['register_forename']); ?></p>
					<p><label>Surname</label><input type="text" class="input" name="register_surname" id="register_surname" tabindex="6" <?php echo addValueTag(@$register_surname); ?>><?php echo nullCheckOutput(@$validationMessage['register_surname']); ?></p>
					<p><label>Password</label><input type="password" class="input" name="register_password" id="register_password" tabindex="7"><?php echo nullCheckOutput(@$validationMessage['register_password']); ?></p>
					<p><label id="longLabel">Confirm Password</label><input type="password" class="input" name="register_confirm_password" id="register_confirm_password" tabindex="8"><?php echo nullCheckOutput(@$validationMessage['register_confirm_password']); ?></p>
					<input type="hidden" name="method" value="register" >
					<p><input type="submit" value="REGISTER NOW" tabindex="9"></p>
					<p><?php echo nullCheckOutput(@$validationMessage['register_form']); ?></p>
				</form>
			</div>
		</div>
		<?php } ?>
	</div>
    <footer>
        <nav>
            <ul>
                <li><a href="#" class="shadowText">GAUGE</a></li>
                <li><a href="mortgage">MORTGAGE</a></li>
                <li><a href="compare">COMPARE</a></li>
                <li><a href="borrow">BORROW</a></li>
				<li><a href="calculation">LOOK UP</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>