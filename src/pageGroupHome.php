<?php 

//Main loading
include_once './_loader.php'; 

//Init vars
$error = false;
$emptyList = false;

//Handle data
//Getting 25 first user groups in the service
$groups = $apiFunctions->serviceGroupsQuery(0 , 25);

if ($groups == 'NOK') {
    $error = true;
} else {
    if ($groups->n == 0) {
        $emptyList = true;
    }
}

//HTML Header
include_once './template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>User Group Management</h2>';

if (true === $error) {
    
    print $errorOccured;
    
//Display list of groups
} else {
    if (false === $emptyList) {
        
        print '<h3>Service available user groups are:</h3>';
        print '<ul>';
        for ($i=0; $i<$groups->n; $i++ ) {
            print '<li>Group "<b>' . $groups->name[$i]
                    . '</b>" [ <a title="Manage users of the group" href="pageGroupUserManagement.php?'
                    . 'groupId=' . $groups->id[$i] . '&groupName=' . $groups->name[$i]
                    . '">Manage users of the group</a> ] ';
        }
        print '</ul>';
        
    } else {
        print '<p>No user group defined in this service. Please connect to inWebo administration console to create a user group.</p>';
    }
}

//Footer
$homePath = "index.php";
include_once './template/_footer.php';