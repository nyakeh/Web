<?php
    session_start();
    /*include('database.php');*/
    include('utils.php');

    if($_POST) {
        $expected = array('username', 'forename', 'surname', 'phone', 'dob', 'address', 'email', 'password');
        $validationMessage = ValidateFields($expected, 'register');
        $username = $_POST['username'];
        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $email =$_POST['email'];

        if($validationMessage) {
            $validationMessage['form'] = errorMessage('Please amend your details');
        } else {
            CreateNewUser($username, $forename, $surname, $dob, $phone, $address, $email, $_POST['password']);
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
    <img src="Logo.png" id="logo">
    <nav>
        <ul>
            <li><a href="home.php">Home</li></a>
            <li><a href="Register.php">Register temp link</li></a>
        </ul>
    </nav>
</header>
<section>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p><b>Welcome,</b> Please Register Below</p>
        <p><label>Username: </label><input type="text" name="username" id="username" <?php nullCheckOutput(addValueTag(@$username)); ?>>
            <?php nullCheckOutput(@$validationMessage['username']); ?></p>
        <p><label>Forename: </label><input type="text" id="forename" name="forename" <?php nullCheckOutput(addValueTag(@$forename)); ?>>
            <?php nullCheckOutput(@$validationMessage['forename']); ?></p>
        <p><label>Surname: </label><input type="text" id="surname" name="surname" <?php nullCheckOutput(addValueTag(@$surname)); ?>>
            <?php nullCheckOutput(@$validationMessage['surname']); ?></p>
        <p><label>Date Of Birth: </label><input type="date" id="dob" name="dob" placeholder="DD/MM/YYYY" <?php nullCheckOutput(addValueTag(@$dob)); ?>>
            <?php nullCheckOutput(@$validationMessage['dob']); ?></p>
        <p><label>Phone: </label><input type="number" id="phone" name="phone" <?php nullCheckOutput(addValueTag(@$phone)); ?>>
            <?php nullCheckOutput(@$validationMessage['phone']); ?></p>
        <p><label>Address: </label><input type="text" id="address" name="address" <?php nullCheckOutput(addValueTag(@$address)); ?>>
            <?php nullCheckOutput(@$validationMessage['address']); ?></p>
        <p><label>Email Address: </label><input type="email" id="email" name="email" <?php nullCheckOutput(addValueTag(@$email)); ?>>
            <?php nullCheckOutput(@$validationMessage['email']); ?></p>
        <p><label>Password: </label><input type="password" name="password" id="password">
            <?php nullCheckOutput(@$validationMessage['password']); ?></p>
        <p><input type="submit" value="Register" class="form button"> <?php nullCheckOutput(@$validationMessage['form']); ?> </p>
    </form>
</section>
<footer><p>Made by Nyakeh Rogers</p></footer>
</body>
</html>