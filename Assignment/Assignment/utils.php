<?php
//include('database.php'); fix $conn

    function CreateNewUser($connection, $username, $forename, $surname, $phone, $address, $email, $password) {
        $sql = "INSERT INTO tblUser (username, forename, surname, phone, address, email, password) VALUES ('$username', '$forename', '$surname', '$phone', '$address', '$email', '$password')";
        mysqli_query($connection, $sql);
        //echo mysqli_error ($connection);
    }

    function LogIn($connection, $username, $password) {
        $sql = "SELECT username, password FROM tblUser";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($result)) {
            if($username == $row['username'] & $password == $row['password']) {
                $_SESSION['username'] = $username;
                $output = "Welcome back " . $username;
                header('Location: login.php');
            } else {
                $output = "Log in failed";
            }
        }
        return $output;
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

    function isRequiredForRegister($field)
    {
        $required = array('username', 'password', 'email', 'surname', 'forename', 'address'); //add DOB
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
        }
        return $message;
    }

    function checkAgeRange($value)
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
?>