<?php

namespace WebWeave\StorjPHP;

use GuzzleHttp\Exception\RequestException;


class BridgeClient extends AbstractBridgeClient
{

    /**
    *
    * Create a new user in Storj Bridge.
    *
    * @param array $email user email
    * @param array $password user password
    * @return boolean
    */

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

    /**
    *
    * Add an ECDSA public key.
    *
    * @param string $PublicKey ECDSA public key
    * @return boolean
    */    

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

    /**
    *
    * Lists the ECDSA public keys associated with the user.
    *
    * @return string
    */    

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

    /**
    *
    * Delete ECDSA public key associated with user account.
    *
    * @param string $PublicKey ECDSA public key which you want to delete
    * @return boolean
    */    

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

    /**
    *
    * List all of the buckets belonging to the user.
    *
    * @return string
    */

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

    /**
    *
    * Create storage bucket.
    *
    * @param array $bucketInfo bucket metadata
    * @return boolean
    */

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

    /**
    *
    * Delete a file from storage bucket.
    *
    * @param string $bucketID bucket unique identifier
    * @return boolean
    */


    public function removeFile($bucketID, $fileID)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('DELETE', '/buckets/'.$bucketID.'/files/'.$fileID, [
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


    /**
    *
    * Destroy a storage bucket.
    *
    * @param string $bucketID bucket unique identifier
    * @return boolean
    */

    public function removeBucket($bucketID)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('DELETE', '/buckets/'.$bucketID, [
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

    /**
    *
    * Get list of established and available mirrors associated with a file.
    *
    * @param string $bucketID bucket unique identifier
    * @param string $fileID file unique identifier
    * @return string
    */

    public function getFileMirrors($bucketID, $fileID)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $res = $this->BrigeClient->request('GET', '/buckets/'.$bucketID.'/files/'.$fileID.'/mirrors/', [
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

    /**
    *
    * Get details about farmer node.
    *
    * @param string $farmerNodeID farmer node unique identifier
    * @return string
    */

    public function getFarmerNodeDetails($farmerNodeID)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $res = $this->BrigeClient->request('GET', '/contacts/'.$farmerNodeID, [
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

    /**
    *
    * Creates a file staging frame.
    *
    * @return string file staging frame
    */

    public function createFrame()
    {
        if ($this->isAuthSet('basic')) {
            try {
                $res = $this->BrigeClient->request('POST', '/frames', [
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

    /**
    *
    * Destroys the file staging frame by it's unique ID.
    *
    * @param string $frameID frame unique identifier
    * @return boolean
    */

    public function deleteFrame($frameID)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('DELETE', '/frames/'.$frameID, [
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

    /**
    *
    * Activate user.
    *
    * @param string $activationToken unique user activation token
    * @return boolean
    */

    public function activateUser($activationToken)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('GET', '/activations/'.$activationToken, [
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

    /**
    *
    * Creates a token for the specified operation.
    *
    * @param string $bucketID bucket unique identifier
    * @param string $operation operation (PUSH or PULL)
    * @return boolean
    */

    public function createToken($bucketID, $operation)
    {
        if ($this->isAuthSet('basic')) {
            try {
                $this->BrigeClient->request('GET', '/buckets/'.$bucketID.'/tokens', [
                    'auth' => [$this->basicAuth['username'], $this->basicAuth['password']],
                    'json' => array('operation' => $operation)
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
