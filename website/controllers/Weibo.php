<?php

use Hexd\WeiboSDK;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * 对接新浪weibo
 * author: hexiaodong
 * Date: 2019/4/3
 */
class Weibo extends MY_Controller{
    private static $weibo;
    public function __construct() {
        parent::__construct();
        $weiboConfig = config_item('weibo');
        self::$weibo =new Hexd\Weibo($weiboConfig);
    }
    //获取登录地址
    public function getLoginURL(){
        $loginUrl = self::$weibo->getAuthorizeUrl();
        PJsonMsg(1,'请求成功',$loginUrl);
    }

    //发布微博
    public function publish(){
        $summary = getParam($this->input->post('summary'), 'string');
        $thumb = getParam($this->input->post('thumb'), 'string');
        $result = self::$weibo->publishWeibo($accessToken['access_token'],$summary,base_url().$thumb);
        var_dump($result);die;
        if ($result){
            PJsonMsg(1,'发布成功！');
        }else{
            PJsonMsg(0,'发布失败!');
        }
    }

    //微信回调
    public function callback(){
        //获取微信用户信息
        $wexinUserInfo = $this->getWeiboUser();
        $nickName = isset($wexinUserInfo['name'])? $wexinUserInfo['name'] : $wexinUserInfo['screen_name'];
        //查询本地是否有已存在该用户，不存在，则入库
        $userInfo = $this->checkUser($wexinUserInfo);
        if (!$userInfo){
            //开启事务
            $this->user->trans_start();
            $userId = $this->addUser($wexinUserInfo);       //插入t_users表,返回用户id
            $this->addUserInfo($userId,$wexinUserInfo);     //插入t_users_info表
            $this->user->trans_complete();
            //结束事务
        }
        //写入session
        $_SESSION['userInfo'] = array(
            'id'        => $userId,
            'nickName'  => $nickName,
            'username'  => 'wb_'. $wexinUserInfo['idstr'],
            'portrait'  => $wexinUserInfo['avatar_large'],
        );;
        
        redirect('/');
    }
    //获取微信用户信息
    private function getWeiboUser(){
        $code = getParam($this->input->get_post('code'),'string');
        
        if (isset($_SESSION[$code])){
            $accessToken = $_SESSION[$code];
        }else{
            $accessToken = $_SESSION[$code] = self::$weibo->getAccessToken($code);
        }
        $userInfo = self::$weibo->getUserInfo($accessToken['access_token'],$accessToken['uid']);
        
        return $userInfo;
    }
    
    //插入用户
    private function addUser($wexinUserInfo){
        $param = array(
            'mobile'            => '',
            'email'             => '',
            'username'          => 'wb_'. $wexinUserInfo['idstr'],
            'password'          => md5($wexinUserInfo['idstr']),
        );
        return $this->user->addUser($param);
    }
    //插入用户信息表
    private function addUserInfo($userId,$wexinUserInfo){
        $nickName = isset($wexinUserInfo['name'])? $wexinUserInfo['name'] : $wexinUserInfo['screen_name'];
        $data = array(
            'source'            => 'weibo',
            'user_id'           => $userId,
            'nick_name'         => $nickName,
            'home_page'         => $wexinUserInfo['url'],
            'source_user_id'    => $wexinUserInfo['idstr'],
            'description'       => $wexinUserInfo['description'],
            'portrait'          => $wexinUserInfo['avatar_large'],
        );
        
        return $this->user->addUserInfo($data);
    }
    
    //检测账户是否已存在
    private function checkUser($wexinUserInfo){
        $where = array(
            'source'            => 'weibo',
            'source_user_id'    => $wexinUserInfo['idstr'],
        );
        $existUser = $this->user->getUser($where);
        
        return $existUser;
    }
    
}