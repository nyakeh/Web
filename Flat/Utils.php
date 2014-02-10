<?php


function RetrieveDetails(&$forename, &$surname, &$email, &$password) {
    global $conn;
    $service_url = 'http://gauge.azurewebsites.net/api/account';
    $qry_str = '/3'; //use $_SESSION['accountId']
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, '3');
    $content = trim(curl_exec($ch));
    curl_close($ch);
    echo $content;
    $result = json_decode($content);
    $forename = $result->Forename;
    $surname = $result->Surname;
    $email = $result->Email;
    $password = $result->Password;
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

