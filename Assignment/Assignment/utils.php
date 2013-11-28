<?php
//include('database.php'); fix $conn

    function LogIn($connection, $username, $password) {
        $sql = "SELECT username, password FROM tblUser";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($result)) {
            if($username == $row['username'] & $password == $row['password']) {
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $row['userId'];     // Check this actually returns the correct value
                $output = "Welcome back " . $username;
                header('Location: home.php');
            } else {
                $output = "Log in failed";
            }
        }
        return $output;
    }

    function CreateNewUser($connection, $username, $forename, $surname, $dob, $phone, $address, $email, $password) {
        $sql = "INSERT INTO tblUser (username, forename, surname, dateOfBirth, phone, address, email, password) VALUES ('$username', '$forename', '$surname', '$dob', '$phone', '$address', '$email', '$password')";
        mysqli_query($connection, $sql);
        //echo mysqli_error ($connection);
    }

    function UpdateUser($connection, $username, $forename, $surname, $dob, $phone, $address, $email, $password) {
        $userId = $_SESSION['userId'];
        $sql = "UPDATE tblUser SET username='$username', forename='$forename', surname='$surname', dateOfBirth='$dob', phone='$phone', address='$address', email='$email', password='$password' WHERE userId='$userId'";
        mysqli_query($connection, $sql);
    }

    function RetrieveDetails($connection, &$username, &$forename, &$surname, &$dob, &$phone, &$address, &$email) {
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM tblUser WHERE userId='$userId'";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($result)) {
            $username = $row['username'];
            $forename = $row['forename'];
            $surname = $row['surname'];
            $dob = $row['dateOfBirth'];
            $phone = $row['phone'];
            $address = $row['address'];
            $email = $row['email'];
        }
    }

    function ValidateFields($expected, $state) {
        $validationMessage = array();

        foreach ($expected as $field) {
            $value = trim($_POST[$field]);
            if(isNotEmpty($value)) {
                ${$field} = htmlentities($value, ENT_COMPAT, 'UTF-8');
                if($message = validate($field, $value)) {
                    $validationMessage[$field] = errorMessage($message);
                }
            } else {
                switch($state) {
                    case "login":
                        if(isRequiredForLogin($field)) {
                            $validationMessage[$field] = errorMessage('Required');
                        };
                        break;
                    case "register":
                    case "update":
                        if(isRequiredForUser($field)) {
                            $validationMessage[$field] = errorMessage('Required');
                        };
                        break;
                }
            }
        }
        return $validationMessage;
    }
    function LogOut() {
        session_destroy();
        header('Location: Home.php');
    }

    function SearchMake($connection, $make) {
        $output = '';
        $sql = "SELECT make, model FROM tblVehicle";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($result)) {
            if($make == $row['make']) {
                $output .= $row['make'] . $row['model'];
            } else {
                $output = "No results found";
            }
        return $output;
        }
    }
    // -- Input Validation --
    function isRequiredForLogin($field)
    {
        $required = array('username', 'password');
        return in_array($field, $required);
    }

    function isRequiredForUser($field)
    {
        $required = array('username', 'password', 'email', 'surname', 'dob', 'forename', 'phone', 'address');
        return in_array($field, $required);
    }

    function isNotEmpty($value)
    {
        return !empty($value) || $value === 0;
    }

    function errorMessage($message)
    {
        return '<span class="error">' . $message . '</span>';
    }

    function nullCheckOutput($value)
    {
        $output = '';
        if($value) {
            $output = $value;
        }
        echo $output;
    }

    function addValueTag($value)
    {
        $output = '';
        if($value) {
            $output = ' value="' . $value . '"';
        }
        return $output;
    }

    function validate($field, $value)
    {
        $message = '';
        switch($field) {
            case 'phone':
                if(filter_var($value, FILTER_VALIDATE_INT) === FALSE) {
                    $message = 'Not a valid phone number';
                }
                break;
            case 'email':
                if(filter_var($value, FILTER_VALIDATE_EMAIL) === FALSE) {
                    $message = 'Not a valid email address';
                }
                break;
            case 'dob':
                $message = checkAgeRange($value);
                break;
        }
        return $message;
    }

    function checkAgeRange($value) // Change to accept DOB instead of age
    {
        $options = array(
            'options' => array(
                'min_range' => 18,
                'max_range' => 123) // Oldest officially confirmed age is 122
        );
        if(filter_var($value, FILTER_VALIDATE_INT, $options) === FALSE) {
            return 'Age must be between 18 and 123 (inclusive)';
        }
        return '';
    }
