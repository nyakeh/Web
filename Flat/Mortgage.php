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
    <div id="logo"><a href="Home.php"><img src="img/Logo_Design1.png"></a></div>
    <nav>
        <ul>
            <li><a href="#">Mortgage</a></li>
            <li><a href="Budget.php">Budget</a></li>
            <li><a href="Account.php">Account</a></li>
        </ul>
    </nav>
</header>
<div class="cover"><a id="link" class="link"></a></div>
<div id="content">
    <section>
        <p>Let us help you to <span class="bold">Calculate</span> your mortgage.</p>
        <form id="mortgage_calculator" method="post" action="">
            <p><label>Property Value</label><input type="text" class="input" name="input_property" id="input_property" value="200000" maxlength="10" onBlur="javascript:isEmptyNumberBox(this,'input_propertyMsg');" tabindex="1">
                <span id="input_propertyMsg"></span></p>
            <p><label>Deposit Amount</label><input type="text" class="input" name="input_deposit" id="input_deposit" placeholder="10000" maxlength="10" onBlur="javascript:isEmptyNumberBox(this,'input_depositMsg');" tabindex="2">
                <span id="input_depositMsg"></span></p>
            <p><label>Term</label><input type="text" class="input" name="input_term" id="input_term" placeholder="25" maxlength="3" onBlur="javascript:isEmptyNumberBox(this,'input_termMsg');" tabindex="3">
                <span id="input_termMsg"></span></p>
            <p><label>Interest Rate</label><input type="text" class="input" name="input_interest" id="input_interest" placeholder="5" maxlength="5" onBlur="javascript:isEmptyNumberBox(this,'input_interestMsg');" tabindex="4">
                <span id="input_interestMsg"></span></p>
            <p><label>Fees</label><input type="text" class="input" name="input_fees" id="input_fees" placeholder="" maxlength="7" onBlur="javascript:isEmptyNumberBox(this,'input_feesMsg');" tabindex="5">
                <span id="input_feesMsg"></span></p>
            <input type="button" id="mortgage_submit_Button" value="Calculate" tabindex="6">
            <p><span id="mortgage_message" class="detailed_error"></span></p>
        </form>
    </section>
    <section class="results" id="mortgage_results">

    </section>
</div>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>