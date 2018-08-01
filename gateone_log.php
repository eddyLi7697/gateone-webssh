<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: Authorization");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo "Request method not allowed!";
    return;
}

$array = array(
    'id' => generateRandomString(7),
    'timestamp' => time(),
    'operatorId' => $_GET['operatorId'],
    'operatorName' => $_GET['operatorName'],
    'user' => $_GET['user'],
    'host' => $_GET['host'],
    'port' => $_GET['port'],
    'serverId' => $_GET['serverId'],
    'from' => $_SERVER['REMOTE_ADDR'],
);

$arrayString = json_encode($array).',';

$myfile = file_put_contents('logs.txt', $arrayString, FILE_APPEND | LOCK_EX);

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>