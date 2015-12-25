<?php 

//Main loading
include './_loader.php'; 

//Init vars
$error = false;
$success = false;

//Handle data
$postData = $helpers->getPostData($_POST);

if (!empty($postData)) {
    
    $login = $postData['login'];
    $code = $postData['code'];
        
    $auth = $apiFunctions->AuthenticateREST($login, $code);
 
    if (substr($auth, 0, 3) == 'NOK') {
        $error = true;
    } else {
        $success = true;
    }
}

//HTML Header
include './template/_header.php';

//Main content output
print '<h1>inWebo API PHP - Authentication (REST)</h1>';

if (true === $success) {
    print '<p class="success">User ' . $login . ' successfully authenticated</p>';
}

if (true === $error) {
    print $errorOccured;
} 

$action = 'pageAuthenticateRest.php';

include_once './_authenticationForm.php';

//HTML Footer
$homePath = "index.php";
include './template/_footer.php';
