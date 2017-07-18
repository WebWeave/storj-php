# Storj PHP Package | In heavy development

 Implementation of the Storj protocol for PHP

WARNING
===============

This piece of software is provided without warranty of any kind, use it at your own risk.

TODO AND DONE
===============
- [x] Create users
- [x] Basic authentication
- [x] Generate ecdsa and add them
- [x] List and delete ecdsa keys
- [x] List and create buckets
- [ ] Ecdsa authentication
- [ ] File upload
- [ ] File download

REQUIREMENTS
===============

*php 5.6.0* or newer.

*php-gmp* needs to be installed.

USAGE
===============

**Installation**

Best way is to use composer
```
  //since its still in development add it to your composer.json
  "require": {
    "webweave/storj-php": "dev-master"
  }
```

**Basic Code examples**

Create a new user
```PHP
<?php

use WebWeave\StorjPHP\BridgeClient;

// Create client for interacting with API
$client = new BridgeClient('https://api.storj.io');
// Create user
$client->createUser($email, $password);
```
Add a new ecdsa public key to a account
```PHP
<?php

use WebWeave\StorjPHP\BridgeClient;
use WebWeave\StorjPHP\KeyPair;

// Create client for interacting with API
$client = new BridgeClient('https://api.storj.io');
// Login
$client->setBasicAuth($email, $password);

// Generate a new keypair
$keyPair = new KeyPair();

// Add it to the account
$client->addPublicKey($keyPair->getPublicKey());
```

Add a new bucket, and list all buckets
```PHP
<?php

use WebWeave\StorjPHP\BridgeClient;

// Create client for interacting with API
$client = new BridgeClient('https://api.storj.io');
// Login
$client->setBasicAuth($email, $password);

//BucketInfo
$bucketInfo = array('name' => 'bucket_name');

// Add a new bucket
$client->createBucket($bucketInfo);

// Get all buckets
$buckets = $client->getBuckets();

//List all buckets
foreach($buckets as $bucket) {
    echo $bucket->name . PHP_EOL;
    echo $bucket->status . PHP_EOL;
}
```
