<?php 

//Main loading
include_once './_loader.php'; 

//Init vars
$error = false;
$success = false;

$action = null;
$loginId = null;

$emptyServiceUserList = false;
$emptyGroupUserList = false;

//Handle data
$getData = $helpers->getGetData($_GET);

if (!empty($getData)) {

    $groupId = $getData['groupId'];
    $groupName = $getData['groupName'];
    
    if (isset($getData['action'])) {
        $action = $getData['action'];
        $loginId = $getData['loginId'];
        
        $groupMembership = new stdClass();
        $groupMembership->groupId = (int) $groupId;
        $groupMembership->loginId = (int) $loginId;
        $groupMembership->roleId = 0; // user role in the group is set to 'user'
        
        if ($action == 'addUser') {
            $add = $apiFunctions->groupMembershipCreate($groupMembership);
            
            if ($add == 'NOK') {
                $error = true;
            } else {
                $success = true;
                $successMessage = '<p class="success">User successfully added to group</p>';
            }
            
        }
        
        if ($action == 'removeUser') {
            $delete = $apiFunctions->groupMembershipDelete($groupMembership);
            
            if ($delete == 'NOK') {
                $error = true;
            } else {
                $success = true;
                $successMessage = '<p class="success">User successfully removed from group</p>';
            }
        }
    }
    
    //Get 25 first users in group
    $groupUsers = $apiFunctions->loginsQueryByGroup($groupId, 0, 25, 0);
    
    if ($groupUsers == "NOK") {
        $error = true;
        
    } else {
        if ($groupUsers->n == 0) {
            $emptyGroupUserList = true;
        }
    }
    
    //Get 25 first service users
    $serviceUsers = $apiFunctions->loginsQuery(0, 25, 0);
    
    if ($serviceUsers == "NOK") {
        $error = true;
    } else {
        if ($serviceUsers->n == 0) {
            $emptyServiceUserList = true;
        }
    }
    
} else {
    $error = true;
}

//HTML Header
include_once './template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<h2>Manage users of group <b>' . $groupName . '</b></h2>';

if (false === $emptyServiceUserList) {

    if (false === $emptyGroupUserList) {
        
        if (true === $error) {
            print $errorOccured;
            if ($action == 'addUser') {
                print '<p class="error">User might already be in the group</p>';
            }
        }

        if (true === $success) {
            print $successMessage;
        }

        print '<h3>Users of the group are:</h3>';
        print '<ul>';
        for ($i=0; $i<$groupUsers->n; $i++ ) {
            print '<li><b>' . $groupUsers->login[$i]
                    . '</b> [ <a title="Remove user from group" href="pageGroupUserManagement.php?action=removeUser'
                    . '&groupId=' . $groupId
                    . '&groupName=' . $groupName
                    . '&loginId=' . $groupUsers->id[$i]
                    . '">Remove user from group</a> ] ';
        }
        print '</ul>';

    } else {
        print '<h3>No user in this group. You can start adding users of the service to the group below.</h3>';
    }

    print '<h3>Users of the service are:</h3>';
    print '<ul>';
    for ($i=0; $i<$serviceUsers->n; $i++ ) {
        print '<li><b>' . $serviceUsers->login[$i]
                . '</b> [ <a title="Add user to the group" href="pageGroupUserManagement.php?action=addUser'
                . '&groupId=' . $groupId
                . '&groupName=' . $groupName
                . '&loginId=' . $serviceUsers->id[$i]
                . '">Add user to the group</a> ] ';
    }
    print '</ul>';

} else {
    print '<p>No user has been defined in the service. Please go to <a href="pageLoginCreate.php"></a> to create a least one user in the service.</p>';
}

//Footer
$homePath = "index.php";
$secondaryPath = "pageGroupHome.php";
$secondaryPathName = "User Group Management";
include_once './template/_footer.php';

