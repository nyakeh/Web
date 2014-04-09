<?php 
    session_start(); 
    include( 'Utils.php');
	$substance = "<p>We're just <span class=\"bold\">retreiving</span> your calculation.</p><p><img src=\"img/loader.gif\"></p>";
	if(ISSET($_GET['id'])) {
		//$calculationHtml = retreiveCalculation($_GET['id']);
		//if(is_null($calculationHtml)) {
		//	$substance = '<p>Null tings</p>';
		//} else {
		//	$substance = $calculationHtml;
		//}
	} else {
		$substance = 'No no, no we got no id';
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gauge</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
	<script type='text/javascript'> window.onload=loadCalc(<?php echo $_GET['id'] ?>); </script>
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
    <div class="heading">
        <h1>Mortagage Calculation Viewer</h1>
    </div>
    <div class="section" id="calculationTable">
        <?php echo $substance ?>
    </div>
</div>
<footer>
    <nav>
        <ul>
            <li>
                <a href="index">Gauge</a>
            </li>
            <li>
                <a href="mortgage" class="greyText">Mortgage</a>
            </li>
            <li>
                <a href="compare" class="greyText">Compare</a>
            </li>
            <li>
                <a href="borrow" class="greyText">Borrow</a>
            </li>
        </ul>
    </nav>
    <a href="http://www.nyakeh.co.uk">
        <img src="img/Emblem.png">
    </a>
</footer>
</div>
</body>

</html>