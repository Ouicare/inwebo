<?php
print
'<form name="loginCreate" action="pageLoginCreate.php" method="POST">'
. 'Login: <input name="login" type="text" placeholder="Enter user login..."><br/>'
. 'First name: <input name="loginFirstname" type="text" placeholder="Enter user firstname..."><br/>'
. 'Last name: <input name="loginName" type="text" placeholder="Enter user name..."><br/>'
. 'Email address: <input name="loginEmail" type="text" placeholder="Enter user email address..."><br/>'
. 'Activation code: <select name="loginActivationType"><option value="0">Immediate code (15 minutes)</option><option value="2">3 week code</option></select><br/>'
. '<input type="submit" value="Create">'
. '</form>';

