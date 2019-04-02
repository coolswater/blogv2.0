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
        $wexinUserInfo = $this->getWeiboUser();
        $username = empty($wexinUserInfo['domain']) ? $wexinUserInfo['idstr'] : $wexinUserInfo['domain'];
        $nickName = isset($wexinUserInfo['name'])? $wexinUserInfo['name'] : $wexinUserInfo['screen_name'];
        //查询本地是否有已存在该用户，不存在，则入库
        $where = array(
            'source'            => 'weibo',
            'source_user_id'    => $wexinUserInfo['idstr'],
        );
        $userInfo = $this->checkUser($where);
        if (!$userInfo){
            $this->user->trans_start();
            $param = array(
                'mobile'            => '',
                'email'             => '',
                'username'          => 'wb_'.$username,
                'password'          => md5($wexinUserInfo['idstr']),
            );
            //插入t_users表,返回用户id
            $userId = $this->addUser($param);
            $data = array(
                'source'            => 'weibo',
                'user_id'           => $userId,
                'nick_name'         => $nickName,
                'home_page'         => $wexinUserInfo['url'],
                'source_user_id'    => $wexinUserInfo['idstr'],
                'description'       => $wexinUserInfo['description'],
                'portrait'          => $wexinUserInfo['avatar_large'],
            );
            //插入t_users_info表
            $this->addUserInfo($data);
            $this->user->trans_complete();
    
            $userInfo = array(
                'id'        => $userId,
                'nickName'  => $nickName,
                'username'  => 'wb_' . $username,
                'portrait'  => $wexinUserInfo['avatar_large'],
            );
        //存在的话，更新用户数据
        }else{
            $data = array(
                'nick_name'     => $nickName,
                'home_page'     => $wexinUserInfo['url'],
                'description'   => $wexinUserInfo['description'],
                'portrait'      => $wexinUserInfo['avatar_large'],
            );
            $where = array(
                'source_user_id' => $wexinUserInfo['idstr']
            );
            $this->user->modify($data, $where);
        }
        
        //写入session
        $_SESSION['userInfo'] = $userInfo;
        
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
    
    //插入用户
    private function addUser($data){
        return $this->user->addUser($data);
    }
    //插入用户信息表
    private function addUserInfo($data){
        return $this->user->addUserInfo($data);
    }
    
    //检测账户是否已存在
    private function checkUser($where){
        $existUser = $this->user->getUser($where);
        
        return $existUser;
    }
}