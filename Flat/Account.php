<?php
	session_start();
	include('Utils.php');
	if(!isset($_SESSION['userId'])) {
		header('Location: index.php');
	}
	RetrieveDetails($forename, $surname, $email, $password);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gauge</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><img src="img/logo.png" id="logo"><h1>GAUGE</h1></a>
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
                <div id="customerAccount"><a href="#"><?php echo $_SESSION['username'] ?></a> <a href="favourite.php">Favourites</a> <a href="index.php?logOut=true">Log off</a></div>
            </div>
        </div>
    <?php } ?>
	<div class="heading"><h1>ACCOUNT</h1><hr></div>
    <div class="content">
        <div class="section overlap whiteBox">
            <h4 class="intro">UPDATE YOUR ACCOUNT DETAILS</h4>
            <form id="account" method="post" action="">
                <p><label>Forename(s)</label><input type="text" class="input" name="account_forename" id="account_forename" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your First Name','account_forenameMsg');" tabindex="1"
                        <?php echo addValueTag(@$forename); ?>><span class="error" id="account_forenameMsg"></span></p>
                <p><label>Surname</label><input type="text" class="input" name="account_surname" id="account_surname" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Last Name','account_surnameMsg');" tabindex="2"
                        <?php echo addValueTag(@$surname); ?>><span class="error" id="account_surnameMsg"></span></p>
                <p><label>Email</label><input type="text" class="input" name="account_email" id="account_email" maxlength="100" onBlur="javascript:validate_textbox(this,'Please enter your Email Address','account_emailMsg');" tabindex="3"
                        <?php echo addValueTag(@$email); ?>><span class="error" id="account_emailMsg"></span></p>
                <p><label>Password</label><input type="password" class="input" name="account_password" id="account_password" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Password','account_passwordMsg');" tabindex="4">
                    <span class="error" id="account_passwordMsg"></span></p>
                <input type="button" id="account_submit_Button" value="SAVE CHANGES" tabindex="5">
                <p><span id="account_message" class="detailed_error"></span></p>
            </form>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="index" class="shadowText">GAUGE</a></li>
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