<?php
print
'<form name="loginDelete" action="pageLoginDelete.php" method="POST">'
. '<input name="loginId" type="hidden" value="' . $loginId . '" />'
. '<input name="login" type="hidden" value="' . $login . '" />'
. '<input type="submit" value="Confirm delete user ' . $login . '" />'
. '<input type="button" value="Cancel" onclick="javascript:document.location.href=\'pageLoginHome.php\'" />'
. '</form>';