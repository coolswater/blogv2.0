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
        $param['last_login_time'] = date('Y-m-d H:i:s');
        $this->add($param);
        
        return $this->db->insert_id();
    }
    
    //新增userInfo
    public function addUserInfo($data){
        $result = $this->db->insert('t_users_info', $data);
        return $result;
    }
    
    //根据用户名查询用户信息
    public function getUserByUsername($username) {
        $cols = 't_users.id,username,password,portrait,nick_name as nickName';
        $where = array(
            'status'   => 0,
            'username' => $username,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
    
    //根据电子邮件查询用户信息
    public function getUserByEmail($email) {
        $cols = 't_users.id,username,password,portrait';
        $where = array(
            'status' => 0,
            'email'  => $email,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
    
    public function getOne($cols, $where) {
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users_info','t_users.id=t_users_info.user_id','left')
            ->where($where)
            ->get()
            ->row_array();
    
        return $result;
    }
    
    //根据用户id查询用户
    public function getUserById($userId) {
        $cols = 't_users.id,username,nick_name,description,mobile,email';
        $where = array(
            't_users.id' => $userId,
        );
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users_info','t_users_info.user_id=t_users.id','id')
            ->where($where)
            ->get()
            ->row_array();
    
        return $result;
    }
    //多条件查询用户信息
    public function getUser($where) {
        $cols = 't_users.id,username,nick_name as nickName,portrait';
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users_info','t_users_info.user_id=t_users.id','id')
            ->where($where)
            ->get()
            ->row_array();
    
        return $result;
    }
    /**
     * 修改一条数据
     *
     * @param   array $data 修改数据
     * @param   array $where 修改条件
     *
     * @return mixed
     */
    public function modify($data, $where) {
        $result = $this->db->update('t_users_info', $data, $where);
        
        return $result;
    }
}