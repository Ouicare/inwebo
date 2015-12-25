<?php
print
'<form name="loginUpdate" action="pageLoginUpdate.php" method="POST">'
. '<input name="login" type="text" placeholder="Enter user login..." value="' . $login->login . '"><br/>'
. '<input name="loginFirstname" type="text" placeholder="Enter user firstname..." value="' . $login->firstname . '"><br/>'
. '<input name="loginName" type="text" placeholder="Enter user name..." value="' . $login->name . '"><br/>'
. '<input name="loginEmail" type="text" placeholder="Enter user email address..." value="' . $login->mail . '"><br/>'
. '<input name="loginId" type="hidden" value="' . $loginId . '">'
. '<input name="loginCode" type="hidden" value="' . $loginCode . '">'
. '<input type="submit" value="Update">'
. '</form>';

