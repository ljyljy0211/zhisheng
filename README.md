# 会员频道吱声SDK

[https://shenghuohao.yuque.com/vtztm0/asg3ce/fqaknx45vqi4gzvg?singleDoc#wFCXj](https://shenghuohao.yuque.com/vtztm0/asg3ce/fqaknx45vqi4gzvg?singleDoc#wFCXj "吱声会员频道自建erp的api文档")

## 安装

```shell
$ composer require yihaitao/zhisheng -vvv
```

## 使用

```php
<?php

use YiHaiTao\ZhiSheng\ZhiSheng;

$config = [
    'app_key' => 'your-key',
    'app_secret' => 'your-secret',
    'access_token' => 'your-access-token',
    'base_url' => 'https://service-api.shop.zhisheng.com/api/fmcg/erp',
];

// 实例化吱声sdk
$erp = new ZhiSheng($config);
// 使用如下
$erp->request('method', $params);

// 例子
$result = $erp->request('ju-hui-order-list', $params);
print_r($result);
```

## License

MIT
