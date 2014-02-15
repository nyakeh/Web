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
<header>
    <div id="logo"><a href="Home.php"><img src="img/Logo_Design1.png"></a></div>
    <nav>
        <ul>
            <li><a href="Mortgage.php">Mortgage</a></li>
            <li><a href="Budget.html#link">Budget</a></li>
            <li><a href="#">Account</a></li>
        </ul>
    </nav>
</header>
<div class="cover"><a id="link" class="link"></a></div>
<div id="content">
    <section>
        <p>Hey good looking, here's where you can <span class="bold">Update</span> you're details.</p>
        <form id="account" method="post" action="">
            <p><label>Forename</label><input type="text" class="input" name="account_forename" id="account_forename" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your First Name','account_forenameMsg');"
                    <?php echo addValueTag(@$forename); ?>><span class="error" id="account_forenameMsg"></span></p>
            <p><label>Surname</label><input type="text" class="input" name="account_surname" id="account_surname" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Last Name','account_surnameMsg');"
                    <?php echo addValueTag(@$surname); ?>><span class="error" id="account_surnameMsg"></span></p>
            <p><label>Email</label><input type="text" class="input" name="account_email" id="account_email" maxlength="100" onBlur="javascript:validate_textbox(this,'Please enter your Email Address','account_emailMsg');"
                    <?php echo addValueTag(@$email); ?>><span class="error" id="account_emailMsg"></span></p>
            <p><label>Password</label><input type="text" class="input" name="account_password" id="account_password" maxlength="50" onBlur="javascript:validate_textbox(this,'Please enter your Last Name','account_passwordMsg');">
                <span class="error" id="account_passwordMsg"></span></p>
            <input type="button" id="account_submit_Button" value="Update">
            <p><span id="account_message" class="detailed_error"></span></p>
        </form>
    </section>
</div>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>