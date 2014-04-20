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
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><h1>GAUGE</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">MORTGAGE</a></li>
                    <li><a href="compare">COMPARE</a></li>
                    <li><a href="#">BORROW</a></li>
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
	<div class="heading"><h1>HOW MUCH CAN I BORROW?</h1><hr></div>
    <div class="content">
        <div class="section overlap whiteBox">
            <h4 class="intro">LET US CALCULATE HOW MUCH A BANK COULD LEND YOU TOWARDS BUYING A PROPERTY</h4>
            <form id="borrow_calculator" method="post" action="">
                <p><label>Input deposit available</label><input type="text" class="input" name="input_borrow_deposit" id="input_borrow_deposit" placeholder="20000" maxlength="10" tabindex="1">
                <p><input type="button" id="borrow_submit_button" value="CALCULATE" tabindex="2"></p>
                <p><span id="borrow_message" class="detailed_error"></span></p>
            </form>
            <section class="results" id="borrow_results"></section>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="index" class="shadowText">GAUGE</a></li>
                <li><a href="mortgage">MORTGAGE</a></li>
                <li><a href="compare">COMPARE</a></li>
                <li><a href="#">BORROW</a></li>
				<li><a href="calculation">LOOK UP</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>