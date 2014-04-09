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
            <a href="index"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">Mortgage</a></li>
                    <li><a href="compare">Compare</a></li>
                    <li><a href="#">Borrow</a></li>
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
        <div class="heading"><h1>How Much Can I Borrow?</h1></div>
        <div class="section">
            <p>How much would a bank <span class="bold">lend</span> towards buying a property.</p>
            <form id="borrow_calculator" method="post" action="">
                <p><label>Deposit available</label><input type="text" class="input" name="input_borrow_deposit" id="input_borrow_deposit" value="20000" maxlength="10" tabindex="1">
                <p><input type="button" id="borrow_submit_button" value="Calculate" tabindex="2"></p>
                <p><span id="borrow_message" class="detailed_error"></span></p>
            </form>
            <section class="results" id="borrow_results"></section>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="index">Gauge</a></li>
                <li><a href="mortgage" class="greyText">Mortgage</a></li>
                <li><a href="compare" class="greyText">Compare</a></li>
                <li><a href="#" class="greyText">Borrow</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>