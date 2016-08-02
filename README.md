# SERVICE HANDLE

Service Rest and Soap Handle for PHP

## Current version 1.0.0

## Setup
### Composer
```json
"tnqsoft/serviceHandle": "dev-master"
```

## Usage
### SINGLE REST REQUEST
```php
use TNQSoft\ServiceHandle\Rest\RestJobHandle;
use TNQSoft\ServiceHandle\Rest\RestHandle;
use TNQSoft\ServiceHandle\Rest\RestSecurityHandle;
use TNQSoft\ServiceHandle\Exception\TimeoutException;
...
$params = array(
    'name' => 'Nguyen Nhu Tuan',
    'age' => 33,
    'email' => 'tuanquynh0508@gmail.com'
);
$file = array(
    'file' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img1.png'),
);
$files = array(
    'files[0]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img2.png'),
    'files[1]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img3.png'),
    'files[2]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img4.png'),
    'files[3]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img5.png'),
);

//GET
//Test Get
$testGet = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/data/account.json');
$responseTestGet = $testGet->request();

//Test Get HTTP Authentication Basic
$securityGetAuth = new RestSecurityHandle(RestSecurityHandle::TYPE_HTTP, 'admin', '123456');
$testGetAuth = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/http_auth/test.json');
$testGetAuth->setSecurity($securityGetAuth);
$responseTestGetAuth = $testGetAuth->request();

//Test Get Timeout
$testGetTimeout = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/timeout.php');
$testGetTimeout->setTimeout(1);
$responseTestGetTimeout = $testGetTimeout->request();

//Test Get Header
$testGetHeader = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/header.php');
$responseTestGetHeader = $testGetHeader->request();

//Test Get Cookie
$testGetCookie = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/cookie.php', array(), array(), array(), array(), array('cookie_var1' => 'xxxx', 'cookie_var2' => 'yyyyyy'));
$responseTestGetCookie = $testGetCookie->request();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//POST
//Test POST
$testPost = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post.php', $params);
$responseTestPost = $testPost->request();

//Test POST RAW
$testPostRaw = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_raw.php', array(), $params);
$responseTestPostRaw = $testPostRaw->request();

//Test POST UPLOAD
$testPostUpload = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_upload.php', $params, array(), $file);
$responseTestPostUpload = $testPostUpload->request();

//Test POST MULTI UPLOAD
$testPostMultiUpload = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_multi_upload.php', $params, array(), $files);
$responseTestPostMultiUpload = $testPostMultiUpload->request();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PUT
//Test PUT
$testPut = new RestHandle(RestHandle::METHOD_PUT, 'http://php.lab/curl/put.php', array(), $params);
$responseTestPut = $testPut->request();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DELETE
//Test DELETE
$testDelete = new RestHandle(RestHandle::METHOD_DELETE, 'http://php.lab/curl/delete.php?id=1');
$responseTestDelete = $testDelete->request();
```

### MULTI REST REQUEST
```php
$cookies = array(
    'cookie_var1' => 'xxxx',
    'cookie_var2' => 'yyyyyy'
);
$params = array(
    'name' => 'Nguyen Nhu Tuan',
    'age' => 33,
    'email' => 'tuanquynh0508@gmail.com'
);
$file = array(
    'file' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img1.png'),
);
$files = array(
    'files[0]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img2.png'),
    'files[1]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img3.png'),
    'files[2]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img4.png'),
    'files[3]' => realpath(__DIR__.'/../../../vendor/tnqsoft/serviceHandle/tests/mock/data/img5.png'),
);

$job = new RestJobHandle();

//GET
//Test Get
$testGet = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/data/account.json');
$job->addJob('GET', $testGet);

//Test Get HTTP Authentication Basic
$securityGetAuth = new RestSecurityHandle(RestSecurityHandle::TYPE_HTTP, 'admin', '123456');
$testGetAuth = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/http_auth/test.json');
$testGetAuth->setSecurity($securityGetAuth);
$job->addJob('GET_HTTP_AUTH', $testGetAuth);

//Test Get Timeout
$testGetTimeout = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/timeout.php');
$testGetTimeout->setTimeout(1);
$job->addJob('GET_TIMEOUT', $testGetTimeout);

//Test Get Header
$testGetHeader = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/header.php');
$job->addJob('GET_HEADER', $testGetHeader);

//Test Get Cookie
$testGetCookie = new RestHandle(RestHandle::METHOD_GET, 'http://php.lab/curl/cookie.php', array(), array(), array(), array(), $cookies);
$job->addJob('GET_COOKIE', $testGetCookie);

//POST
//Test POST
$testPost = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post.php', $params);
$job->addJob('POST', $testPost);

//Test POST RAW
$testPostRaw = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_raw.php', array(), $params);
$job->addJob('POST_RAW', $testPost);

//Test POST UPLOAD
$testPostUpload = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_upload.php', $params, array(), $file);
$job->addJob('POST_UPLOAD', $testPostUpload);

//Test POST MULTI UPLOAD
$testPostMultiUpload = new RestHandle(RestHandle::METHOD_POST, 'http://php.lab/curl/post_multi_upload.php', $params, array(), $files);
$job->addJob('POST_UPLOAD_MULTI', $testPostMultiUpload);

//PUT
//Test PUT
$testPut = new RestHandle(RestHandle::METHOD_PUT, 'http://php.lab/curl/put.php', array(), $params);
$job->addJob('PUT', $testPut);

//DELETE
//Test DELETE
$testDelete = new RestHandle(RestHandle::METHOD_DELETE, 'http://php.lab/curl/delete.php?id=1');
$job->addJob('DELETE', $testDelete);

$responseMulti = $job->start();

foreach ($responseMulti as $key => $response) {
    //RestResponse $response
}
```

### PARSE REST RESPONSE
```php
$response->getInfo();
$response->getHeader();
$response->getResponse();

$error = $response->getError();
if(null !== $error) {
    $error->getMessage();
    $error->getMethod();
    $error->getUrl();
    $error->getParams();
}
```

## Author

Nguyen Nhu Tuan
* [http://i-designer.net/](http://i-designer.net/)
* [https://github.com/tuanquynh0508](https://github.com/tuanquynh0508)

## License

Copyright (c) 2016 Nguyen Nhu Tuan

ResponsiveTest is licensed under the MIT license.
