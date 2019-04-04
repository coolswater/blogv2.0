<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * 对接Github
 * author: hexiaodong
 * Date: 2019/4/3
 */
class Github extends MY_Controller{
    public function __construct() {
        parent::__construct();
    }
    //github回调
    public function callback(){
        $githubUser = $this->getGithubUser();   //获取微信用户信息
        if ($githubUser){
            $userInfo = $this->checkUser($githubUser);
            if (!$userInfo){
                $this->user->trans_start();
                $userId = $this->addUser($githubUser);  //插入t_users表
                $this->addUserInfo($githubUser);        //插入t_users_info表
                $this->user->trans_complete();
                
            }
            //写入session
            $_SESSION['userInfo'] = array(
                'id'        => $userId,
                'nickName'  => $githubUser['name'],
                'username'  => 'github_'.$githubUser['login'],
                'portrait'  => $githubUser['avatar_large'],
            );;
        }else{
            write_log('logs/github.log',json_encode($githubUser));
        }
        
        redirect('/');
    }
    
    //获取github用户信息
    private function getGithubUser(){
        $code = getParam($this->input->get_post('code'),'string');
        $config = config_item('github');
        $github = new Hexd\GitHub($config);
        if (isset($_SESSION[$code])){
            $accessToken = $_SESSION[$code];
        }else{
            $accessToken = $_SESSION[$code] = $github->getAccessToken($code);
        }
        $userInfo = json_decode($github->getUserInfo($accessToken['access_token']),TRUE);
        
        return $userInfo;
    }
    
    
    //插入用户
    private function addUser($githubUser){
        $param = array(
            'mobile'            => '',
            'email'             => $githubUser['email'],
            'username'          => 'github_'.$githubUser['login'],
            'password'          => md5($githubUser['id']),
        );
        
        return $this->user->addUser($param);
    }
    //插入用户信息表
    private function addUserInfo($userId,$githubUser){
        $data = array(
            'source'            => 'github',
            'user_id'           => $userId,
            'nick_name'         => $githubUser['name'],
            'home_page'         => $githubUser['blog'],
            'source_user_id'    => $githubUser['id'],
            'description'       => '',
            'portrait'          => $githubUser['avatar_url'],
        );
        
        return $this->user->addUserInfo($data);
    }
    
    //检测账户是否已存在
    private function checkUser($githubUser){
        //验证是否已存在，github用户
        $where = array(
            'source'            => 'github',
            'source_user_id'    => $githubUser['id'],
        );
        $userInfo = $this->user->getUser($where);
        
        return $userInfo;
    }
    
}