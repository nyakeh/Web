<?php
    /*include('database.php');*/

    function LogIn($username, $password) {
        global $conn;
        $sql = "SELECT userId, username, password FROM tblUser";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            if($username == $row['username'] & $password == $row['password']) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['userId'] = $row['userId'];
                $output = "Welcome back " . $username;
                header('Location: home.php');
            } else {
                $output = "Log in failed";
            }
        }
        return $output;
    }

    function CreateNewUser($username, $forename, $surname, $dob, $phone, $address, $email, $password) {
        global $conn;
        $sql = "INSERT INTO tblUser (username, forename, surname, dob, phone, address, email, password) VALUES ('$username', '$forename', '$surname', '$dob', '$phone', '$address', '$email', '$password')";
        mysqli_query($conn, $sql);
        LogIn($username, $password);
        //echo mysqli_error ($connection);
    }

    function UpdateUser($username, $forename, $surname, $dob, $phone, $address, $email, $password) {
        global $conn;
        $userId = $_SESSION['userId'];
        $sql = "UPDATE tblUser SET username='$username', forename='$forename', surname='$surname', dob='$dob', phone='$phone', address='$address', email='$email', password='$password' WHERE userId='$userId'";
        mysqli_query($conn, $sql);
    }

    function RetrieveDetails(&$username, &$forename, &$surname, &$dob, &$phone, &$address, &$email) {
        global $conn;
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM tblUser WHERE userId='$userId'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            $username = $row['username'];
            $forename = $row['forename'];
            $surname = $row['surname'];
            $dob = $row['dob'];
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
    // -- Car Catalogue search --
    function Search($searchText, $criteria) {
        global $conn;
        $output = '';
        $_SESSION['searchText'] = $searchText;
        $_SESSION['criteria'] = $criteria;
        $sql = "SELECT * FROM tblvehicle WHERE $criteria LIKE '$searchText%'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            $output .= '<p><b>'.$row['make'].' '.$row['model'].'</b> '.$row['year'].' '.$row['colour']. '</p>';
        }

        if($output === '') {
            $output = "No results found";
        }
        return $output;
    }

    function SaveSearch() {
        global $conn;
        $userId = $_SESSION['userId'];
        $criteria = $_SESSION['criteria'];
        $searchText = $_SESSION['searchText'];
        $sql = "INSERT INTO tblSearch (userId, criteria, searchText) VALUES ('$userId','$criteria','$searchText')";
        mysqli_query($conn, $sql);
    }

    function RetrieveSearches() {
        global $conn;
        $output = '';
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM tblsearch WHERE userId = '$userId'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            $output .= '<h4>'. $row['criteria'] . ': ' . $row['searchText'] .'</h>';
            $vehicles = Search($row['searchText'], $row['criteria']);
            $output .= '<p>'. $vehicles . '</p>';
        }

        if($output === '') {
            $output = "No saved searches";
        }
        return $output;
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
        return $output;
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
                if(!ctype_digit($value)) {
                    $message = $value .'Not a valid phone number';
                }
                break;
            case 'email':
                if(filter_var($value, FILTER_VALIDATE_EMAIL) === FALSE) {
                    $message = 'Not a valid email address';
                }
                break;
            case 'dob':
                $message = checkAgeRange($value);  // Check this works
                break;
        }
        return $message;
    }

    function checkAgeRange($value) // Change to regex check - accept DOB instead of age
    {
        list($day,$month,$year) = explode('/', $value);
        $month;
        $dayOptions = array(
            'options' => array(
                'min_range' => 1,
                'max_range' => 31)
        );
        $monthOptions = array(
            'options' => array(
                'min_range' => 01,
                'max_range' => 12)
        );
        $yearOptions = array(
            'options' => array(
                'min_range' => 1891,
                'max_range' => 2013)
        );

        if(filter_var($day, FILTER_VALIDATE_INT, $dayOptions) === FALSE) {
            return 'Day must be between 1 and 31st';
        } else if(filter_var($month, FILTER_VALIDATE_INT, $monthOptions) === FALSE) {
            return 'Month must be between 1 and 12';
        } else if(filter_var($year, FILTER_VALIDATE_INT, $yearOptions) === FALSE) {
            return 'Year must be between 1891 and 2013'; // Oldest officially confirmed age is 122
        } else {
        return '';
        }
    }
