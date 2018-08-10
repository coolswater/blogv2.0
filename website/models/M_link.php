<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 友情链接模型
 * author: hexiaodong
 * Date: 2018/8/9
 */
class M_link extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_friend_links';
    }
    
    //获取友情连接
    public function getFriendLinks() {
        $where = array(
            'status' => 0,
        );
        $result = $this->getList('*', $where);
        
        return $result;
    }
}