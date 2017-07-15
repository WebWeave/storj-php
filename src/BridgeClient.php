<?php

namespace WebWeave\StorjPHP;

class BridgeClient extends AbstractBridgeClient
{
    public function createUser($email, $password)
    {
        try {
            $this->BrigeClient->request('POST', '/users', [
                'json' => ['email' => $email, 'password' => hash('sha256', $password)]
            ]);
            return true;
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $body = $response->getBody()->getContents();
            return $body;
        }
    }

}