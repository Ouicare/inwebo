<?php

//Loading of files
include_once 'resources/settings.php';
include_once 'resources/helpers.php';
require_once 'API/_api.php';
include_once 'resources/apiFunctions.php';

//Initializing main objects
$helpers = new helpers();
$apiFunctions = new apiFunctions($serviceId, $wsdlProvisioningPath, $wsdlAuthenticationPath, $certPath, $certPassphrase, $iwApiBaseUrl, $withErrorTrace, $withRESTResultTrace);

$errorOccured = '<p class="error">An error occured. '
        . 'You may check your configuration and activate traces in the "settings.php" file.</p>';
