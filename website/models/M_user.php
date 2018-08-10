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
    
    public function getUserByUsername($username) {
        $cols = 'id,username,password';
        $where = array(
            'status'   => 0,
            'username' => $username,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
}