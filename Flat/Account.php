<?php
session_start();
include('Utils.php');
if(!isset($_SESSION['userId'])) {
    header('Location: Home.php');
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
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="Home.php"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="Mortgage.php">Mortgage</a></li>
                    <li><a href="Borrow.php">Borrow</a></li>
                    <li><a href="Budget.php">Budget</a></li>
                    <li><a href="#">Account</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($_SESSION['userId'])) { ?>
        <div class="customer">
            <div class="container">
                <div id="customerAccount"><a href="#"><?php echo $_SESSION['username'] ?></a> <a href="Home.php?logOut=true">log off</a></div>
            </div>
        </div>
    <?php } ?>
    <div id="content">
        <div class="heading"><h1>Update Your Account Details</h1></div>
        <div class="section">
            <p>Hey good looking, here's where you can <span class="bold">Update</span> you're details.</p>
            <form id="account" method="post" action="">
                <p><label>Forename</label><input type="text" class="input" name="account_forename" id="account_forename" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your First Name','account_forenameMsg');" tabindex="1"
                        <?php echo addValueTag(@$forename); ?>><span class="error" id="account_forenameMsg"></span></p>
                <p><label>Surname</label><input type="text" class="input" name="account_surname" id="account_surname" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Last Name','account_surnameMsg');" tabindex="2"
                        <?php echo addValueTag(@$surname); ?>><span class="error" id="account_surnameMsg"></span></p>
                <p><label>Email</label><input type="text" class="input" name="account_email" id="account_email" maxlength="100" onBlur="javascript:validate_textbox(this,'Please enter your Email Address','account_emailMsg');" tabindex="3"
                        <?php echo addValueTag(@$email); ?>><span class="error" id="account_emailMsg"></span></p>
                <p><label>Password</label><input type="password" class="input" name="account_password" id="account_password" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Password','account_passwordMsg');" tabindex="4">
                    <span class="error" id="account_passwordMsg"></span></p>
                <input type="button" id="account_submit_Button" value="Update" tabindex="5">
                <p><span id="account_message" class="detailed_error"></span></p>
            </form>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="Home.php">Gauge</a></li>
                <li><a href="Mortgage.php" class="greyText">Mortgage</a></li>
                <li><a href="Borrow.php" class="greyText">Borrow</a></li>
                <li><a href="Budget.php" class="greyText">Budget</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>