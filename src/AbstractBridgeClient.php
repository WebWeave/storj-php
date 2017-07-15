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
     * AbstractBridgeClient constructor.
     * @param $API_URL
     */

    public function __construct($API_URL)
    {
        $this->BrigeClient = new Client();
    }

}