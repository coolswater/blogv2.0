<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//微博开发平台配置
$config['weibo'] = array(
    'client_id'         => '103340070',
    'client_secret'     => 'ae2e90484b1f65a3099e5f6f0a34998d',
    'redirect_uri'      => 'https://www.hexiaodong.com/wbCallback',
);

//github配置
$config['github'] = array(
    'client_id'     => 'bbb01e36067881427e96',
    'client_secret' => '07670309fee2b4c509855df8a373f42fbb3270a2',
    'callback'      => 'https://www.hexiaodong.com/gitCallback',
    'app_name'      => 'coding程序员'
);
//QQ配置
$config['qq'] = array(
    'appid'         => '101546289',
    'appkey'        => '097eaacef2fe75073403d32c312cc826',
    'callbackUrl'   => 'https://www.hexiaodong.com/qqCallback',
);