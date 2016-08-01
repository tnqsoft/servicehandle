<?php

namespace TNQSoft\ServiceHandle\Rest;

class RestResponse
{
    protected $info;
    protected $header;
    protected $response;

    public function __construct($info, $response)
    {
        $this->setInfo($info);
        $this->setResponse($response);
    }

    /**
     * Get the value of Info.
     *
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set the value of Info.
     *
     * @param mixed info
     *
     * @return self
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get the value of Header.
     *
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Get the value of Response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the value of Response.
     *
     * @param mixed response
     *
     * @return self
     */
    public function setResponse($response)
    {
        $parts = explode("\r\n\r\nHTTP/", $response);
        $parts = (count($parts) > 1 ? 'HTTP/' : '').array_pop($parts);
        list($headers, $body) = explode("\r\n\r\n", $parts, 2);

        $this->response = $body;

        $headers = explode("\n", $headers);
        for ($i = 1; $i < count($headers); ++$i) {
            if (preg_match('/^([_\-a-zA-Z0-9]+\:\s)(.*)$/', $headers[$i], $part)) {
                $key = trim(str_replace(':', '', $part[1]));
                $value = trim($part[2]);
                $this->header[$key] = $value;
            }
        }

        return $this;
    }
}
