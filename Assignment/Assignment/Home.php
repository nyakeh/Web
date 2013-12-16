<?php /* http://web.fcet.staffs.ac.uk/r004869a/ */
session_start();
include('database.php');
include('utils.php');

if($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $expected = array('username', 'password');
    $validationMessage = validateFields($expected, 'login');

    if($validationMessage) {
        $validationMessage['form'] = errorMessage('Please amend your details');
    } else {
        $validationMessage['form'] = LogIn($username, $password);
    }
}

if($_GET){
    if(isset($_GET['logOut']) & $_GET['logOut'] == 'true'){
        LogOut();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Car Zar</title>
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="script.js"></script>
</head>

<body>
<header>
    <img src="Logo.png" id="logo">
    <nav>
        <ul>
            <li><a href="home.php">Home</li></a>
            <?php if(isset($_SESSION['username'])) { ?>
                <li><a href="search.php">Search</a></li>
                <li><a href="account.php">Account</a></li>
            <?php } else {?>
                <li><a href="Register.php">Register</li></a>
            <?php }?>

            <?php if(isset($_SESSION['username'])) { ?>
            <div class="welcome">
                <p><?php echo "Hi " . $_SESSION['username'] . ". "; ?> <a href="Home.php?logOut=true">log off</a></p>
            </div>
            <?php } ?>
        </ul>
    </nav>
</header>
<?php if(!isset($_SESSION['username'])) { ?>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p><span class="bold">Welcome,</span> Please Login Below</p>
            <p><label>Username: </label><input type="text" name="username" id="username" <?php echo addValueTag(@$username); ?>>
                <?php echo nullCheckOutput(@$validationMessage['username']); ?>
            </p>
            <div id="new"></div>
            <p><label>Password: </label><input type="password" name="password" id="password">
                <?php echo nullCheckOutput(@$validationMessage['password']); ?>
            </p>
            <p><input type="submit" value="Login Now" class="form button"> <?php echo nullCheckOutput(@$validationMessage['form']); ?> </p>
        </form>
    </section>
<?php } else { ?>
    <section id="SavedSearches">
        <p>Your <span class="bold">Saved</span> Searches:</p>
        <?php echo RetrieveSearches(); ?>
    </section>
<?php } ?>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>