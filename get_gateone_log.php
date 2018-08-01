<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Authorization");
header('Content-type: application/json');

$log = fopen('logs.txt', 'r');

$logContent = fgets($log);

$parsedData = '['.substr($logContent, 0, -1).']';

echo $parsedData;
?>