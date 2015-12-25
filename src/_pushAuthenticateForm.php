<?php
print
'<form name="authentication" action="pagePushAuthenticate.php" method="POST">'
. '<input name="login" type="text" placeholder="Enter login..." value="' . $login . '" /><br/>'
. '<input id="sendPush" type="submit" value="Send notification" />'
. '</form>';