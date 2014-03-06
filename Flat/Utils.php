<?php
class LoginDetails {
    public $Email  = "";
    public $Password  = "";
}
class RegisterDetails {
    public $Forename  = "";
    public $Surname  = "";
    public $Email  = "";
    public $Password  = "";
    public $AccountTypeId  = "1";
    public $Active  = true;
}

function LogIn($email, $password) {
    $account = new LoginDetails();
    $account->Email = $email;
    $account->Password  = $password;

    //$service_url = 'http://127.0.0.1:81/api/login'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/login'; //live
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
    } else {
        $output = detailErrorMessage('Apologies, an error occurred trying to login');
    }
    return $output;
}

function Register($forename, $surname, $email, $password) {
    $account = new RegisterDetails();
    $account->Forename = $forename;
    $account->Surname  = $surname;
    $account->Email = $email;
    $account->Password  = $password;

    //$service_url = 'http://127.0.0.1:81/api/account'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/account'; //live
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
    if($responseCode == 201) {
        $result = json_decode($content);
        $_SESSION['username'] = $result->Forename;
        $_SESSION['userId'] = $result->AccountId;
        $output = detailErrorMessage("Welcome to Gauge " . $result->Forename);
        //header('Location: home.php');
    } else {
        $output = detailErrorMessage('Apologies, an error occurred creating your account');
    }
    return $output;
}

function RetrieveDetails(&$forename, &$surname, &$email, &$password) {
    //$service_url = 'http://127.0.0.1:81/api/account'; //local
    $service_url = 'http://mortgagecalculator.cloudapp.net/api/account'; //live
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
function validateCalculationInput($expected, $state) {
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
                case "mortgage":
                    if(isRequiredForMortgage($field)) {
                        $validationMessage[$field] = errorMessage('Required');
                    };
                    break;
                case "budget":
                    /*if(isRequiredForBudget($field)) {
                        $validationMessage[$field] = errorMessage('Required');
                    };*/
                    break;
            }
        }
    }
    return $validationMessage;
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
                    if(isRequiredForRegister($field)) {
                        $validationMessage[$field] = errorMessage('Required');
                    };
                    break;
                case "update":
                    if(isRequiredForUpdate($field)) {
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
function isRequiredForUpdate($field)
{
    $required = array('forename', 'surname','email', 'password');
    return in_array($field, $required);
}
function isRequiredForRegister($field)
{
    $required = array('register_forename', 'register_surname','register_email', 'register_password');
    return in_array($field, $required);
}
function isRequiredForMortgage($field)
{
    $required = array('houseValue','interest', 'term');
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