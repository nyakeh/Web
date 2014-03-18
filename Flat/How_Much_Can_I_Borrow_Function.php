<?php
//$service_url = 'http://127.0.0.1:81/api/borrow'; //local
$service_url = 'http://mortgagecalculator.cloudapp.net/api/borrow'; //live
$qry_str = '?deposit=' . $_POST['deposit'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url . $qry_str);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, '5');

$content = trim(curl_exec($ch));
$responseCode =curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($responseCode == 201) {
    echo $content;
} else  {
    echo 'Apologies, a problem occurred';
}