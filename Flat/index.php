<?php
session_start();
include('Utils.php');

if($_POST) {

    if($_POST['method'] === 'register') {
        $register_forename = $_POST['register_forename'];
        $register_surname = $_POST['register_surname'];
        $register_email = $_POST['register_email'];
        $register_password = $_POST['register_password'];

        $expected = array('register_forename', 'register_surname','register_email', 'register_password');
        $validationMessage = validateFields($expected, 'register');

        if($validationMessage) {
            $validationMessage['register_form'] = detailErrorMessage('Please amend your details');
        } else {
            $validationMessage['register_form'] = Register($register_forename, $register_surname, $register_email, $register_password);
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
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
	<?php if(isset($_SESSION['userId'])) { ?>
	<script type='text/javascript'> window.onload=loadCalculationHistory(<?php echo $_SESSION['userId'] ?>); </script>
	<?php } ?>	
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">Mortgage</a></li>
                    <li><a href="compare">Compare</a></li>
                    <li><a href="borrow">Borrow</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($_SESSION['userId'])) { ?>
    <div class="customer">
        <div class="container">
            <div id="customerAccount"><a href="account.php"><?php echo $_SESSION['username'] ?></a> <a href="index.php?logOut=true">log off</a></div>
        </div>
    </div>
    <?php } ?>
    <div id="content">
        <div class="heading"><h1>The Online Mortgage Calculator</h1></div>
        <div class="section">
            <p>Welcome to <span class="bold">Gauge</span>, the online mortgage calculator</p>
            <?php if(isset($_SESSION['userId'])) { ?>
                <p>Now close your eye and imagine your calcualtion histoory appearing here.</p>
            <?php } ?>
        </div>
        <?php if(!isset($_SESSION['userId'])) { ?>
        <div class="section">
            <div class="ftfy">
                <p class="intro">Hello stranger, why don't you <span class="bold">Login</span> below.</p>
                <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p><label>Email</label><input type="text" class="input" name="email" id="login_email" tabindex="1" <?php echo addValueTag(@$email); ?>><?php echo nullCheckOutput(@$validationMessage['email']); ?></p>
                    <p><label>Password</label><input type="password" class="input" name="password" id="login_password" tabindex="2"><?php echo nullCheckOutput(@$validationMessage['password']); ?></p>
                    <input type="hidden" name="method" value="login">
                    <p><input type="submit" value="Login" tabindex="3"></p>
                    <p><?php echo nullCheckOutput(@$validationMessage['form']); ?></p>
                </form>
            </div>
            <div class="ftfy ftfyRight">
                <p class="intro">New to the site, you can <span class="bold">Register</span> here.</p>
                <form id="register" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p><label>Email</label><input type="text" class="input" name="register_email" id="register_email" tabindex="4" <?php echo addValueTag(@$register_email); ?>><?php echo nullCheckOutput(@$validationMessage['register_email']); ?></p>
                    <p><label>Forename</label><input type="text" class="input" name="register_forename" id="register_forename" tabindex="5" <?php echo addValueTag(@$register_forename); ?>><?php echo nullCheckOutput(@$validationMessage['register_forename']); ?></p>
                    <p><label>Surname</label><input type="text" class="input" name="register_surname" id="register_surname" tabindex="6" <?php echo addValueTag(@$register_surname); ?>><?php echo nullCheckOutput(@$validationMessage['register_surname']); ?></p>
                    <p><label>Password</label><input type="password" class="input" name="register_password" id="register_password" tabindex="7"><?php echo nullCheckOutput(@$validationMessage['register_password']); ?></p>
                    <input type="hidden" name="method" value="register">
                    <p><input type="submit" value="Register" tabindex="8"></p>
                    <p><?php echo nullCheckOutput(@$validationMessage['register_form']); ?></p>
                </form>
            </div>
        </div>
        <?php } ?>
		<?php if(isset($_SESSION['userId'])) { ?>
        <div class="section" id="calculationHistory">
			<p>Here's your most recent calculations:</p>
			<div id="calculationHistoryResults"></div>
		</div>		
        <?php } ?>			
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="#">Gauge</a></li>
                <li><a href="mortgage" class="greyText">Mortgage</a></li>
                <li><a href="compare" class="greyText">Compare</a></li>
                <li><a href="borrow" class="greyText">Borrow</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>