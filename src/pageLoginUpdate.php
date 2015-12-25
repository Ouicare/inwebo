<?php 

//Main loading
include_once '_loader.php'; 

//Init vars
$error = false;
$success = false;

//Handle data
$getData = $helpers->getGetData($_GET);

$postData = $helpers->getPostData($_POST);

if (!empty($postData)) {
    
    $login = new stdClass();

    $login->loginId = (int) $postData['loginId'];
    $login->login = $postData['login'];
    $login->firstname = $postData['loginFirstname'];
    $login->name = $postData['loginName'];
    $login->mail = $postData['loginEmail'];
        
    $update = $apiFunctions->loginUpdate($login);
    
    if ($update != 'OK') {
        $error = true;
    } else {
        $success = true;
    }
    
    $loginId = $postData['loginId'];
    $loginCode = $postData['loginCode'];

} else if (!empty($getData)) {
    $loginId = $getData['loginId'];
    
    $login = $apiFunctions->loginQuery($loginId);
    $loginCode = $login->code;
    
    if ($login == 'NOK') {
        $error = true;
        
    }
} else {
    $error = true;
}

//HTML Header
include_once 'template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>Update a user</h2>';

if (true === $success) {
    print '<p class="success">User ' . $login->login . ' successfully updated!</p>';
}

if (true === $error) {
    print $errorOccured;
    print '<p class="error">If creating or editing a user, you may encounter an error '
    . 'because the chosen user login already exists in the service.</p>';
} else {
    print '<p> User activation code is: ' . $loginCode .  '</p>';
}

if (false === $error) {
    include_once '_loginUpdateForm.php';
}

//Footer
$homePath = "index.php";
$secondaryPath = "pageLoginHome.php";
$secondaryPathName = "User Management";
include_once 'template/_footer.php';