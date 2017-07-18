<?php

namespace WebWeave\StorjPHP;

use GuzzleHttp\Exception\RequestException;

class BridgeClient extends AbstractBridgeClient
{
    public function createUser($email, $password)
    {
        try {
            $this->BrigeClient->request('POST', '/users', [
                'json' => ['email' => $email, 'password' => hash('sha256', $password)]
            ]);
            return true;
        } catch (RequestException $e) {
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
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }

    public function getPublicKeys()
    {
        if ($this->isAuthSet('basic')) {
            try {
                $res = $this->BrigeClient->request('GET', '/keys', [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']]
                ]);
                return json_decode($res->getBody()->getContents());
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }

    public function destroyPublicKey($publicKey)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('DELETE', '/keys/'.$publicKey, [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']]
                ]);
                return true;
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }

    public function getBuckets()
    {
        if ($this->isAuthSet('basic')) {
            try {
                $res = $this->BrigeClient->request('GET', '/buckets', [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']]
                ]);
                return json_decode($res->getBody()->getContents());
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }

    public function createBucket($bucketInfo)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('POST', '/buckets', [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']],
                    'json' => $bucketInfo
                ]);
                return true;
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return $body;
            }
        }
    }


}