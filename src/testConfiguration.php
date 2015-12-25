<?php 

//Main loading
include_once './_loader.php'; 

//HTML Header
include_once './template/_header.php';

//Main content output
print '<h1>inWebo API PHP Configuration</h1>';

$errorConf = false;
if ($serviceId == '') { $errorSid = "> inWebo service ID is missing<br/>"; $errorConf = true; } else { $successSid = '> inWebo service ID is ' . $serviceId . '<br/>'; }
if ($certFile == '') { $errorCert = "> inWebo certificate file name is undefined<br/>"; $errorConf = true;  } else { $successCert = '> inWebo certificate file name is defined: ' . $certFile . '<br/>'; }
if (!file_exists ($certPath)) { $errorCertFile = "> inWebo certificate file is missing<br/>"; $errorConf = true;  } else { $successCertFile = '> inWebo certificate file exists<br/>'; }

if ($errorConf === false) {
    print '<p>Your configuration seems OK so far...</p>';
    print $successSid;
    print $successCert;
    print $successCertFile;
} else {
    print '<p>Your configuration seems uncompleted:</p>';
    if ($serviceId != '') { print $successSid; } else { print '<span class="red">' . $errorSid . '</span>'; }
    if ($certFile != '') { print $successCert; } else { print '<span class="red">' . $errorCert . '</span>'; }
    if (file_exists ($certPath)) { print $successCertFile; } else { print '<span class="red">' . $errorCertFile . '</span>'; }
}

//HTML Footer
$homePath = "index.php";
include_once './template/_footer.php';