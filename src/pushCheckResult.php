<?php

//Main loading
include '_loader.php'; 

//Handle data
$getData = $helpers->getGetData($_GET);

$login = $getData['login'];
$sessionId = $getData['sessionId'];

$check = $apiFunctions->checkPushResult($login, $sessionId);
$answer = array();

if ($check == 'NOK') {
    $answer['result'] = 'NOK';
    
} else if($check['err'] == 'NOK:WAITING') {
    $answer['result'] = 'WAITING';
} else  {
    if ($check['err'] != 'OK') {
        $answer['result'] = 'NOK';
    } else {
        $answer['result'] = 'OK';
    }
}

//Output
print json_encode($answer);