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
                    <li><a href="#">Compare</a></li>
                    <li><a href="borrow">Borrow</a></li>
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
        <div class="heading"><h1>Compare Mortgages</h1></div>
        <div class="section">
            <p>Here you can <span class="bold">Compare</span> various mortgage products.</p>
            <form id="compare_calculator" method="post" action="">
                <p><label>Property Value</label><input type="text" class="input" name="input_property" id="input_property" value="270000" maxlength="10" onBlur="javascript:isEmptyNumberBox(this,'input_propertyMsg');" tabindex="1">
                    <span id="input_propertyMsg"></span></p>
                <p><label>Deposit Amount</label><input type="text" class="input" name="input_deposit" id="input_deposit" value="39000" maxlength="10" onBlur="javascript:isEmptyNumberBox(this,'input_depositMsg');" tabindex="2">
                    <span id="input_depositMsg"></span></p>
                <p><label>Term</label><input type="text" class="input" name="input_term" id="input_term" value="25" maxlength="3" onBlur="javascript:isEmptyNumberBox(this,'input_termMsg');" tabindex="3">
                    <span id="input_termMsg"></span></p>
                <input type="button" id="compare_submit_Button" value="Calculate" tabindex="4">
                <p><span id="compare_message" class="detailed_error"></span></p>
            </form>
            <section class="results" id="compare_results"></section>
        </div>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="index">Gauge</a></li>
                <li><a href="mortgage" class="greyText">Mortgage</a></li>
                <li><a href="#" class="greyText">Compare</a></li>
                <li><a href="borrow" class="greyText">Borrow</a></li>
            </ul>
        </nav>
        <a href="http://www.nyakeh.co.uk"><img src="img/Emblem.png"></a>
    </footer>
</div>
</body>
</html>