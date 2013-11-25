<?php /* http://web.fcet.staffs.ac.uk/r004869a/ */
    session_start();
    include('database.php');
    include('utils.php');
    $output = '';

    function validateFields($expected) {
        $validationMessage = array();

        foreach ($expected as $field) {
            $value = trim($_POST[$field]);
            if(isNotEmpty($value)) {
                ${$field} = htmlentities($value, ENT_COMPAT, 'UTF-8');
                if($message = validate($field, $value)) {
                    $validationMessage[$field] = errorMessage($message);
                }
            } else {
                if(isRequiredForLogin($field)) {
                    $validationMessage[$field] = errorMessage('Required');
                }
            }
        }
        return $validationMessage;
    }
    if($_POST) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($_POST['intent'] == "register"){
            $expected = array('username', 'forename', 'surname', 'phone', 'address', 'email', 'password'); // Add DOB
            $validationMessage = validateFields($expected);

            if($validationMessage) {
                $validationMessage['form'] = errorMessage('Please amend your details');
            } else {
                $validationMessage['form'] = '[MOCK] saved to db';
                //CreateNewUser($conn, $username, $_POST['forename'], $_POST['surname'], $_POST['phone'], $_POST['address'], $_POST['email'], $password);
            }
        } else {
            $expected = array('username', 'password');
            $validationMessage = validateFields($expected);

            if($validationMessage) {
                $validationMessage['form'] = errorMessage('Please amend your details');
            } else {
                $validationMessage['form'] = LogIn($conn, $username, $password);
            }
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Styles.css">
        <script src="script.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
    </head>

    <body>
    <header>
        <h1>Car Catalogue</h1>
        <nav>
            <ul>
                <a href="home.php"><li>Home</li></a>
            </ul>
        </nav>
    </header>

    <section>
        <p>New customers register here <button onclick="changeText();">Hello</button></p>
        <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p><label>Username<input type="text" name="username" id="username" <?php nullCheckOutput(addValueTag(@$username)); ?>></label>
                <?php nullCheckOutput(@$validationMessage['username']); ?>
            </p>
            <div id="new"></div>
            <p><label>Password: <input type="password" name="password" id="password"></label>
                <?php nullCheckOutput(@$validationMessage['password']); ?>
            </p>
            <input type="hidden" name="intent" id="intent" value="login">
            <p><input type="submit"> <?php nullCheckOutput(@$validationMessage['form']); ?> </p>
        </form>
    </section>
    <!--<footer>Made by Nyakeh Rogers</footer>-->
</body>
</html>