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
    $data = $postData['data'];
        
    $test = $apiFunctions->sealVerify($login, $code, $data);
 
    if ($test == 'NOK') {
        $error = true;
    } else {
        $success = true;
    }
}

//HTML Header
include './template/_header.php';

//Main content output
print '<h1>inWebo API PHP - Data Sealing Verification (REST)</h1>';
print '<p>Data sealing requires mAccess.</p>';

if (true === $success) {
    print '<p class="success">Data sealing was successfully verified</p>';
}

if (true === $error) {
    print $errorOccured;
} 

include_once './_sealVerifyForm.php';

//HTML Footer
$homePath = "index.php";
include './template/_footer.php';
