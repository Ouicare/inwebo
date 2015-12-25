<?php
/**
 * Provisioning class file
 * 
 * @author    Emmanuel NINET
 * @copyright 2014 inWebo Technologies
 * @package   PHP API Samples
 */

namespace API;

/**
 * loginsQueryByGroup class
 */
require_once './API/loginsQueryByGroup.php';
/**
 * loginsQueryByGroupResponse class
 */
require_once './API/loginsQueryByGroupResponse.php';
/**
 * LoginsQueryResult class
 */
require_once './API/LoginsQueryResult.php';
/**
 * loginsQuery class
 */
require_once './API/loginsQuery.php';
/**
 * loginsQueryResponse class
 */
require_once './API/loginsQueryResponse.php';
/**
 * loginSearch class
 */
require_once './API/loginSearch.php';
/**
 * loginSearchResponse class
 */
require_once './API/loginSearchResponse.php';
/**
 * LoginSearchResult class
 */
require_once './API/LoginSearchResult.php';
/**
 * loginQuery class
 */
require_once './API/loginQuery.php';
/**
 * loginQueryResponse class
 */
require_once './API/loginQueryResponse.php';
/**
 * LoginQueryResult class
 */
require_once './API/LoginQueryResult.php';
/**
 * loginCreate class
 */
require_once './API/loginCreate.php';
/**
 * loginCreateResponse class
 */
require_once './API/loginCreateResponse.php';
/**
 * LoginCreateResult class
 */
require_once './API/LoginCreateResult.php';
/**
 * loginGetCodeFromLink class
 */
require_once './API/loginGetCodeFromLink.php';
/**
 * loginGetCodeFromLinkResponse class
 */
require_once './API/loginGetCodeFromLinkResponse.php';
/**
 * loginGetInfoFromLink class
 */
require_once './API/loginGetInfoFromLink.php';
/**
 * loginGetInfoFromLinkResponse class
 */
require_once './API/loginGetCodeFromLinkResponse.php';
/**
 * loginUpdate class
 */
require_once './API/loginUpdate.php';
/**
 * loginUpdateResponse class
 */
require_once './API/loginUpdateResponse.php';
/**
 * loginRestore class
 */
require_once './API/loginRestore.php';
/**
 * loginRestoreResponse class
 */
require_once './API/loginRestoreResponse.php';
/**
 * loginResetPwd class
 */
require_once './API/loginResetPwd.php';
/**
 * loginResetPwdResponse class
 */
require_once './API/loginResetPwdResponse.php';
/**
 * loginResetPwdExtended class
 */
require_once './API/loginResetPwdExtended.php';
/**
 * loginResetPwdExtendedResponse class
 */
require_once './API/loginResetPwdExtendedResponse.php';
/**
 * loginAddDevice class
 */
require_once './API/loginAddDevice.php';
/**
 * loginAddDeviceResponse class
 */
require_once './API/loginAddDeviceResponse.php';
/**
 * loginDeleteTool class
 */
require_once './API/loginDeleteTool.php';
/**
 * loginDeleteToolResponse class
 */
require_once './API/loginDeleteToolResponse.php';
/**
 * loginDelete class
 */
require_once './API/loginDelete.php';
/**
 * loginDeleteResponse class
 */
require_once './API/loginDeleteResponse.php';
/**
 * loginSendByMail class
 */
require_once './API/loginSendByMail.php';
/**
 * loginSendByMailResponse class
 */
require_once './API/loginSendByMailResponse.php';
/**
 * loginActivateCode class
 */
require_once './API/loginActivateCode.php';
/**
 * loginActivateCodeResponse class
 */
require_once './API/loginActivateCodeResponse.php';
/**
 * loginResetPINErrorCounter class
 */
require_once './API/loginResetPINErrorCounter.php';
/**
 * loginResetPINErrorCounterResponse class
 */
require_once './API/loginResetPINErrorCounterResponse.php';
/**
 * IWDS_check class
 */
require_once './API/IWDS_check.php';
/**
 * IWDS_checkResponse class
 */
require_once './API/IWDS_checkResponse.php';
/**
 * serviceGroupsQuery class
 */
require_once './API/serviceGroupsQuery.php';
/**
 * serviceGroupsQueryResponse class
 */
require_once './API/serviceGroupsQueryResponse.php';
/**
 * ServiceGroupsQueryResult class
 */
require_once './API/ServiceGroupsQueryResult.php';
/**
 * groupAccountQuery class
 */
require_once './API/groupAccountQuery.php';
/**
 * groupAccountQueryResponse class
 */
require_once './API/groupAccountQueryResponse.php';
/**
 * GroupAccountQueryResult class
 */
require_once './API/GroupAccountQueryResult.php';
/**
 * groupAccountCreate class
 */
require_once './API/groupAccountCreate.php';
/**
 * groupAccountCreateResponse class
 */
require_once './API/groupAccountCreateResponse.php';
/**
 * groupAccountUpdate class
 */
require_once './API/groupAccountUpdate.php';
/**
 * groupAccountUpdateResponse class
 */
require_once './API/groupAccountUpdateResponse.php';
/**
 * groupAccountDelete class
 */
require_once './API/groupAccountDelete.php';
/**
 * groupAccountDeleteResponse class
 */
