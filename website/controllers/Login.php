<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 登录控制器
 * author: hexiaodong
 * Date: 2018/8/10
 */
class Login extends MY_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user', 'user');
    }
    
    //用户登录
    public function login() {
        $username = getParam($this->input->post('username'), 'string');
        $password = getParam($this->input->post('password'), 'string');
        $verifyCode = getParam($this->input->post('verifyCode'), 'string');
        //验证验证码
        if (isset($_SESSION['verifyCode']) && (md5(strtoupper($verifyCode)) === $_SESSION['verifyCode'])) {
            //获取用户信息
            $userInfo = $this->user->getUserByUsername($username);
            if ($userInfo) {
                $encrpt = substr($userInfo['password'], -6);
                if (md5(md5($password) . $encrpt) . $encrpt !== $userInfo['password']) {
                    PJsonMsg(REQUEST_ERROR, lang('password_error'));
                } else {
                    $_SESSION['userInfo'] = $userInfo;
                    PJsonMsg(REQUEST_SUCCESS, lang('login_success'));
                }
            } else {
                PJsonMsg(REQUEST_ERROR, lang('username_noExist'));
            }
        } else {
            PJsonMsg(REQUEST_ERROR, lang('verifyCode_error'));
        }
        
    }
    //用户注册
    //用户退出
    //获取验证码
    public function getVerifyCode() {
        verifyCode(100, 32);
    }
}