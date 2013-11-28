<?php
    session_start();
    include('database.php');
    include('utils.php');

        $username = 'Hello George'; // Remove
        //RetrieveDetails($conn, $username, $forename, $surname, $dob, $phone, $address, $email);           //  Check this works       //  add DOB

    if($_POST) {
        $username = 'Nice Try George';  // Remove
        $expected = array('username', 'forename', 'surname', 'phone', 'dob', 'address', 'email', 'password');
        $validationMessage = ValidateFields($expected, 'register');

        if($validationMessage) {
            $validationMessage['form'] = errorMessage('Please amend your details');
        } else {
            $validationMessage['form'] = '[MOCK] Record created';
            //CreateNewUser($conn, $_POST['username'], $_POST['forename'], $_POST['surname'], $_POST['dob'], $_POST['phone'], $_POST['address'], $_POST['email'], $_POST['password']);    // Turn back on in uni
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
            <li><a href="Register.php">Register temp link</li></a>
        </ul>
        <p><?php echo "Hi " . $_SESSION['username'] ?> <a href="Home.php?logOut=true">log off</a></p>
    </nav>
</header>
<section>
    <p>New customers register here</p>
    <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p><label>Username<input type="text" name="username" id="username" <?php nullCheckOutput(addValueTag(@$username)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['username']); ?></p>
        <p><label>Forename: <input type="text" id="forename" name="forename" <?php nullCheckOutput(addValueTag(@$forename)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['forename']); ?></p>
        <p><label>Surname: <input type="text" id="surname" name="surname" <?php nullCheckOutput(addValueTag(@$surname)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['surname']); ?></p>
        <p><label>Date Of Birth: <input type="text" id="dob" name="dob" <?php nullCheckOutput(addValueTag(@$dob)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['dob']); ?></p>
        <p><label>Phone: <input type="text" id="phone" name="phone" <?php nullCheckOutput(addValueTag(@$phone)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['phone']); ?></p>
        <p><label>Address: <input type="text" id="address" name="address" <?php nullCheckOutput(addValueTag(@$address)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['address']); ?></p>
        <p><label>Email Address: <input type="email" id="email" name="email" <?php nullCheckOutput(addValueTag(@$email)); ?>></label>
            <?php nullCheckOutput(@$validationMessage['email']); ?></p>
        <p><label>Password: <input type="password" name="password" id="password"></label>
            <?php nullCheckOutput(@$validationMessage['password']); ?></p>
        <p><input type="submit"> <?php nullCheckOutput(@$validationMessage['form']); ?> </p>
    </form>
</section>
<!--<footer>Made by Nyakeh Rogers</footer>-->
</body>
</html>