require_once './API/groupAccountDeleteResponse.php';
/**
 * loginGetGroups class
 */
require_once './API/loginGetGroups.php';
/**
 * loginGetGroupsResponse class
 */
require_once './API/loginGetGroupsResponse.php';
/**
 * LoginGetGroupsResult class
 */
require_once './API/LoginGetGroupsResult.php';

class Provisioning extends \SoapClient {

  public function Provisioning($wsdl = "Provisioning.wsdl", $options = array()) {
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param loginsQueryByGroup $parameters
   * @return loginsQueryByGroupResponse
   */
  public function loginsQueryByGroup(loginsQueryByGroup $parameters) {
    return $this->__call('loginsQueryByGroup', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginsQuery $parameters
   * @return loginsQueryResponse
   */
  public function loginsQuery(loginsQuery $parameters) {
    return $this->__call('loginsQuery', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginSearch $parameters
   * @return loginSearchResponse
   */
  public function loginSearch(loginSearch $parameters) {
    return $this->__call('loginSearch', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginQuery $parameters
   * @return loginQueryResponse
   */
  public function loginQuery(loginQuery $parameters) {
    return $this->__call('loginQuery', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginCreate $parameters
   * @return loginCreateResponse
   */
  public function loginCreate(loginCreate $parameters) {
    return $this->__call('loginCreate', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }
  
  /**
   *  
   *
   * @param loginGetCodeFromLink $parameters
   * @return loginGetCodeFromLinkResponse
   */
  public function loginGetCodeFromLink(loginGetCodeFromLink $parameters) {
    return $this->__call('loginGetCodeFromLink', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }
  
  /**
   *  
   *
   * @param loginGetCodeFromLink $parameters
   * @return loginGetCodeFromLinkResponse
   */
  public function loginGetInfoFromLink(loginGetInfoFromLink $parameters) {
    return $this->__call('loginGetInfoFromLink', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginUpdate $parameters
   * @return loginUpdateResponse
   */
  public function loginUpdate(loginUpdate $parameters) {
    return $this->__call('loginUpdate', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginRestore $parameters
   * @return loginRestoreResponse
   */
  public function loginRestore(loginRestore $parameters) {
    return $this->__call('loginRestore', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginResetPwd $parameters
   * @return loginResetPwdResponse
   */
  public function loginResetPwd(loginResetPwd $parameters) {
    return $this->__call('loginResetPwd', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginResetPwdExtended $parameters
   * @return loginResetPwdExtendedResponse
   */
  public function loginResetPwdExtended(loginResetPwdExtended $parameters) {
    return $this->__call('loginResetPwdExtended', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginAddDevice $parameters
   * @return loginAddDeviceResponse
   */
  public function loginAddDevice(loginAddDevice $parameters) {
    return $this->__call('loginAddDevice', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginDeleteTool $parameters
   * @return loginDeleteToolResponse
   */
  public function loginDeleteTool(loginDeleteTool $parameters) {
    return $this->__call('loginDeleteTool', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginDelete $parameters
   * @return loginDeleteResponse
   */
  public function loginDelete(loginDelete $parameters) {
    return $this->__call('loginDelete', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginSendByMail $parameters
   * @return loginSendByMailResponse
   */
  public function loginSendByMail(loginSendByMail $parameters) {
    return $this->__call('loginSendByMail', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginActivateCode $parameters
   * @return loginActivateCodeResponse
   */
  public function loginActivateCode(loginActivateCode $parameters) {
    return $this->__call('loginActivateCode', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginResetPINErrorCounter $parameters
   * @return loginResetPINErrorCounterResponse
   */
  public function loginResetPINErrorCounter(loginResetPINErrorCounter $parameters) {
    return $this->__call('loginResetPINErrorCounter', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param IWDS_check $parameters
   * @return IWDS_checkResponse
   */
  public function IWDS_check(IWDS_check $parameters) {
    return $this->__call('IWDS_check', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param serviceGroupsQuery $parameters
   * @return serviceGroupsQueryResponse
   */
  public function serviceGroupsQuery(serviceGroupsQuery $parameters) {
    return $this->__call('serviceGroupsQuery', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param groupAccountQuery $parameters
   * @return groupAccountQueryResponse
   */
  public function groupAccountQuery(groupAccountQuery $parameters) {
    return $this->__call('groupAccountQuery', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param groupAccountCreate $parameters
   * @return groupAccountCreateResponse
   */
  public function groupAccountCreate(groupAccountCreate $parameters) {
    return $this->__call('groupAccountCreate', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param groupAccountUpdate $parameters
   * @return groupAccountUpdateResponse
   */
  public function groupAccountUpdate(groupAccountUpdate $parameters) {
    return $this->__call('groupAccountUpdate', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param groupAccountDelete $parameters
   * @return groupAccountDeleteResponse
   */
  public function groupAccountDelete(groupAccountDelete $parameters) {
    return $this->__call('groupAccountDelete', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param loginGetGroups $parameters
   * @return loginGetGroupsResponse
   */
  public function loginGetGroups(loginGetGroups $parameters) {
    return $this->__call('loginGetGroups', array(
            new \SoapParam($parameters, 'parameters')
      ),
      array(
            'uri' => 'http://console.inwebo.com',
            'soapaction' => ''
           )
      );
  }
}