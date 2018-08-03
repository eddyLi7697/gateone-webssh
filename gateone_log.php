<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: Authorization");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo "Request method not allowed!";
    return;
}

/**
 * "callerId": "string", // potato id
 * "callerType": 0, 
 * "targetId": "string", // server id
 * "targetType": 2, 
 * "belongId": "",
 * "belongType": 1,
 * "name": "string", // server name
 * "taskId": "", // uuid 
 * "X-Forwarded-For": "string", // 
 * "ip": "string",
 * "hostname": "string",
 * "pid": 0,
 * "level": 30,
 * "msgCode": 611,
 * "inputParams": {}, // what ever you have
 * "outputParams": {},
 * "msg": "string",
 * "time": "string"
 */

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

$logObject = array(
    'callerId' => $_GET['operatorId'], 
    'callerName' => $_GET['operatorName'],
    'callerType' => 0,
    'targetId' => $_GET['serverId'],
    'targetType' => 2,
    'belongId' => '',
    'belongType' => 1,
    'teamIds' => json_decode($_GET['teamIds']),
    'userIds' => json_decode($_GET['userIds']),
    'serverIds' => json_decode($_GET['serverIds']),
    'name' => $array['serverId'],
    'taskId' => $array['id'],
    "X-Forwarded-For" => "", 
    'ip' => $array['from'],
    'hostname' => $array['host'],
    'pid' => 0,
    'level' => 30,
    'msgCode' => 610,
    'inputParams' => $array,
    'outputParams' => array(),
    'msg' => 'Webssh access log',
    'time' => gmdate("Y-m-d\TH:i:s\Z", $array['timestamp'])
);

$arrayString = json_encode($array).',';
$logObjectString = json_encode($logObject)."\r\n";

$myfile = file_put_contents('logs_new.txt', $arrayString, FILE_APPEND | LOCK_EX);
$myLog = file_put_contents('logs_access.txt', $logObjectString, FILE_APPEND | LOCK_EX);

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