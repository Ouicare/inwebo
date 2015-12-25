<?php 

//Main loading
include '_loader.php'; 

$error = false;
$success = false;

$login = '';
$sessionId = null;

//Handle data
$postData = $helpers->getPostData($_POST);

if (!empty($postData)) {
    
    $login = $postData['login'];
        
    $push = $apiFunctions->pushAuthenticate($login);
 
    if ($push == 'NOK') {
        $error = true;
    } else {
        
        if ($push['err'] != 'OK') {
            $error = true;
        } else {
            $success = true;
            $sessionId = $push['sessionId'];
            $checkURL = 'pushCheckResult.php?sessionId=' . $sessionId . '&login=' . $login;
            $javascript = 1;
            $pushJavascript = 'pushListener.js';
        }
    }
}

//HTML Header
include 'template/_header.php';

//Main content output
print '<h1>inWebo API PHP - Authentication with Mobile Notifications (Push)</h1>';

if (true === $error) {
    print $errorOccured;
}

if (true === $success) {
    print '<div id="authenticationError" style="display:none;">';
    print '<p class="error">Push authentication failed</p>';
    print '</div>';
    
    print '<div id="authenticationSuccess" style="display:none;">';
    print '<p class="success">User ' . $login . ' successfully authenticated</p>';
    print '</div>';
}

include_once '_pushAuthenticateForm.php';

//HTML Footer
$homePath = "index.php";
include 'template/_footer.php';
