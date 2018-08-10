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
    
    //根据id获取文章
    public function getArtcleById($id) {
        $cols = 't_artcles.id as aid,title,nick_name as nickName,publish_time as publishTime,hits,summary,content ';
        $where = array(
            'status'       => 1,
            't_artcles.id' => $id,
        );
        $artcelInfo = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id = t_artcles.user_id', 'left')
            ->where($where)
            ->get()
            ->row_array();
        
        return $artcelInfo;
    }
    
    //获取5条推荐文章
    public function getRecommendList() {
        $cols = 'id,title,thumb';
        $where = array(
            'status' => 1,
            'type'   => 1,
        );
        $result = $this->getList($cols, $where, 'update_time desc', 5);
        
        return $result;
    }
    
    //获取文章列表
    public function getArtcleList($cid = NULL) {
        $limit = 10;
        $offset = 0;
        $cols = 't_artcles.id,t_artcles.cid,title,thumb,category,publish_time as publishTime,nick_name as nickName,summary';
        $where = array(
            't_artcles.status' => 1,
        );
        if ($cid) {
            $where['t_artcles.cid'] = $cid;
        }
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_artcle_categorys', 't_artcle_categorys.cid=t_artcles.cid', 'left')
            ->join('t_users', 't_artcles.user_id=t_users.id', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->order_by('publishTime desc')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //获取专题文章
    public function getSubjectList() {
        $cols = 'id,title,summary';
        $where = array(
            'status' => 1,
            'type'   => 2,
        );
        $result = $this->getList($cols, $where, 'publish_time desc', 5);
        
        return $result;
    }
    
    //获取热门文章
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
            ->from('t_artcle_tags')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //获取统计信息
    public function getTotalInfo() {
        $cols = 'max(publish_time) as lastTime,count(1) as totalArtcle';
        $where = array(
            'status' => 1,
        );
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
            ->from('t_artcle_comments')
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
            ->from('t_artcle_comments')
            ->join('t_users', 't_users.id=t_artcle_comments.user_id', 'left')
            ->where($where)
            ->order_by('create_time desc')
            ->get()
            ->result_array();
        
        return $result;
    }
    
    //随机获取
    public function getRandArtcle() {
        $cols = 't_artcles.id,title,thumb,nick_name as nickName,publish_time as publishTime';
        $where = array(
            'status' => 1,
        );
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id = t_artcles.user_id', 'left')
            ->where($where)
            ->order_by('rand()')
            ->limit(5)
            ->get()
            ->result_array();
        
        return $result;
    }
}