<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 标签模型
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_tags extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_arts';
    }
}