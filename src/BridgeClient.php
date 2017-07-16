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

    public function addPublicKey($PublicKey)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('POST', '/keys', [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']],
                    'json' => ['key' => $PublicKey]
                ]);
                return true;
            } catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }

    private function isAuthSet($method)
    {
        switch ($method) {
            case 'basic':
                if (empty($this->basicAuth)) {
                    throw new \Exception('Please set basic authentication first');
                }
                break;
            default:
                throw new \Exception('Not a valid valid');
                break;
        }

        return true;
    }

}