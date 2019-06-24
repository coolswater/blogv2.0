<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * QQ第三登录
 * author: hexiaodong
 * Date: 2019/4/15
 */
class QQ extends MY_Controller{
    private static $appid;
    private static $appkey;
    private static $callbackUrl;
    private static $qqOAuth;
    
    public function __construct() {
        parent::__construct();
        $config = config_item('qq');
        self::$appid =$config['appid'];
        self::$appkey =$config['appkey'];
        self::$callbackUrl =$config['callbackUrl'];
        self::$qqOAuth = new \Yurun\OAuthLogin\QQ\OAuth2(self::$appid, self::$appkey, self::$callbackUrl);
    }
    //用户登录
    public function login(){
        $url = self::$qqOAuth->getAuthUrl();
        $_SESSION['QQ_state'] = self::$qqOAuth->state;
        header('location:' . $url);
    }
    public function qqCallback(){
        // 获取accessToken
        $accessToken = self::$qqOAuth->getAccessToken($_SESSION['QQ_state']);
        var_dump($accessToken);
        // 调用过getAccessToken方法后也可这么获取
        // $accessToken = $qqOAuth->accessToken;
        // 这是getAccessToken的api请求返回结果
        // $result = $qqOAuth->result;
        
        // 用户资料
                $userInfo = self::$qqOAuth->getUserInfo();
        
        // 这是getAccessToken的api请求返回结果
        // $result = $qqOAuth->result;
        
        // 用户唯一标识
                $openid = self::$qqOAuth->openid;
                var_dump($userInfo);
                var_dump($openid);
    }
}