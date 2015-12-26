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
 * Authenticate class
 */
use Ouicare\InWebo\API\Authenticate;
/**
 * AuthenticateResponse class
 */
use Ouicare\InWebo\API\AuthenticateResponse;
/**
 * AuthenticateWithIp class
 */
use Ouicare\InWebo\API\AuthenticateWithIp;
/**
 * AuthenticateWithIpResponse class
 */
use Ouicare\InWebo\API\AuthenticateWithIpResponse;

class Authentication extends \SoapClient {

    public function Authentication($wsdl = "Authentication.wsdl", $options = array()) {
        parent::__construct($wsdl, $options);
    }

    /**
     *
     *
     * @param Authenticate $parameters
     * @return AuthenticateResponse
     */
    public function Authenticate(Authenticate $parameters) {
        return $this->__call('Authenticate', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
                    'uri' => 'http://service.inwebo.com',
                    'soapaction' => ''
                        )
        );
    }

    /**
     *
     *
     * @param AuthenticateWithIp $parameters
     * @return AuthenticateWithIpResponse
     */
    public function AuthenticateWithIp(AuthenticateWithIp $parameters) {
        return $this->__call('AuthenticateWithIp', array(
                    new \SoapParam($parameters, 'parameters')
                        ), array(
                    'uri' => 'http://service.inwebo.com',
                    'soapaction' => ''
                        )
        );
    }

}
