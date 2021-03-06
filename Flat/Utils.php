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

    curl_setopt($ch, CURLOPT_TIMEOUT, '20');
    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($responseCode == 200) {
        $result = json_decode($content);
        $_SESSION['username'] = $result->Forename;
        $_SESSION['userId'] = $result->AccountId;
        $output = detailErrorMessage("Welcome back " . $result->Forename);
        //header('Location: index.php');
    } else if($responseCode == 401) {
        $output = detailErrorMessage('Incorrect credentials entered');
    } else if($responseCode == 404) {
        $output = detailErrorMessage('Incorrect credentials entered');
    } else {
        $output = detailErrorMessage('Apologies, an error occurred trying to login');
    }
    return $output;
}

function Register($forename, $surname, $email, $password, $confirm_password) {
	if($password != $confirm_password) {
		return detailErrorMessage('Passwords entered did not match');
	}
	
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

    curl_setopt($ch, CURLOPT_TIMEOUT, '20');
    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($responseCode == 201) {
        $result = json_decode($content);
        $_SESSION['username'] = $result->Forename;
        $_SESSION['userId'] = $result->AccountId;
        $output = detailErrorMessage("Welcome to Gauge " . $result->Forename);
        //header('Location: index.php');
	} else if($responseCode == 409) {
		$result = json_decode($content);
		$output = detailErrorMessage($result->Message);
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
    curl_setopt($ch, CURLOPT_TIMEOUT, '20');
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
    header('Location: index.php');
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
function isCalculationInputValid($expected, $state) {
    $valid = true;

    foreach ($expected as $field) {
        $value = trim($_POST[$field]);
        if(!isNotEmpty($value)) {
            switch($state) {
                case "mortgage":
                    if(isRequiredForMortgage($field)) {
                        $valid = false;
                    };
                    break;
                case "mortgage_compare":
                    if(isRequiredForMortgageCompare($field)) {
                        $valid = false;
                    };
                    break;
            }
        }
    }
    return $valid;
}
function ValidateFields($expected, $state) {
    $validationMessage = array();

    foreach ($expected as $field) {
        $value = trim($_POST[$field]);
        if(isNotEmpty($value)) {
            ${$field} = htmlentities($value, ENT_COMPAT, 'UTF-8');
            if($message = validate($field, $value)) {
                $validationMessage[$field] = errorTooltip($message);
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
    $required = array('register_forename', 'register_surname','register_email', 'register_password', 'register_confirm_password');
    return in_array($field, $required);
}
function isRequiredForMortgage($field)
{
    $required = array('houseValue','deposit','interest', 'term','fees');
    return in_array($field, $required);
}
function isRequiredForMortgageCompare($field)
{
    $required = array('houseValue','deposit', 'term');
    return in_array($field, $required);
}
function isNotEmpty($value)
{
	if($value == "") {
		return false;
	}
    return true;
}
function errorMessage($message)
{
    return '<span class="error">' . $message . '</span>';
}
function detailErrorMessage($message)
{
    return '<span class="detailed_error">' . $message . '</span>';
}
function errorTooltip($message)
{
    //<span id="tooltip"><a href="">Introduction<span>Introduction to HTML and CSS: tooltip with extra text</span></a></span>
    return '<span id="tooltip"><a href="">Invalid<span>' . $message . '</span></a></span>';
}
function validate($field, $value)
{
    $message = '';
    switch($field) {
        case 'email':
        case 'register_email':
            if(filter_var($value, FILTER_VALIDATE_EMAIL) === FALSE) {
                $message = 'Email address not valid';
            }
            break;
    }
    return $message;
}
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}