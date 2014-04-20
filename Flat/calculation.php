<?php 
    session_start(); 
    include( 'Utils.php');
	$calculationId = "";
	$substance = "";
	
	if(ISSET($_GET['id'])) {
		$substance = "<p class=\"center_message\">We're just <span class=\"bold\">retreiving</span> your calculation.</p><p class=\"center_message\"><img src=\"img/loader.gif\"></p>";
		$calculationId = $_GET['id'];
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
	<script type='text/javascript'> window.onload=loadCalculation(<?php echo $_GET['id'] ?>); </script>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><h1>Gauge</h1></a>
            <nav>
                <ul>
                    <li><a href="mortgage">MORTGAGE</a></li>
                    <li><a href="compare">COMPARE</a></li>
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
    <div class="heading"><h1>PREVIOUS MORTGAGE CALCULATION LOOK UP</h1><hr></div>
    <div class="content">
		<div class="section overlap whiteBox" id="calculationFinder">
			<h4 class="intro">LOOK UP AN OLD CALCULATION</h4>
			<form id="mortgage_retriever" method="post" action=""><p><label>Input Calculation Id</label><input type="text" class="input" name="input_calcId" id="input_calcId" value="<?php echo $calculationId ?>" maxlength="10" tabindex="1"></p><input type="button" id="calculation_lookup_submit_Button" value="FIND" tabindex="2"></form>
			<section id="calculationTable"><?php echo $substance ?></section>
		</div>
		
</div>
<footer>
    <nav>
        <ul>
            <li><a href="index" class="shadowText">GAUGE</a></li>
            <li><a href="mortgage">MORTGAGE</a></li>
            <li><a href="compare">COMPARE</a></li>
            <li><a href="borrow">BORROW</a></li>
			<li><a href="#">LOOK UP</a></li>
        </ul>
    </nav>
    <a href="http://www.nyakeh.co.uk">
        <img src="img/Emblem.png">
    </a>
</footer>
</div>
</body>

</html>