<?php

namespace YiHaiTao\ZhiSheng;

use Hanson\Foundation\Foundation;

class ZhiSheng extends Foundation
{
    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    public function request($method, $params)
    {
        $api = new Api($this->config['app_key'], $this->config['app_secret'], $this->config['token'], $this->config['base_url']);

        return $api->request($method, $params);
    }
}
