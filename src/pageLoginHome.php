<?php 

//Main loading
include_once '_loader.php'; 

//Init vars
$error = false;
$login = '';
$loginSearch = '';
$postData = $helpers->getPostData($_POST);

//Handle Data
if (!empty($postData)) {
    $login = $postData['login'];

    $loginSearch = $apiFunctions->loginSearch($login, 0, 0, 100, 0);

    if ($loginSearch == 'NOK' || $loginSearch->err == 'NOK') {
        $error = true;
    }
}

//HTML Header
include_once 'template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>User Management</h2>';

if (true === $error) {
    print $errorOccured;
}

print '<p><a href="pageLoginCreate.php">Create a new user</a></p>';
print '<p>Search a user (you may then edit or delete found users)</p>';
include_once '_loginSearchForm.php';

//Handling loginSearch result
if (false ===  $error && $loginSearch != '' && $loginSearch->n > 0) {
    print '<h3>Search Result</h3>';
    print '<ul>';
    for ($i=0; $i<$loginSearch->n; $i++ ) {
        print '<li>' . $loginSearch->login[$i]
                . ' [ <a title="Edit user" href="pageLoginUpdate.php?loginId=' . $loginSearch->id[$i] . '">Edit user</a> ] '
                . '[ <a title="Delete user" href="pageLoginDelete.php?loginId=' . $loginSearch->id[$i]
                . '&login=' . $loginSearch->login[$i] . '">Delete user</a> ]</li>';
    }
    print '</ul>';
} else if (false ===  $error && $loginSearch != '') {
    print '<h3>Your search returned no result</h3>';
}

//Footer
$homePath = "index.php";
include_once 'template/_footer.php';