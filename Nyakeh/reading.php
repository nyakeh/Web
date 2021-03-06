<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);
	include('utils.php'); 

	getReadingList($books);	
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Nyakeh Rogers</title>
	<meta name="theme-color" content="#3f51b5">
	<meta name="description" content="My active reading list">
	<meta name="author" content="Nyakeh Rogers">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="img/favicon.ico" />

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/style_skeleton.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

	<nav class="navbar container">
		<ul class="navbar-list">
			<li class="navbar-item">
				<a class="navbar-link" href="index">Nyakeh Rogers</a>
			</li>
			<li class="navbar-item">
				<a class="navbar-link" href="gauge">Gauge</a>
			</li>
			<li class="navbar-item">
				<a class="navbar-link">Blog</a>
			</li>
			<li class="navbar-item">
				<a class="navbar-link" href="reading">Reading</a>
			</li>
			<li class="navbar-item">
				<a class="navbar-link" href="progress">Progress</a>
			</li>
		</ul>
	</nav>
	<div class="section container hero">
		<div class="row">
			<div class="one-half column">
				<i class="fa fa-book fa-3x bookIcon"></i>
			</div>
			<div class="one-half column">
				<h1 class="hero-heading">Reading List</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<h3>Currently Reading</h3>
			<?php foreach($books as $book) { ?>
				<div class="book">
					<div class="one-half column">
						<img class="u-max-full-width" src="<?php echo($book->ImageSource) ?>">
					</div>
					<div class="one-half column bookDetails">
						<h4 class="bookTitle"><?php echo($book->Title) ?></h4>
						<h5 class="bookTitle"><?php echo($book->Auther) ?></h5>
						<p><?php echo($book->Description) ?></p>
					</div>
					<div class="progress"></div>
				</div>					
			<?php } ?>			
		</div>

		<div class="footer">
			<ul>
				<li>
					<a href="https://github.com/nyakeh">
						<img src="img/github.png">
					</a>
				</li>
				<li>
					<a href="http://instagram.com/nyakehrogers">
						<img class="icon-padding" src="img/instagram.png">
					</a>
				</li>
				<li>
					<a href="http://lnkd.in/bGufZiJ">
						<img class="icon-padding" src="img/linkedin.png">
					</a>
				</li>
				<li>
					<a href="https://twitter.com/nyakehrogers">
						<img class="icon-padding" src="img/twitter.png">
					</a>
				</li>
			</ul>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="/js/script.js"></script>
</body>

</html>