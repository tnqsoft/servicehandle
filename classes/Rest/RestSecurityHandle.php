<?php

namespace TNQSoft\ServiceHandle\Rest;

class RestSecurityHandle
{
    const TYPE_HTTP = 'HTTP';
    const TYPE_WSSE = 'WSSE';

    private $username;
    private $password;
    private $type;

    public function __construct($type, $username, $password)
    {
        $this->type = $type;
        $this->username = $username;
        $this->password = $password;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function createWsseHeader()
    {
        // create random nonce
        $nonce = md5(rand(), false);
        $b64nonce = base64_encode($nonce);
        // create UNIX Timestamp
        $created = time();
        // create digest
        $digest = base64_encode(sha1($nonce.$created.$this->password, true));
        // echo header data
        return sprintf('x-wsse: UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $this->username,
            $digest,
            $b64nonce,
            $created
        );
    }
}
