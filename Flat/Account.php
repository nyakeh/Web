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
            <li><a href="Mortgage.html#link">Mortgage</a></li>
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
            <p><label>Forename</label><input type="text" class="input" name="property" id="account_forename" <?php echo addValueTag(@$forename); ?>></p>
            <p><label>Surname</label><input type="text" class="input" name="deposit" id="account_surname" <?php echo addValueTag(@$surname); ?>></p>
            <p><label>Email</label><input type="text" class="input" name="term" id="account_email" <?php echo addValueTag(@$email); ?>></p>
            <p><label>Password</label><input type="text" class="input" name="subject" id="account_password"></p>
            <input type="button" id="account_submit_Button" value="Update">
            <p id="account_message"></p>
        </form>
    </section>
</div>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>