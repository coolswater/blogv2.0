<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * 第三方登录
 * author: hexiaodong
 * Date: 2019/4/1
 */
class SnsUser extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user', 'user');
    }
    //第三方登录回调
    public function snsCallback(){
        $sns = getParam($this->input->get_post('s'),'string');
        switch ($sns){
            case 'weibo':
                $this->weiboCallBack();
                break;
            case 'weixin':
                $this->weixinCallBack();
                break;
            case 'git':
                $this->gitCallBack();
                break;
            case 'qq':
                $this->qqCallBack();
                break;
            default:
                PJsonMsg(0,'非法请求');
                break;
        }
    }
    //微信回调
    private function weiboCallBack(){
        $weiboConfig = config_item('weibo');
        $weibo = new Hexd\WeiboSDK($weiboConfig);
        $code = getParam($this->input->get_post('code'),'string');
        if (isset($_SESSION[$code])){
            $accessToken = $_SESSION[$code];
        }else{
            $accessToken = $_SESSION[$code] = $weibo->getAccessToken($code);
        }
        $userInfo = $weibo->getUserInfo($accessToken['access_token'],$accessToken['uid']);
        //获取数据入库，写入session
        if ($userInfo){
            $param = array(
                'username'          => 'wb_'.$userInfo['domain'],
                'password'          => md5('id'),
                'mobile'            => '',
                'email'             => '',
            );
            $this->user->trans_start();
            $userId = $this->user->addUser($param);
            $nick_name = isset($userInfo['name'])? $userInfo['name'] : $userInfo['screen_name'] ;
            $data = array(
                'user_id'           => $userId,
                'portrait'          => $userInfo['avatar_large'],
                'nick_name'         => $nick_name,
                'description'       => $userInfo['description'],
                'source'            => 'weibo',
                'source_user_id'    => $userInfo['idstr'],
                'home_page'         => $userInfo['url'],
            );
            $this->user->addUserInfo($data);
            $this->user->trans_complete();
            $_SESSION['userInfo'] = array(
                'id'        => $userId,
                'username'  => 'wb_'.$userInfo['domain'],
                'portrait'  => $userInfo['avatar_large'],
                'nickName'  => $nick_name
            );
            redirect('/');
            
        }
    }
    
}