<?php 

//Main loading
include_once './_loader.php'; 

//Init vars
$error = false;
$success = false;
$needsConfirm = false;

//Handle data
$getData = $helpers->getGetData($_GET);
$postData = $helpers->getPostData($_POST);

if (!empty($postData)) {
    
    $loginId = $postData['loginId'];
    $login = $postData['login'];
        
    $delete = $apiFunctions->loginDelete($loginId);
    
    if ($delete == 'NOK') {
        $error = true;
    } else {
        $success = true;
    }

} else if (!empty($getData)) {
    $needsConfirm = true;
    $loginId = $getData['loginId'];
    $login = $getData['login'];
    
} else {
    $error = true;
}

//HTML Header
include_once './template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>Delete a user</h2>';

if (true === $success) {
    print '<p class="success">User ' . $login . ' successfully deleted</p>';
}

if (true === $error) {
    print $errorOccured;
} 

if (true === $needsConfirm) {
    include_once './_loginDeleteForm.php';
}

//Footer
$homePath = "index.php";
$secondaryPath = "pageLoginHome.php";
$secondaryPathName = "User Management";
include_once './template/_footer.php';