# SERVICE HANDLE

Service Rest and Soap Handle for PHP

## Current version 1.0.0

## Setup
### Composer
```json
"tnqsoft/serviceHandle": "dev-master"
```

## Usage
### GET
```php
use TNQSoft\ServiceHandle\Rest\RestHandle;
use TNQSoft\ServiceHandle\Exception\TimeoutException;
...
try {
    $test = new RestHandle(RestHandle::METHOD_GET, 'https://google.com');
    $response = $test->request();
    var_dump($response->getHeader());
    var_dump($response->getResponse());
    var_dump($response->getInfo());
} catch(TimeoutException $e) {
    echo $e->getMessage()."<br/>";
    echo $e->getMethod()."<br/>";
    echo $e->getUrl()."<br/>";
    echo $e->getParams();
}
```

## Author

Nguyen Nhu Tuan
* [http://i-designer.net/](http://i-designer.net/)
* [https://github.com/tuanquynh0508](https://github.com/tuanquynh0508)

## License

Copyright (c) 2016 Nguyen Nhu Tuan

ResponsiveTest is licensed under the MIT license.
