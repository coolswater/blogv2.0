<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 评论模型
 * author: hexiaodong
 * Date: 2018/8/8
 */
class M_comment extends M_comm {
    public function __construct() {
        parent::__construct();
        $this->_table = 't_artcle_comments';
    }
    
    //添加评论
    public function addComment($param) {
        $result = $this->add($param);
        
        return $result;
    }
    
    //根据文章id获取文章评论列表
    public function getCommentListByArtcleId($param) {
        $cols = 't_artcle_comments.id,title,nick_name as nickName,portrait,content,t_artcle_comments.create_time';
        $where = array(
            'artcle_id' => $param['artcleId'],
        );
        $offset = ($param['pageNo'] - 1) * $param['pageSize'];
        $list = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id=t_artcle_comments.user_id', 'left')
            ->join('t_artcles', 't_artcles.id=t_artcle_comments.artcle_id', 'left')
            ->where($where)
            ->order_by('create_time desc')
            ->limit($param['pageSize'], $offset)
            ->get()
            ->result_array();
        $totalPage = $this->getTotal($where);
        $pageNo = $param['pageNo'];
        
        return compact('list', 'totalPage', 'pageNo');
    }
    
    //根据用户id获取文章评论列表
    public function getCommentListByUserId($param) {
        $cols = 't_artcle_comments.id,title,nick_name as nickName,portrait,t_artcle_comments.content,t_artcle_comments.create_time';
        $where = array(
            't_artcles.user_id' => $param['userId'],
        );
        $offset = ($param['pageNo'] - 1) * $param['pageSize'];
        $list = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_artcles', 't_artcles.id=t_artcle_comments.artcle_id', 'left')
            ->join('t_users', 't_users.id=t_artcle_comments.user_id', 'left')
            ->where($where)
            ->order_by('create_time desc')
            ->limit($param['pageSize'], $offset)
            ->get()
            ->result_array();
        
        $totalPage = $this->db->from($this->_table)
            ->join('t_artcles', 't_artcles.id=t_artcle_comments.artcle_id', 'left')
            ->join('t_users', 't_users.id=t_artcle_comments.user_id', 'left')
            ->where($where)
            ->order_by('create_time desc')
            ->count_all_results();
        
        $pageNo = $param['pageNo'];
        
        return compact('list', 'totalPage', 'pageNo');
    }
}