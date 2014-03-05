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
<div id="all">
<header>
    <div class="container">
        <a href="Home.php"><h1>Gauge</h1></a>
        <nav>
            <ul>
                <li><a href="Mortgage.php">Mortgage</a></li>
                <li><a href="#">Borrow</a></li>
                <li><a href="Budget.php">Budget</a></li>
                <li><a href="Account.php">Account</a></li>
            </ul>
        </nav>
    </div>
</header>

<div id="content">
    <div class="heading"><h1>How Much Can I Borrow?</h1></div>
    <section>
        <p>How much would a bank <span class="bold">lend</span> towards buying a property.</p>
        <form id="borrow_calculator" method="post" action="">
            <p><label>Deposit available</label><input type="text" class="input" name="input_borrow_deposit" id="input_borrow_deposit" value="20000" maxlength="10" tabindex="1">
            <p><input type="button" id="borrow_submit_button" value="Calculate" tabindex="2"></p>
            <p><span id="borrow_message" class="detailed_error"></span></p>
        </form>
    </section>
</div>
<footer><img src="img/Emblem.png"></footer>
</div>
</body>
</html>