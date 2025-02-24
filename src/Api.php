<?php

namespace YiHaiTao\ZhiSheng;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $appKey;

    private $appSecret;

    private $accessToken;

    private $baseUrl;

    public function __construct($appKey, $appSecret, $accessToken, $baseUrl)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->accessToken = $accessToken;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /*
     * 请求吱声会员api
     *
     * string $method 接口名,如ju-hui-order-list
     * array $data 业务参数
     */
    public function request(string $method, array $data = [])
    {
        $http = $this->getHttp();
        $commonParams = $this->getCommonParams();
        $params = $commonParams;
        $params['biz'] = json_encode($data);
        $params['sign'] = $this->signature($params);
        $fullUrl = $this->baseUrl.'/'.$method;
        $response = call_user_func_array([$http, 'post'], [$fullUrl, $params]);

        return json_decode($response->getBody(), true);
    }

    /*
     * 封装公共请求参数
     */
    private function getCommonParams()
    {
        return [
            'app_key' => $this->appKey,
            'timestamp' => time(),
            'charset' => 'utf-8',
            'version' => '1',
            'token' => $this->accessToken,
        ];
    }

    /*
     * 签名
     * array $params 签名参数
     */
    private function signature(array $data)
    {
        if ($data == null) {
            return null;
        }
        //签名步骤一：按字典序排序参数
        ksort($data);
        $resultStr = '';
        foreach ($data as $key => $val) {
            if ($key != null && $key != '' && $key != 'sign') {
                $resultStr = $resultStr.$key.$val;
            }
        }
        $resultStr = $this->appSecret.$resultStr.$this->appSecret;
        $resultStr = strtolower($resultStr);

        return md5($resultStr);
    }
}
