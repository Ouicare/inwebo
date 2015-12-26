<?php

/**
 *
 * @author    Emmanuel NINET
 * @author Anis Marrouchi <anismarrouchi@hotmail.com>
 * @copyright 2014 inWebo Technologies
 * @package   InWebo PHP API
 * @license http://http://opensource.org/licenses/mit-license.php MIT
 */

namespace Ouicare\InWebo\API;

/**
 * loginsQueryByGroup class
 */
use Ouicare\InWebo\API\LoginsQueryByGroup;
/**
 * loginsQueryByGroupResponse class
 */
use Ouicare\InWebo\API\LoginsQueryByGroupResponse;
/**
 * LoginsQueryResult class
 */
use Ouicare\InWebo\API\LoginsQueryResult;
/**
 * loginsQuery class
 */
use Ouicare\InWebo\API\LoginsQuery;
/**
 * loginsQueryResponse class
 */
use Ouicare\InWebo\API\LoginsQueryResponse;
/**
 * loginSearch class
 */
use Ouicare\InWebo\API\LoginSearch;
/**
 * loginSearchResponse class
 */
use Ouicare\InWebo\API\LoginSearchResponse;
/**
 * LoginSearchResult class
 */
use Ouicare\InWebo\API\LoginSearchResult;
/**
 * loginQuery class
 */
use Ouicare\InWebo\API\LoginQuery;
/**
 * loginQueryResponse class
 */
use Ouicare\InWebo\API\LoginQueryResponse;
/**
 * LoginQueryResult class
 */
use Ouicare\InWebo\API\LoginQueryResult;
/**
 * loginCreate class
 */
use Ouicare\InWebo\API\LoginCreate;
/**
 * loginCreateResponse class
 */
use Ouicare\InWebo\API\LoginCreateResponse;
/**
 * LoginCreateResult class
 */
use Ouicare\InWebo\API\LoginCreateResult;
/**
 * loginGetCodeFromLink class
 */
use Ouicare\InWebo\API\LoginGetCodeFromLink;
/**
 * loginGetCodeFromLinkResponse class
 */
use Ouicare\InWebo\API\LoginGetCodeFromLinkResponse;
/**
 * loginGetInfoFromLink class
 */
use Ouicare\InWebo\API\LoginGetInfoFromLink;
/**
 * loginGetInfoFromLinkResponse class
 */
use Ouicare\InWebo\API\LoginGetCodeFromLinkResponse;
/**
 * loginUpdate class
 */
use Ouicare\InWebo\API\LoginUpdate;
/**
 * loginUpdateResponse class
 */
use Ouicare\InWebo\API\LoginUpdateResponse;
/**
 * loginRestore class
 */
use Ouicare\InWebo\API\LoginRestore;
/**
 * loginRestoreResponse class
 */
use Ouicare\InWebo\API\LoginRestoreResponse;
/**
 * loginResetPwd class
 */
use Ouicare\InWebo\API\LoginResetPwd;
/**
 * loginResetPwdResponse class
 */
use Ouicare\InWebo\API\LoginResetPwdResponse;
/**
 * loginResetPwdExtended class
 */
use Ouicare\InWebo\API\LoginResetPwdExtended;
/**
 * loginResetPwdExtendedResponse class
 */
use Ouicare\InWebo\API\LoginResetPwdExtendedResponse;
/**
 * loginAddDevice class
 */
use Ouicare\InWebo\API\LoginAddDevice;
/**
 * loginAddDeviceResponse class
 */
use Ouicare\InWebo\API\LoginAddDeviceResponse;
/**
 * loginDeleteTool class
 */
use Ouicare\InWebo\API\LoginDeleteTool;
/**
 * loginDeleteToolResponse class
 */
use Ouicare\InWebo\API\LoginDeleteToolResponse;
/**
 * loginDelete class
 */
use Ouicare\InWebo\API\LoginDeletel;
/**
 * loginDeleteResponse class
 */
use Ouicare\InWebo\API\LoginDeleteResponse;
/**
 * loginSendByMail class
 */
use Ouicare\InWebo\API\LoginSendByMail;
/**
 * loginSendByMailResponse class
 */
use Ouicare\InWebo\API\LoginSendByMailResponse;
/**
 * loginActivateCode class
 */
use Ouicare\InWebo\API\LoginActivateCode;
/**
 * loginActivateCodeResponse class
 */
use Ouicare\InWebo\API\LoginActivateCodeResponse;
/**
 * loginResetPINErrorCounter class
 */
use Ouicare\InWebo\API\LoginResetPINErrorCounter;
/**
 * loginResetPINErrorCounterResponse class
 */
