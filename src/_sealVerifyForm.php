<?php
print
'<form name="authentication" action="pageSealVerify.php" method="POST">'
. '<input name="login" type="text" placeholder="Enter login..." /><br/>'
. '<input name="code" type="text" placeholder="Enter OTP..." /><br/>'
. '<input name="data" type="text" placeholder="Enter Data to verify..." /><br/>'
. '<input type="submit" value="Verify" />'
. '</form>';
