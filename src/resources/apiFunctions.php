<?php
//Functions to handle API Requests (SOAP or REST)
class apiFunctions {
    
    public $uid;
    public $serviceId;
    public $apiCertificate;
    public $apiCertificatePassphrase;
    public $authentication;
    public $provisioning;
    public $iwApiBaseUrl;
    public $withErrorTrace;
    public $withRESTResultTrace;
    
    public function __construct($serviceId, $wsdlProvisioningPath, $wsdlAuthenticationPath, $certPath, $certPassphrase, $iwApiBaseUrl, $withErrorTrace, $withRESTResultTrace) {
        $this->uid = 0;
        $this->serviceId = $serviceId;
        $this->apiCertificate = $certPath;
        $this->apiCertificatePassphrase = $certPassphrase;
        $this->authentication = new API\Authentication($wsdlAuthenticationPath, 
                array('local_cert' => $this->apiCertificate, 'passphrase' => $this->apiCertificatePassphrase));
        $this->provisioning = new API\Provisioning($wsdlProvisioningPath, 
                array('local_cert' => $this->apiCertificate, 'passphrase' => $this->apiCertificatePassphrase));
        $this->iwApiBaseUrl = $iwApiBaseUrl;
        $this->withErrorTrace = $withErrorTrace;
        $this->withRESTResultTrace = $withRESTResultTrace;
    }
    
    private function printError($error) {
        //if error traces are activated
        if (true === $this->withErrorTrace) {
            var_dump($error);
        }
    }
    
    private function printResult($title, $result) {
        //if traces of REST calls are activated
        if (true === $this->withRESTResultTrace) {
            print '<p>' . $title . '</p>';
            var_dump($result);
        }
    }

    /*
     *  AUTHENTICATION
     */
    
    //Authentication in SOAP
    function Authenticate($login, $otp) {
        try {
            $x=new API\authenticate;
            
            $x->userId = $login;
            $x->serviceId = $this->serviceId;
            $x->token = $otp;
            
            $resp = $this->authentication->authenticate($x);
            $res = $resp->authenticateReturn;        

        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
		$this->printError($res);
        return $res;
    }
    
    //Authentication in REST
    public function AuthenticateREST($login, $code) {

        $authUrl = $this->iwApiBaseUrl . "/FS?action=authenticateExtended&"
                . "serviceId=". $this->serviceId . "&"
                . "userId=" . $login . "&"
                . "token=" . $code . "&"
                . "format=json";

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $authUrl,
            CURLOPT_SSLCERT => $this->apiCertificate ,
            CURLOPT_SSLCERTPASSWD => $this->apiCertificatePassphrase
        );

        curl_setopt_array($ch , $options);

        $output = curl_exec($ch);
        $request_info = curl_getinfo($ch); //Récupération des infos sur la requête CURL

        if (!$output)    {
            $this->printError($request_info);
            return "NOK";
        } else {
            $result = json_decode($output, true);
            $this->printResult('REST authenticate:', $result);
            return $result['err'];
        }
    }
    
    //Send a push authentication request
    public function pushAuthenticate($login) {
        
        $pushUrl = $this->iwApiBaseUrl . "/FS?action=pushAuthenticate&"
                . "serviceId=". $this->serviceId . "&"
                . "userId=" . $login . "&"
                . "format=json";

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $pushUrl,
            CURLOPT_SSLCERT => $this->apiCertificate ,
            CURLOPT_SSLCERTPASSWD => $this->apiCertificatePassphrase
        );

        curl_setopt_array($ch , $options);

        $output = curl_exec($ch);
        $request_info = curl_getinfo($ch); //Récupération des infos sur la requête CURL

