<?php

namespace TNQSoft\ServiceHandle\Exception;

class BaseApiException extends \Exception
{
    protected $url;
    protected $params;
    protected $method;

    public function __construct($message = null, $method='', $url='', $params=array())
    {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
        parent::__construct($message);
    }

    /**
     * Get the value of Url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param mixed url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of Params
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the value of Params
     *
     * @param mixed params
     *
     * @return self
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get the value of Method
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of Method
     *
     * @param mixed method
     *
     * @return self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

}
