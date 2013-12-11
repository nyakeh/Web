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
        <title>Car Catalogue</title>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <link rel="stylesheet" type="text/css" href="Styles.css">
        <script src="script.js"></script>
    </head>

    <body>
    <header>
        <h1>Car Catalogue</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</li></a>
                <?php if(isset($_SESSION['username'])) { ?>
                <li><a href="search.php">Search</a></li>
                <li><a href="account.php">Account</a></li>
                <?php } ?>
                <li><a href="Register.php">Register temp link</li></a>
            </ul>
        </nav>
    </header>
    <?php if(!isset($_SESSION['username'])) { ?>
    <section>
        <p>New customers register <button onclick="RedirectToRegister();">Here</button></p>
        <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p><label>Username<input type="text" name="username" id="username" <?php nullCheckOutput(addValueTag(@$username)); ?>></label>
                <?php nullCheckOutput(@$validationMessage['username']); ?>
            </p>
            <div id="new"></div>
            <p><label>Password: <input type="password" name="password" id="password"></label>
                <?php nullCheckOutput(@$validationMessage['password']); ?>
            </p>
            <p><input type="submit"> <?php nullCheckOutput(@$validationMessage['form']); ?> </p>
        </form>
    </section>
    <?php } else { ?>
        <section>
            <p><?php echo "Hi " . $_SESSION['username'] . " "; ?> <a href="Home.php?logOut=true">log off</a></p>
            <div>
                <p>Favorite Searches:</p>
                <?php RetrieveSearches() ?>
            </div>
        </section>
    <?php } ?>
    <!--<footer>Made by Nyakeh Rogers</footer>-->
</body>
</html>