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
    <link rel="icon" type="image/icon" href="img/favicon.ico">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><img src="img/logo.png" id="logo"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">MORTGAGE</a></li>
                    <li><a href="#">COMPARE</a></li>
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
	<div class="heading"><h1>COMPARE MORTGAGES</h1><hr></div>
    <div class="content">
        <div class="section overlap whiteBox">
            <h4 class="intro">LET US COMPARE THE VARIOUS MORTGAGE PRODUCTS AVALIABLE</h4>
            <form id="compare_calculator" method="post" action="">
                <p><label>Property Value</label><input type="text" class="input" name="input_property" id="input_property" placeholder="270000" maxlength="7" onBlur="javascript:isEmptyNumberBox(this,'input_propertyMsg');" tabindex="1">
                    <span id="input_propertyMsg"></span></p>
                <p><label>Deposit Amount</label><input type="text" class="input" name="input_deposit" id="input_deposit" placeholder="39000" maxlength="7" onBlur="javascript:isEmptyNumberBox(this,'input_depositMsg');" tabindex="2">
                    <span id="input_depositMsg"></span></p>
                <p><label>Term</label><input type="text" class="input" name="input_term" id="input_term" placeholder="25" maxlength="3" onBlur="javascript:isEmptyNumberBox(this,'input_termMsg');" tabindex="3">
                    <span id="input_termMsg"></span></p>
                <input type="button" id="compare_submit_Button" value="CALCULATE" tabindex="4">
                <p><span id="compare_message" class="detailed_error"></span></p>
            </form>
            <section class="results" id="compare_results"></section>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="index" class="shadowText">GAUGE</a></li>
                <li><a href="mortgage">MORTGAGE</a></li>
                <li><a href="#">COMPARE</a></li>
                <li><a href="borrow">BORROW</a></li>
				<li><a href="calculation">LOOK UP</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>