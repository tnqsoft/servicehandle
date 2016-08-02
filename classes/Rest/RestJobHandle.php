<?php

namespace TNQSoft\ServiceHandle\Rest;

use TNQSoft\ServiceHandle\Exception\ProcessException;
use TNQSoft\ServiceHandle\Exception\TimeoutException;

class RestJobHandle
{
    protected $listCall;

    public function addJob($id, RestHandle $restHandle)
    {
        $this->listCall[$id] = $restHandle;
    }

    public function start()
    {
        defined('CURLE_OPERATION_TIMEDOUT') || define('CURLE_OPERATION_TIMEDOUT', CURLE_OPERATION_TIMEOUTED);

        $result = array();
        $errors = array();

        $oCurlMulti = curl_multi_init();
        foreach ($this->listCall as $id => $restHandle) {
            curl_multi_add_handle($oCurlMulti, $restHandle->getCurl());
        }

        // Start performing the request
        $running = null;
        do {
            curl_multi_select($oCurlMulti);
            curl_multi_exec($oCurlMulti, $running);
            while (!($info_array = curl_multi_info_read($oCurlMulti)) === false) {
                if ($info_array['msg'] === CURLMSG_DONE) {
                    foreach ($this->listCall as $id => $restHandle) {
                        if ($restHandle->getCurl() === $info_array['handle'] && $info_array['result'] !== 0) {
                            $errors[$id] = $info_array['result'];
                            break;
                        }
                    }
                }
            }
        } while ($running > 0);

        // get content and remove handles
        foreach ($this->listCall as $id => $restHandle) {
            $info = curl_getinfo($restHandle->getCurl());
            $response = curl_multi_getcontent($restHandle->getCurl());
            $result[$id] = new RestResponse($info, $response);
            if (isset($errors[$id])) {
                $params = 'params: '.json_encode($restHandle->getParams()).';';
                $params .= 'raw: '.json_encode($restHandle->getRaw()).';';
                $params .= 'files: '.json_encode($restHandle->getFiles());
                if ($errors[$id] === CURLE_OPERATION_TIMEDOUT) {
                    $result[$id]->setError(new TimeoutException('Operation timeout', $restHandle->getMethod(), $restHandle->getUrl(), $params));
                } else {
                    $result[$id]->setError(new ProcessException(curl_errno($restHandle->getCurl()), $restHandle->getMethod(), $restHandle->getUrl(), $params));
                }
            }
            curl_multi_remove_handle($oCurlMulti, $restHandle->getCurl());
        }

        curl_multi_close($oCurlMulti);

        return $result;
    }
}
