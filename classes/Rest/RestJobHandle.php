<?php

namespace TNQSoft\ServiceHandle\Rest;

class RestJobHandle
{
    protected $listCall;

    public function addJob($id, RestHandle $api)
    {
        $this->listCall[$id] = $api->getCurl();
    }

    public function executeList()
    {
        $result = array();

        $oCurlMulti = curl_multi_init();
        foreach ($this->listCall as $id => $api) {
            curl_multi_add_handle($oCurlMulti, $api);
        }

        $running = null;
        do {
            curl_multi_exec($oCurlMulti, $running);
        } while ($running > 0);

        // get content and remove handles
        foreach ($this->listCall as $id => $api) {
            $info = curl_getinfo($api);
            $response = curl_multi_getcontent($api);
            $result[$id] = new RestResponse($info, $response);
            curl_multi_remove_handle($oCurlMulti, $api);
        }

        curl_multi_close($oCurlMulti);

        return $result;
    }
}
