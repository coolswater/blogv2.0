<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 用户控制器
 * author: hexiaodong
 * Date: 2018/8/10
 */
class User extends MY_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user', 'user');
    }
    
    //用户中心
    public function profile() {
        //用户信息
        $userInfo = $this->userInfo;
        if (!$userInfo) {
            redirect(base_url('/'));
        }
        //获取栏目列表
        $categoryList = $this->getCategoryList();
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        $this->load->view('home/header', compact('userInfo', 'categoryList', 'friendLink'));
        $this->load->view('home/profile');
        $this->load->view('home/footer');
    }
    
    //用户登录
    public function login() {
        $username = getParam($this->input->post('username'), 'string');
        $password = getParam($this->input->post('password'), 'string');
        $verifyCode = getParam($this->input->post('verifyCode'), 'string');
        if (empty($username) || !$this->verifyUsername($username)) {
            PJsonMsg(REQUEST_ERROR, lang('username_'));
        }
        //验证验证码
        if (isset($_SESSION['verifyCode']) && (md5(strtoupper($verifyCode)) === $_SESSION['verifyCode'])) {
            //获取用户信息
            $userInfo = $this->user->getUserByUsername($username);
            if ($userInfo) {
                $encrpt = substr($userInfo['password'], -6);
                if (md5(md5($password) . $encrpt) . $encrpt !== $userInfo['password']) {
                    PJsonMsg(REQUEST_ERROR, lang('password_error'));
                } else {
                    unset($userInfo['password']);
                    $_SESSION['userInfo'] = $userInfo;
                    PJsonMsg(REQUEST_SUCCESS, lang('login_success'), $userInfo);
                }
            } else {
                PJsonMsg(REQUEST_ERROR, lang('username_noExist'));
            }
        } else {
            PJsonMsg(REQUEST_ERROR, lang('verifyCode_error'));
        }
        
    }
    
    //用户注册
    public function register() {
        $username = getParam($this->input->post('username'), 'string');
        $password = getParam($this->input->post('password'), 'string');
        $confirmPassword = getParam($this->input->post('confirmPassword'), 'string');
        $email = getParam($this->input->post('email'), 'string');
        $verifyCode = getParam($this->input->post('verifyCode'), 'string');
        //验证参数
        if (empty($username) || !$this->verifyUsername($username)) {
            PJsonMsg(REQUEST_ERROR, lang('username_invalid'));
        }
        if (empty($password) || !$this->verifyPassword($password)) {
            PJsonMsg(REQUEST_ERROR, lang('password_invalid'));
        }
        if ($confirmPassword !== $password) {
            PJsonMsg(REQUEST_ERROR, lang('confirmPassword_invalid'));
        }
        if (!$this->verifyEmail($email)) {
            PJsonMsg(REQUEST_ERROR, lang('email_invalid'));
        }
        if (!$this->verifyCode($verifyCode)) {
            PJsonMsg(REQUEST_ERROR, lang('verifyCode_error'));
        }
        //检测用户名是否存在
        if ($this->checkUsername($username)) {
            PJsonMsg(REQUEST_ERROR, lang('username_isExist'));
        }
        if ($this->checkEmail($email)) {
            PJsonMsg(REQUEST_ERROR, lang('email_isExist'));
        }
        $param = compact('username', 'password', 'email');
        
        $result = $this->user->addUser($param);
        if ($result) {
            PJsonMsg(REQUEST_SUCCESS, lang('register_success'));
        } else {
            PJsonMsg(REQUEST_ERROR, lang('server_error'));
        }
    }
    
    //忘记密码
    public function forgetPwd() {
        $email = $this->input->post('email', 'string');
        $verifyCode = $this->input->post('verifyCode', 'string');
        if ($this->verifyCode($verifyCode)) {
            if (empty($email) || !validEmail($email)) {
                PJsonMsg(REQUEST_ERROR, lang('error_invalid'));
            }
            $userInfo = $this->user->getUserByEmail($email);
            if ($userInfo) {
                $to = 'hexiaodong@forex.com.cn';
                $subject = '重置密码';
                $message = '罗老师您好';
                $result = $this->sendEmail($to, $subject, $message);
                if ($result) {
                    PJsonMsg(REQUEST_SUCCESS, lang('sendEmail_success'));
                } else {
                    PJsonMsg(REQUEST_ERROR, lang('sendEmail_error'));
                }
            }
        } else {
            PJsonMsg(REQUEST_ERROR, lang('verifyCode_error'));
        }
    }
    
    //用户退出
    public function logout() {
        unset($_SESSION['userInfo']);
        PJsonMsg(REQUEST_SUCCESS, lang('logout_success'));
    }
    
    //获取验证码
    public function getVerifyCode() {
        verifyCode(100, 32);
    }
    
    //检测用户名
    private function verifyUsername($username) {
        $patten = '/^\w{8,24}$/';
        $result = preg_match($patten, $username);
        
        return $result;
    }
    
    //检测密码
    private function verifyPassword($password) {
        $patten = '/^\w{8,24}$/';
        $result = preg_match($patten, $password);
        
        return $result;
    }
    
    //检测邮件
    private function verifyEmail($email) {
        $patten = '/^[a-z0-9]+@([a-z0-9]+\.)+[a-z]{2,4}$/i';
        $result = preg_match($patten, $email);
        
        return $result;
    }
    
    //验证验证码
    private function verifyCode($verifyCode) {
        if (isset($_SESSION['verifyCode']) && (md5(strtoupper($verifyCode)) === $_SESSION['verifyCode'])) {
            return TRUE;
        } else {
            FALSE;
        }
    }
    
    //检测用户名是否存在
    private function checkUsername($username) {
        $result = $this->user->getUserByUsername($username);
        
        return $result;
    }
    
    //检测邮件是否存在
    private function checkEmail($email) {
        $result = $this->user->getUserByEmail($email);
        
        return $result;
    }
}