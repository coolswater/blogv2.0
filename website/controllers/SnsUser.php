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
        //获取微信用户信息
        $userInfo = $this->getWeiboUser();
        //查询本地是否有已存在该用户，数据入库，写入session
        if (!$this->checkUser($userInfo)){
            $this->user->trans_start();
            $userId = $this->addUser($userInfo);      //插入t_users表
            $this->addUserInfo($userId,$userInfo);    //插入t_users_info表
            $this->user->trans_complete();
        }
        //写入session
        $username = empty($userInfo['domain']) ? $userInfo['idstr'] : $userInfo['domain'];
        $_SESSION['userInfo'] = array(
            'id'        => $userId,
            'username'  => 'wb_' . $username,
            'portrait'  => $userInfo['avatar_large'],
            'nickName'  => isset($userInfo['name'])? $userInfo['name'] : $userInfo['screen_name'],
        );
        
        redirect('/');
    }
    //获取微信用户信息
    private function getWeiboUser(){
        $weiboConfig = config_item('weibo');
        $weibo = new Hexd\WeiboSDK($weiboConfig);
        $code = getParam($this->input->get_post('code'),'string');
        
        if (isset($_SESSION[$code])){
            $accessToken = $_SESSION[$code];
        }else{
            $accessToken = $_SESSION[$code] = $weibo->getAccessToken($code);
        }
        $userInfo = $weibo->getUserInfo($accessToken['access_token'],$accessToken['uid']);
        
        return $userInfo;
    }
    //检测账户是否已存在
    private function checkUser($userInfo){
        $where = array(
            'source_user_id'    => $userInfo['idstr'],
            'source'            => 'weibo'
        );
        $existUser = $this->user->getUser($where);
        
        return $existUser;
    }
    //插入用户
    private function addUser($userInfo){
        $username = empty($userInfo['domain']) ? $userInfo['idstr'] : $userInfo['domain'];
        $param = array(
            'username'          => 'wb_'.$username,
            'password'          => md5($userInfo['idstr']),
            'mobile'            => '',
            'email'             => '',
        );
        
        return $this->user->addUser($param);
    }
    //插入用户信息表
    private function addUserInfo($userId,$userInfo){
        $data = array(
            'user_id'           => $userId,
            'portrait'          => $userInfo['avatar_large'],
            'nick_name'         => isset($userInfo['name'])? $userInfo['name'] : $userInfo['screen_name'],
            'description'       => $userInfo['description'],
            'source'            => 'weibo',
            'source_user_id'    => $userInfo['idstr'],
            'home_page'         => $userInfo['url'],
        );
        
        return $this->user->addUserInfo($data);
    }
    
}