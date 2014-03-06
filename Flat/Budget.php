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
                    <li><a href="Borrow.php">Borrow</a></li>
                    <li><a href="#">Budget</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($_SESSION['userId'])) { ?>
        <div class="customer">
            <div class="container">
                <div id="customerAccount"><a href="Account.php"><?php echo $_SESSION['username'] ?></a> <a href="Home.php?logOut=true">log off</a></div>
            </div>
        </div>
    <?php } ?>

    <div id="content">
        <div class="heading"><h1>Budget Calculator</h1></div>
        <div class="section">
            <p>Let us help you to <span class="bold">Calculate</span> your budget.</p>
            <!--<form id="budget_calculator" method="post" action="">
                <p><label>Property Value</label><input type="text" class="input" name="property" id="form_property" value="200000"></p>
                <p><label>Deposit Amount</label><input type="text" class="input" name="deposit" id="form_deposit" placeholder="10000"></p>
                <p><label>Term</label><input type="text" class="input" name="term" id="form_term" placeholder="25"></p>
                <p><label>Interest Rate</label><input type="text" class="input" name="subject" id="form_subject" placeholder="5"></p>
                <p><label>Fees</label><input type="text" class="input" name="fees" id="form_fees" placeholder=""></p>
                <input type="submit" id="budget_submit_Button" value="Calculate">
            </form>-->
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="Home.php">Gauge</a></li>
                <li><a href="Mortgage.php" class="greyText">Mortgage</a></li>
                <li><a href="Borrow.php" class="greyText">Borrow</a></li>
                <li><a href="#" class="greyText">Budget</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>