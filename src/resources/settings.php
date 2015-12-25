<?php

//inWebo Service ID (as displayed in the inWebo Administration Console)
$serviceId = 982; // Put your Service ID here
//inWebo API certificate
$certFile = "ouicare-tn.crt"; // Specify here the name of your certificate file.
$certPassphrase = "ouicare"; // This is the passphrase of your certificate file
//Activate traces
$withErrorTrace = true; //Display errors
$withRESTResultTrace = true; //Display REST call results
//DO NOT MODIFY SETTINGS BELOW
//Path to the certificate file
$certPath = __DIR__ . "API/" . $certFile;

//inWebo API URL
$iwApiBaseUrl = 'https://api.myinwebo.com'; // DO NOT MODIFY
//inWebo WSDL files
$wsdlProvisioningFile = "Provisioning.wsdl";
$wsdlProvisioningPath = __DIR__ . "API/" . $wsdlProvisioningFile;

$wsdlAuthenticationFile = "Authentication.wsdl";
$wsdlAuthenticationPath = __DIR__ . "API/" . $wsdlAuthenticationFile;
