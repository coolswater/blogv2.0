<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 文章模型
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_artcle extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_artcles';
    }
    
    /**
     * 添加文章
     *
     * @param   array $data 数据
     *
     * @return mixed
     */
    public function addArtcle($data) {
        return parent::add($data);
    }
    
    /**
     * 更新文章
     *
     * @param array $data   更新数据
     * @param       $where  更新条件
     *
     * @return mixed
     */
    public function modifyArtcle($data, $where) {
        return parent::modify($data, $where);
    }
    
    //删除文章
    public function deleteArtcle($where) {
        return parent::deleteData($where);
    }
    
    //根据id获取文章
    public function getArtcleById($id) {
        $cols = 't_artcles.id as id,cid,title,user_id,nick_name as nickName,publish_time as publishTime,hits,summary,content,type,thumb';
        $where = array(
            't_artcles.id' => $id,
        );
        $artcelInfo = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id = t_artcles.user_id', 'left')
            ->join('t_users_info', 't_users.id = t_users_info.user_id', 'left')
            ->where($where)
            ->get()
            ->row_array();
        
        return $artcelInfo;
    }
    
    //获取5条推荐文章（已发表）
    public function getRecommendList($pageSize = 5) {
        $cols = 'id,title,thumb,summary';
        $where = array(
            'status' => 1,
            'type'   => 1,
        );
        $result = $this->getList($cols, $where, 'update_time desc', $pageSize);
        
        return $result;
    }
    
    //获取最新文章（已发表）
    public function getLastArtcleList($param) {
        $limit = $param['pageSize'];
        $offset = ($param['pageNo'] - 1) * $param['pageSize'];
        $cols = 't_artcles.id,t_artcles.cid,title,thumb,category,publish_time as publishTime,nick_name as nickName,summary';
        $where = array(
            't_artcles.status' => 1,
        );
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_categorys', 't_categorys.id=t_artcles.cid', 'left')
            ->join('t_users', 't_artcles.user_id=t_users.id', 'left')
            ->join('t_users_info', 't_users.id = t_users_info.user_id', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->order_by('publishTime desc')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //获取文章列表(已发布)
    public function getArtcleList($param) {
        $cid = $param['cid'];
        $limit = $param['pageSize'];
        $offset = ($param['pageNo'] - 1) * $param['pageSize'];
        $cols = 't_artcles.id,t_artcles.cid,title,thumb,category,publish_time as publishTime,nick_name as nickName,summary';
        $where = array(
            't_artcles.status' => 1,
        );
        if ($cid) {
            $where['t_artcles.cid'] = $cid;
        }
        $list = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_categorys', 't_categorys.id=t_artcles.cid', 'left')
            ->join('t_users', 't_artcles.user_id=t_users.id', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->order_by('publishTime desc')
            ->get()
            ->result_array();
        $pageNo = $param['pageNo'];
        $totalPage = $this->getTotal($where);
        
        return compact('pageNo', 'totalPage', 'list');
    }
    
    //获取我的文章列表（已发表）
    public function getMyArtcleList($param) {
        $status = $param['status'];
        $limit = $param['pageSize'];
        $offset = ($param['pageNo'] - 1) * $param['pageSize'];
        $cols = 't_artcles.id,t_artcles.cid,title,thumb,category,publish_time as publishTime,hits,t_artcles.status';
        $where = array(
            't_artcles.status' => $status,
            't_artcles.user_id' => $param['status']['user_id'],
        );
        $list = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_categorys', 't_categorys.id=t_artcles.cid', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->order_by('publishTime desc')
            ->get()
            ->result_array();
        $pageNo = $param['pageNo'];
        $totalPage = $this->getTotal($where);
        
        return compact('pageNo', 'totalPage', 'list');
    }
    
    //获取专题文章（已发表）
    public function getSubjectList() {
        $cols = 'id,title,summary,thumb';
        $where = array(
            'status' => 1,
            'type'   => 2,
        );
        $result = $this->getList($cols, $where, 'publish_time desc', 5);
        
        return $result;
    }
    
    //获取热门文章（已发表）
    public function getHotArtcleList() {
        $cols = 'id,title,thumb,hits';
        $where = array(
            'status' => 1,
        );
        $result = $this->getList($cols, $where, 'hits desc', 5);
        
        return $result;
    }
    
    //获取标签列表
    public function getTagsList() {
        $result = $this->db->select('*')
            ->from('t_tags')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //获取统计信息（已发表）
    public function getTotalInfo($param = NULL) {
        $cols = 'max(publish_time) as lastTime,count(1) as totalArtcle,count(hits) as totalHits';
        $where = array(
            'status' => 1,
        );
        if ($param) {
            $where = array_merge($where, $param);
        }
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->where($where)
            ->get()
            ->row_array();
        
        return $result;
    }
    
    //获取评论总数
    public function getCommentCount() {
        $cols = 'count(1) as totalComment';
        $result = $this->db->select($cols)
            ->from('t_comments')
            ->get()
            ->row_array();
        
        return $result;
    }
    
    //根据id获取评论列表
    public function getArtcleTagsByArtcleId($id) {
        $cols = '*';
        $where = array(
            'artcle_id' => $id,
        );
        $result = $this->db->select($cols)
            ->from('t_comments')
            ->join('t_users', 't_users.id=t_comments.user_id', 'left')
            ->where($where)
            ->order_by('create_time desc')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //随机获取（已发表）
    public function getRandArtcle() {
        $cols = 't_artcles.id,title,thumb,nick_name as nickName,publish_time as publishTime';
        $where = array(
            't_artcles.status' => 1,
        );
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id = t_artcles.user_id', 'left')
            ->join('t_users_info', 't_users.id = t_users_info.user_id', 'left')
            ->where($where)
            ->order_by('rand()')
            ->limit(5)
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //多条件查询某篇文章
    public function getOneArtcle($where) {
        return parent::getOne('*', $where);
    }
    
    public function modifyHits($artcleId) {
        $this->db->where(array('id' => $artcleId));
        $this->db->set('hits', 'hits + 1', FALSE);
        $this->db->update($this->_table);
    }
}