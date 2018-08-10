<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 模型基类
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_comm extends CI_Model {
    protected $_table;
    
    public function __construct() {
        $this->load->database('default');
    }
    
    //开启事务
    public function trans_start() {
        $this->db->trans_start();
    }
    
    //完成事务
    public function trans_complete() {
        $this->db->trans_complete();
    }
    
    
    /**
     * 添加一条数据
     *
     * @param   array $data 插入数据
     */
    public function add($data) {
        $this->db->insert($this->_table, $data);
        
        return $this->db->affected_rows();
    }
    
    //批量插入
    public function insertBatch($data) {
        $this->db->insert_batch($this->_table, $data);
        
        return $this->db->affected_rows();
    }
    
    /**
     * 删除数据
     *
     * @param   array $where 删除条件
     *
     * @return mixed
     */
    public function deleteData($where) {
        $result = $this->db->delete($this->_table, $where);
        
        return $result;
    }
    
    /**
     * 修改一条数据
     *
     * @param   array $data 修改数据
     * @param         array /string $where 修改条件
     *
     * @return mixed
     */
    public function modify($data, $where) {
        $result = $this->db->update($this->_table, $data, $where);
        
        return $result;
    }
    
    /**
     * 某个字段+1
     *
     * @param   string $field 字段
     * @param          array  /string    $where 条件
     */
    public function fieldsIncrease($field, $where) {
        $this->db->set($field, $field + 1, FALSE);
        $this->db->where($where);
        $this->db->update($this->_table);
        
        return $this->db->affected_rows();
    }
    
    /**
     * 获取某条数据
     *
     * @param string $cols  查询字段
     * @param array  $where 查询条件
     *
     * @return mixed
     */
    public function getOne($cols, $where) {
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->where($where)
            ->get()
            ->row_array();
        
        return $result;
    }
    
    /**
     * 执行sql语句
     *
     * @param   string $sql SQL语句
     *
     * @return  mixed   $result 执行结果
     */
    
    public function query_sql($sql, $where) {
        $result = $this->db->query($sql, $where)->result_array();
        
        return $result;
    }
    
    /**
     * 执行sql语句查询一条数据
     *
     * @param   string $sql SQL语句
     *
     * @return  mixed   $result 执行结果
     */
    
    public function queryOneBySql($sql, $where) {
        $result = $this->db->query($sql, $where)->row_array();
        
        return $result;
    }
    
    /**
     * 获取列表
     *
     * @param string $cols   查询字段
     * @param array  $where  查询条件
     * @param int    $limit  每页条数
     * @param int    $offset 偏移量
     *
     * @return mixed
     */
    public function getList($cols, $where = '1=1', $order = NULL, $limit = NULL, $offset = 0) {
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->where($where)
            ->limit($limit, $offset)
            ->order_by($order)
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //查询总数
    public function getTotal($where) {
        $result = $this->db->where($where)
            ->count_all_results($this->_table);
        
        return $result;
    }
}