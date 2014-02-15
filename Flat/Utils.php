<?php
class LoginDetails {
    public $Email  = "";
    public $Password  = "";
}

function LogIn($email, $password) {
    $account = new LoginDetails();
    $account->Email = $email;
    $account->Password  = $password;

    $service_url = 'http://127.0.0.1:81/api/login';
    $curl_post_data = json_encode($account);
    $ch = curl_init($service_url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

    curl_setopt($ch, CURLOPT_TIMEOUT, '3');
    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($responseCode == 200) {
        $result = json_decode($content);
        $_SESSION['username'] = $result->Forename;
        $_SESSION['userId'] = $result->AccountId;
        $output = detailErrorMessage("Welcome back " . $result->Forename);
        //header('Location: home.php');
    } else if($responseCode == 401) {
        $output = detailErrorMessage('401: Flapped it. Correct email wrong password');
    } else if($responseCode == 404) {
        $output = detailErrorMessage('404: Stacked it. Email not found in Db');
    }
    return $output;
}

function RetrieveDetails(&$forename, &$surname, &$email, &$password) {
    $service_url = 'http://127.0.0.1:81/api/account';
    $qry_str = '/' . $_SESSION['userId'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, '3');
    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($responseCode == 200) {
        $result = json_decode($content);
        $forename = $result->Forename;
        $surname = $result->Surname;
        $email = $result->Email;
        $password = $result->Password;
    } else if($responseCode == 404) {
        $forename ='';
        $surname ='';
        $email = '';
        $password ='';
    }
}

function LogOut() {
    session_destroy();
    header('Location: Home.php');
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
    $output = 'value="' . nullCheckOutput($value) . '"';
    return $output;
}
// -- Input Validation --
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
function isRequiredForLogin($field)
{
    $required = array('email', 'password');
    return in_array($field, $required);
}
function isRequiredForUser($field)
{
    $required = array('email', 'password', 'surname','forename', 'phone');
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
function detailErrorMessage($message)
{
    return '<span class="detailed_error">' . $message . '</span>';
}
function validate($field, $value)
{
    $message = '';
    switch($field) {
        case 'phone':
            if(!ctype_digit($value)) {
                $message = $value .'Phone number not valid';
            }
            break;
        /*case 'email':
            if(filter_var($value, FILTER_VALIDATE_EMAIL) === FALSE) {
                $message = 'Email address not valid';
            }
            break;*/
    }
    return $message;
}