        if (!$output)    {
            $this->printError($request_info);
            return "NOK";
        } else {
            $result = json_decode($output, true);
            $this->printResult('Push authenticate result:', $result);
            return $result;
        }
    }
    
    //Check push authentication result
    public function checkPushResult($login, $sessionId) {
        
        $checkUrl = $this->iwApiBaseUrl . "/FS?action=checkPushResult&"
                . "serviceId=". $this->serviceId . "&"
                . "userId=" . $login . "&"
                . "sessionId=" . $sessionId . "&"
                . "format=json";

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $checkUrl,
            CURLOPT_SSLCERT => $this->apiCertificate ,
            CURLOPT_SSLCERTPASSWD => $this->apiCertificatePassphrase
        );

        curl_setopt_array($ch , $options);

        $output = curl_exec($ch);
        $request_info = curl_getinfo($ch); //Récupération des infos sur la requête CURL

        if (!$output)    {
            $this->printError($request_info);
            return "NOK";
        } else {
            $result = json_decode($output, true);
            $this->printResult('Check push result:', $result);
            return $result;
        }
    }

    /*
     * USER MANAGEMENT
     */
    
    //Get service users
    public function loginsQuery($offset = 0, $nmax = 0, $sort = 0) {
        try { 
            $x = new API\loginsQuery;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;

            $x->offset = $offset;
            $x->nmax = $nmax;
            $x->sort = $sort;
            
            $resp = $this->provisioning->loginsQuery($x);
            $res = $resp->loginsQueryReturn;
        
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
		$this->printError($res);
		return $res;
        
    }
    
    //Get a user by its login ID
    public function loginQuery($loginId) {
        
        try { 
            $x = new API\loginQuery;
            $x->userid = $this->uid;
            $x->loginid = $loginId;
            
            $resp = $this->provisioning->loginQuery($x);
            $res = $resp->loginQueryReturn;
        
        } catch (\Exception $error) {   
            $this->printError($error);
            return "NOK";
        }
		$this->printError($res);        
        return $res;
    }
    
    //Create a new user
    public function loginCreate($login) {   
        
        try { 
            $x = new API\loginCreate;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;
            
            $x->login = $login->login; //mandatory
            $x->firstname = $login->firstname; //optional
            $x->name = $login->name; //optional
            $x->mail = $login->mail; //optional, but required if codetype = 2 
            $x->phone = ''; //optional
            $x->status = 0; //user is not locked. If status=1, authentication requests for this user will be rejected
            $x->role = 0; //user has a user role. 0: user, 1: manager, 2: administrator
            $x->access = 1;
            $x->codetype = (int) $login->codetype; // 0, 1 or 2
            $x->lang = 'en'; // fr or en
            $x->extrafields = json_encode(array(), JSON_FORCE_OBJECT);
            
            $resp = $this->provisioning->loginCreate($x);
            $res = $resp->loginCreateReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;   
    }
    
    //get activation code from 3 week long code
    public function loginGetCodeFromLink($longcode) {
        try { 
            $x = new API\loginGetCodeFromLink;
            $x->code = $longcode;
            
            $resp = $this->provisioning->loginGetCodeFromLink($x);
            $res = $resp->loginGetCodeFromLinkReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;  
    }
    
    //get activation info from 3 week long code
    public function loginGetInfoFromLink($longcode) {
        try { 
            $x = new API\loginGetInfoFromLink;
            $x->code = $longcode;
            
            $resp = $this->provisioning->loginGetInfoFromLink($x);
            $res = $resp->loginGetInfoFromLinkReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;  
    }
    
    //Update user properties
    public function loginUpdate ($login) {
        try { 
            $x = new API\loginUpdate;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;
            
            $x->loginid = $login->loginId;
            $x->login = $login->login;
            $x->firstname = $login->firstname;
            $x->name = $login->name;
            $x->mail = $login->mail;

            $x->phone = '';
            $x->status = 0; //login is not blocked
            $x->role = 0; //login has a user role
            $x->extrafields = json_encode(array(), JSON_FORCE_OBJECT);
            
            $resp = $this->provisioning->loginUpdate($x);
            $res = $resp->loginUpdateReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
        
    }
    
    //Delete a user
    public function loginDelete($loginId) {
        try { 
            $x = new API\loginDelete;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;
            
            $x->loginid=$loginId;
            
            $resp = $this->provisioning->loginDelete($x);
            $res = $resp->loginDeleteReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    /* USER SEARCH */
    
    //Login search
    public function loginSearch($loginName, $exactmatch, $offset = 0, $maxperpage = 10, $sort = 0) {
        try { 
            $x = new API\loginSearch;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;
            
            $x->loginname = $loginName;
            $x->exactmatch = $exactmatch;
            $x->offset = $offset;
            $x->nmax = $maxperpage;
            $x->sort = $sort;
            
            $resp = $this->provisioning->loginSearch($x);
            $res = $resp->loginSearchReturn;
        
        } catch (\Exception $error) {
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
        
    /* GROUP MEMBERSHIP MANAGEMENT */
    
    //Get service user groups
    public function serviceGroupsQuery($offset = 0, $nmax = 0) {
        try {
            $x = new API\serviceGroupsQuery;
            $x->userid = $this->uid;
            $x->serviceid = $this->serviceId;
            
            $x->offset = $offset;
            $x->nmax = $nmax;
            
            $resp = $this->provisioning->serviceGroupsQuery($x);
            $res = $resp->serviceGroupsQueryReturn;
            
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    //Get users in a group
    public function loginsQueryByGroup($groupid, $offset = 0, $maxperpage = 10, $sort = 0) {
        try { 
            $x = new API\loginsQueryByGroup;
            $x->userid = $this->uid;
            
            $x->groupid=$groupid;
            $x->offset=$offset;
            $x->nmax=$maxperpage;
            $x->sort=$sort;
            
            $resp = $this->provisioning->loginsQueryByGroup($x);
            $res = $resp->loginsQueryByGroupReturn;
        
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    public function groupMembershipCreate($groupMembership) {
        try {
            $x = new API\groupAccountCreate;
            $x->userid = $this->uid;
            
            $x->groupid = $groupMembership->groupId;
            $x->loginid = $groupMembership->loginId;
            $x->role = $groupMembership->roleId;
            
            $resp = $this->provisioning->groupAccountCreate($x);
            $res = $resp->groupAccountCreateReturn;
            
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    //Modifier un utilisateur dans un groupe
    public function groupMembershipUpdate($groupMembership) {
        try {
            $x = new API\groupAccountUpdate;
            $x->userid = $this->uid;
            
            
            $x->groupid = $groupMembership->groupId;
            $x->loginid = $groupMembership->loginId;
            $x->role = $groupMembership->roleId;
            
            $resp = $this->provisioning->groupAccountUpdate($x);
            $res = $resp->groupAccountUpdateReturn;
            
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    //Supprimer un utilisateur dans un groupe
    public function groupMembershipDelete($groupMembership) {
        try {
            $x = new API\groupAccountDelete;
            $x->userid = $this->uid;
            
            
            $x->groupid = $groupMembership->groupId;
            $x->loginid = $groupMembership->loginId;
            
            $resp = $this->provisioning->groupAccountDelete($x);
            $res = $resp->groupAccountDeleteReturn;
            
        } catch (\Exception $error) {    
            $this->printError($error);
            return "NOK";
        }
        $this->printError($res);
        return $res;
    }
    
    /* DATA SEALING */
    
    //Data Sealing verification in REST
    public function sealVerify($login, $code, $data) {

        $sealUrl = $this->iwApiBaseUrl . "/FS?action=sealVerify&"
                . "serviceId=". $this->serviceId . "&"
                . "userId=" . $login . "&"
                . "token=" . $code . "&"
                . "data=" . $data . "&"
                . "format=json";

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $sealUrl,
            CURLOPT_SSLCERT => $this->apiCertificate ,
            CURLOPT_SSLCERTPASSWD => $this->apiCertificatePassphrase
        );

        curl_setopt_array($ch , $options);

        $output = curl_exec($ch);
        $request_info = curl_getinfo($ch); //Récupération des infos sur la requête CURL

        if (!$output)    {
            $this->printError($request_info);
            return "NOK";
        } else {
            $result = json_decode($output, true);
            $this->printResult('Seal verify result:', $result);
            return $result['err'];
        }
    }
}