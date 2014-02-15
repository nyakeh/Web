<?php
session_start();
include('Utils.php');

class AccountDetails {
    public $AccountId = "";
    public $Forename = "";
    public $Surname  = "";
    public $Email  = "";
    public $Password  = "";
}

$expected = array('forename', 'surname','email', 'password');
$validationMessage = validateFields($expected, 'update');

if($validationMessage) {
    echo 'Please amend your details';
} else {
    $account = new AccountDetails();
    $account->AccountId = $_SESSION['userId'];
    $account->Forename  = $_POST['forename'];
    $account->Surname  = $_POST['surname'];
    $account->Email = $_POST['email'];
    $account->Password  = $_POST['password'];

    $service_url = 'http://127.0.0.1:81/api/account'. '/'. $_SESSION['userId'];
    $curl_post_data = json_encode($account);

    $ch = curl_init($service_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
    curl_setopt($ch, CURLOPT_TIMEOUT, '3');

    $content = trim(curl_exec($ch));
    $responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($responseCode == 200) {
        echo 'Your account has been updated.';
    } else {
        echo 'Sorry, we were unable to update your account.';
    }
}





/* ----------------------------------------------------------------------   Register Code
 session_start();
class AccountDetails {
    public $AccountId = "";
    public $Forename = "";
    public $Surname  = "";
    public $Email  = "";
    public $Password  = "";
}
$account = new AccountDetails();
$account->AccountId = $_SESSION['userId'];
$account->Forename  = $_POST['forename'];
$account->Surname  = $_POST['surname'];
$account->Email = $_POST['email'];
$account->Password  = $_POST['password'];

$service_url = 'http://127.0.0.1:81/api/account'. '/'. $_SESSION['userId'];
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
    echo '200: Success';
} else if($responseCode == 404) {
    echo '404: Failure';
} else {
    echo 'wat'.$responseCode.con;
}
 */