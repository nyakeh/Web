<?php
    session_start();
    include('database.php');
    include('utils.php');
    if(!isset($_SESSION['username'])) {
        header('Location: Home.php');
    }
    $Updated = false;
    RetrieveDetails($username, $forename, $surname, $dob, $phone, $address, $email);

    if($_POST) {
        $expected = array('username', 'forename', 'surname', 'dob', 'phone', 'address', 'email', 'password');
        $validationMessage = ValidateFields($expected, 'update');

        if($validationMessage) {
            $validationMessage['form'] = errorMessage('Please amend your details');
        } else {
            UpdateUser($_POST['username'], $_POST['forename'], $_POST['surname'], $_POST['dob'], $_POST['phone'], $_POST['address'], $_POST['email'], $_POST['password']);
            header('Location: account.php?updated=true');
        }
    }
    if($_GET) {
        if(isset($_GET['updated']) & $_GET['updated'] == 'true'){
            $Updated = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Car Catalogue</title>
        <link rel="stylesheet" type="text/css" href="Styles.css">
        <script src="script.js"></script>
    </head>

    <body>
    <header>
        <img src="Logo.png" id="logo">
        <nav>
            <ul>
                <li><a href="home.php">Home</li></a>
                <li><a href="search.php">Search</a></li>
                <li><a href="account.php">Account</a></li>

                <div class="welcome">
                    <p><?php echo "Hi " . $_SESSION['username'] . ". "; ?> <a href="Home.php?logOut=true">log off</a></p>
                </div>
            </ul>
        </nav>
    </header>
    <?php if($Updated) { ?>
        <section>
            <p>Details Updated</p>
        </section>
    <?php } else { ?>
        <section>
            <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p><span class="bold">Update</span> your account details</p>
                <p><label>Username: </label><input type="text" name="username" id="username" <?php echo addValueTag(@$username); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['username']); ?></p>
                <p><label>Forename: </label><input type="text" id="forename" name="forename" <?php echo addValueTag(@$forename); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['forename']); ?></p>
                <p><label>Surname: </label><input type="text" id="surname" name="surname" <?php echo addValueTag(@$surname); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['surname']); ?></p>
                <p><label>Date Of Birth: </label><input type="text" id="dob" name="dob" <?php echo addValueTag(@$dob); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['dob']); ?></p>
                <p><label>Phone: </label><input type="text" id="phone" name="phone" <?php echo addValueTag(@$phone); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['phone']); ?></p>
                <p><label>Address: </label><input type="text" id="address" name="address" <?php echo addValueTag(@$address); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['address']); ?></p>
                <p><label>Email Address: </label><input type="email" id="email" name="email" <?php echo addValueTag(@$email); ?>>
                    <?php echo nullCheckOutput(@$validationMessage['email']); ?></p>
                <p><label>Password: </label><input type="password" name="password" id="password">
                    <?php echo nullCheckOutput(@$validationMessage['password']); ?></p>
                <p><input type="submit"> <?php echo nullCheckOutput(@$validationMessage['form']); ?> </p>
            </form>
        </section>
    <?php } ?>
    <footer><p>Made by Nyakeh Rogers</p></footer>
    </body>
</html>