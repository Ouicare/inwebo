<?php 

//Main loading
include_once '_loader.php'; 

//Init vars
$error = false;
$success = false;

$loginId = 0;
$longCode = 0;
$activationCode = 0;
$activationInfo = 0;

//Handle data
$postData = $helpers->getPostData($_POST);

if (!empty($postData)) {
    
    $login = new stdClass();
    $login->login = $postData['login'];
    $login->firstname = $postData['loginFirstname'];
    $login->name = $postData['loginName'];
    $login->mail = $postData['loginEmail'];
    $login->codetype = $postData['loginActivationType'];

    $create = $apiFunctions->loginCreate($login);
    
    if ($create == 'NOK' || $create->err != 'OK') {
        $error = true;
    } else {
        $loginId = $create->id;
        $success = true;
        
        if ($login->codetype == "0") {
            $activationCode = $create->code;
        } else if($login->codetype == "2") {
            $longCode = $create->code;
            $activationCode = $apiFunctions->loginGetCodeFromLink($longCode);
            $activationInfo = $apiFunctions->loginGetInfoFromLink($longCode);
        }
    }
}

//HTML Header
include_once 'template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>Create a new user</h2>';

if (true === $error) {
    print $errorOccured;
    print '<p class="error">If creating or editing a user, you may encounter an error '
        . 'because the chosen user login already exists in the service.</p>';
}

if (true === $success) {
    print '<p class="success">User <a href="pageLoginUpdate.php?loginId=' . $loginId . '">' . $login->login . ' </a>successfully created!</p>';
    if ($login->codetype == "0") {
        print '<p>You may activate it with code: <b>' . $activationCode . '</b></p>';
    } else if ($login->codetype == "2") {
        print '<p>The 3 week generated code is: <b>' . $longCode . '</b></p>';
        print '<p>Using function loginGetCodeFromLink allows to retrieve the final activation code from this long code: <b>' . $activationCode . '</b></p>';
        print '<p>Using function loginGetInfoFromLink allows to retrieve the final activation code and the login ID from this long code:</p>'
        . '<ul><li>Activation code: <b>' . $activationInfo->code . '</li>'
        . '<li>Login ID: <b>' . $activationInfo->id . '</li></ul>';
    }
}

include_once '_loginCreateForm.php';

//Footer
$homePath = "index.php";
$secondaryPath = "pageLoginHome.php";
$secondaryPathName = "User Management";
include_once 'template/_footer.php';
