<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 栏目模型
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_category extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_artcle_categorys';
    }
    
    //根据栏目id查询栏目名称
    public function getCategoryByCid($cid) {
        $cols = 'category';
        $where = array(
            'id' => $cid,
        );
        $result = $this->getOne($cols, $where);
        
        return $result;
    }
    
    //查询栏目列表
    public function getCategoryList() {
        $cols = 'id,category,';
        $where = array(
            'status' => 0,
        );
        $result = $this->getList($cols, $where, 'id asc', 6);
        
        return $result;
    }
    
    //查询所有栏目
    public function getAllCategory() {
        $cols = 'id,category,';
        $where = array(
            'status' => 0,
        );
        $result = $this->getList($cols, $where, 'id asc');
        
        return $result;
    }
}