<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 用户模型
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_user extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_users';
    }
    
    //增加用户
    public function addUser($param) {
        $salt = rand_str(6);
        $param['password'] = md5(md5($param['password']) . $salt) . $salt;
        $param['last_login_ip'] = get_client_ip();
        $result = $this->add($param);
        
        return $result;
    }
    
    //根据用户名查询用户信息
    public function getUserByUsername($username) {
        $cols = 'id,username,password,portrait';
        $where = array(
            'status'   => 0,
            'username' => $username,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
    
    //根据电子邮件查询用户信息
    public function getUserByEmail($email) {
        $cols = 'id,username,password,portrait';
        $where = array(
            'status' => 0,
            'email'  => $email,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
}