use Ouicare\InWebo\API\LoginResetPINErrorCounterResponse;
/**
 * IWDS_check class
 */
use Ouicare\InWebo\API\IWDSCheck;
/**
 * IWDS_checkResponse class
 */
use Ouicare\InWebo\API\IWDSCheckResponse;
/**
 * serviceGroupsQuery class
 */
use Ouicare\InWebo\API\ServiceGroupsQuery;
/**
 * serviceGroupsQueryResponse class
 */
use Ouicare\InWebo\API\ServiceGroupsQueryResponse;
/**
 * ServiceGroupsQueryResult class
 */
use Ouicare\InWebo\API\ServiceGroupsQueryResult;
/**
 * groupAccountQuery class
 */
use Ouicare\InWebo\API\GroupAccountQuery;
/**
 * groupAccountQueryResponse class
 */
use Ouicare\InWebo\API\GroupAccountQueryResponse;
/**
 * GroupAccountQueryResult class
 */
use Ouicare\InWebo\API\GroupAccountQueryResult;
/**
 * groupAccountCreate class
 */
use Ouicare\InWebo\API\GroupAccountCreate;
/**
 * groupAccountCreateResponse class
 */
use Ouicare\InWebo\API\GroupAccountCreateResponse;
/**
 * groupAccountUpdate class
 */
use Ouicare\InWebo\API\GroupAccountUpdate;
/**
 * groupAccountUpdateResponse class
 */
use Ouicare\InWebo\API\GroupAccountUpdateResponse;
/**
 * groupAccountDelete class
 */
use Ouicare\InWebo\API\GroupAccountDelete;
/**
 * groupAccountDeleteResponse class
 */
use Ouicare\InWebo\API\GroupAccountDeleteResponse;
/**
 * loginGetGroups class
 */
use Ouicare\InWebo\API\LoginGetGroups;
/**
 * loginGetGroupsResponse class
 */
use Ouicare\InWebo\API\LoginGetGroupsResponse;
/**
 * LoginGetGroupsResult class
 */
use LoginGetGroupsResult;

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
    public function loginsQueryByGroup(LoginsQueryByGroup $parameters) {
        return $this->__call('loginsQueryByGroup', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginsQuery(LoginsQuery $parameters) {
        return $this->__call('loginsQuery', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginSearch(LoginSearch $parameters) {
        return $this->__call('loginSearch', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginQuery(LoginQuery $parameters) {
        return $this->__call('loginQuery', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginCreate(LoginCreate $parameters) {
        return $this->__call('loginCreate', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginGetCodeFromLink(LoginGetCodeFromLink $parameters) {
        return $this->__call('loginGetCodeFromLink', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginGetInfoFromLink(LoginGetInfoFromLink $parameters) {
        return $this->__call('loginGetInfoFromLink', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginUpdate(LoginUpdate $parameters) {
        return $this->__call('loginUpdate', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginRestore(LoginRestore $parameters) {
        return $this->__call('loginRestore', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginResetPwd(LoginResetPwd $parameters) {
        return $this->__call('loginResetPwd', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginResetPwdExtended(LoginResetPwdExtended $parameters) {
        return $this->__call('loginResetPwdExtended', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginAddDevice(LoginAddDevice $parameters) {
        return $this->__call('loginAddDevice', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginDeleteTool(LoginDeleteTool $parameters) {
        return $this->__call('loginDeleteTool', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginDelete(LoginDelete $parameters) {
        return $this->__call('loginDelete', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginSendByMail(LoginSendByMail $parameters) {
        return $this->__call('loginSendByMail', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginActivateCode(LoginActivateCode $parameters) {
        return $this->__call('loginActivateCode', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginResetPINErrorCounter(LoginResetPINErrorCounter $parameters) {
        return $this->__call('loginResetPINErrorCounter', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function IWDS_check(IWDSCheck $parameters) {
        return $this->__call('IWDS_check', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function serviceGroupsQuery(ServiceGroupsQuery $parameters) {
        return $this->__call('serviceGroupsQuery', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function groupAccountQuery(GroupAccountQuery $parameters) {
        return $this->__call('groupAccountQuery', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function groupAccountCreate(GroupAccountCreate $parameters) {
        return $this->__call('groupAccountCreate', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function groupAccountUpdate(GroupAccountUpdate $parameters) {
        return $this->__call('groupAccountUpdate', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function groupAccountDelete(GroupAccountDelete $parameters) {
        return $this->__call('groupAccountDelete', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
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
    public function loginGetGroups(LoginGetGroups $parameters) {
        return $this->__call('loginGetGroups', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
                    'uri' => 'http://console.inwebo.com',
                    'soapaction' => ''
                        )
        );
    }

}
