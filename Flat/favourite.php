<?php 
    session_start(); 
    include( 'Utils.php');
	if(!isset($_SESSION['userId'])) {
		header('Location: index.php');
	}
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
	<?php if(isset($_SESSION['userId'])) { ?>
	<script type='text/javascript'> window.onload=loadFavourites(<?php echo $_SESSION['userId'] ?>); </script>
	<?php } ?>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="all">
    <header>
        <div class="container">
            <a href="index"><img src="img/logo.png" id="logo"><h1>GAUGE</h1></a>
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
    <div class="heading"><h1>FAVOURITES</h1><hr></div>
    <div class="content">
		<div class="section overlap whiteBox" id="favouriteCalculations">
			<h4 class="intro">HERE ARE YOUR CALCULATION FAVOURITES</h4>
			<div id="favouritesTable" class="topMargin"><p class="center_message">We're just <span class="bold">retreiving</span> your favourite calculations.</p><p class="center_message"><img src="img/loader.gif"></p></div>
			<div id="email_favourite_div"><button id="email_favourite">EMAIL</button></div>
			<p><span id="email_favourite_message" class="detailed_error"></span></p>
		</div>
	</div>
	<footer>
		<nav>
			<ul>
				<li><a href="index" class="shadowText">GAUGE</a></li>
				<li><a href="mortgage">MORTGAGE</a></li>
				<li><a href="compare">COMPARE</a></li>
				<li><a href="borrow">BORROW</a></li>
				<li><a href="calculation">LOOK UP</a></li>
			</ul>
		</nav>
		<a href="http://www.nyakeh.co.uk">
			<img src="img/Emblem.png">
		</a>
	</footer>
</div>
</body>

</html>