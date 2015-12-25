<?php
print
'<form name="authentication" action="' . $action . '" method="POST">'
. '<input name="login" type="text" placeholder="Enter login..." /><br/>'
. '<input name="code" type="text" placeholder="Enter OTP..." /><br/>'
. '<input type="submit" value="Log on" />'
. '</form>';
