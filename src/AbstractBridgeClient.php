<?php

namespace WebWeave\StorjPHP;

use GuzzleHttp\Client;

abstract class AbstractBridgeClient
{
    /**
     *
     * @var API_URL
     */

    protected $API_URL = '';

    /**
     * @var $BrigeClient
     */
    protected $BrigeClient;

    /**
     * @var $basicAuth
     */
    protected $basicAuth;

    /**
     * AbstractBridgeClient constructor.
     * @param $API_URL
     */

    public function __construct($API_URL)
    {
        $this->API_URL = $API_URL;

        $this->BrigeClient = new Client(['base_uri' => $this->API_URL]);
    }

    public function setBasicAuth($email, $password)
    {
        $this->basicAuth = array(
            'username' => $email,
            'password' => hash('sha256', $password)
        );
    }

    protected function isAuthSet($method)
    {
        switch ($method) {
            case 'basic':
                if (empty($this->basicAuth)) {
                    throw new \Exception('Please set basic authentication first');
                }
                break;
            default:
                throw new \Exception('Not a valid authentication method');
                break;
        }

        return true;
    }

}