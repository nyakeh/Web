<?php

class Hat {
    public $Name = "";
    public $Colour  = "";
    public $Id = "";
}

$user = new Hat();
$user->Name = $_POST['name'];
$user->Colour  = $_POST['colour'];

//$service_url = 'http://localhost:50565/api/hat';
$service_url = 'http://nyakehbowl.azurewebsites.net/api/hat';
$arr = array('Name' => 'Shoe', 'Colour' => 'Green');
$curl_post_data = json_encode($user);
$ch = curl_init($service_url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
echo $content;