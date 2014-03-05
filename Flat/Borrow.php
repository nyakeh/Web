<?php
session_start();
include('Utils.php');
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
    <div id="logo"><a href="Home.php"><img src="img/logo.png"></a></div>
    <nav>
        <ul>
            <li><a href="Mortgage.php">Mortgage</a></li>
            <li><a href="#">Borrow</a></li>
            <li><a href="Budget.php">Budget</a></li>
            <li><a href="Account.php">Account</a></li>
        </ul>
    </nav>
</header>
<div class="cover"><a id="link" class="link"></a></div>
<div id="content">
    <section>
        <p>How much would a bank <span class="bold">lend</span> towards buying a property.</p>
        <form id="borrow_calculator" method="post" action="">
            <p><label>Deposit available</label><input type="text" class="input" name="input_property" id="input_property" value="20000" maxlength="10" tabindex="1">
            <p><input type="button" id="mortgage_submit_Button" value="Calculate" tabindex="6"></p>
            <p><span id="borrow_message" class="detailed_error"></span></p>
        </form>
    </section>
    <section class="results" id="borrow_results"></section>
</div>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>