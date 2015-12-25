<?php 

//Main loading
include_once './_loader.php'; 

//HTML Header
include_once './template/_header.php';

//Main content output
print '<h1>inWebo API PHP Code Samples</h1>';
print '<ul>';
print '<li><a href="./pageAuthenticateSOAP.php">Authenticate with SOAP</a></li>';
print '<li><a href="./pageAuthenticateRest.php">Authenticate with REST</a></li>';
print '<li><a href="./pagePushAuthenticate.php">Authenticate with Mobile Notifications</a> (Push)</li>';
print '<li><a href="./pageLoginHome.php">Manage Users</a></li>';
print '<li><a href="./pageGroupHome.php">Manage Users in Groups</a></li>';
print '<li><a href="./pageSealVerify.php">Verify Data Sealing</a> (requires mAccess)</li>';
print '</ul>';

print '<a href="./testConfiguration.php">Test configuration</a>';

//HTML Footer
$homePath = "index.php";
include_once './template/_footer.php';