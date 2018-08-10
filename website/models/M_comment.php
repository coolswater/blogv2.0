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
    
    //获取文章评论列表
    public function getCommentList($artcleId, $limit = 10, $pageSize = 1) {
        $cols = 't_artcle_comments.id,nick_name as nickName,portrait,content,t_artcle_comments.create_time';
        $where = array(
            'artcle_id' => $artcleId,
        );
        $offset = ($pageSize - 1) * $limit;
        $result = $this->db->select($cols)
            ->from($this->_table)
            ->join('t_users', 't_users.id=t_artcle_comments.user_id', 'left')
            ->where($where)
            ->limit($limit, $offset)
            ->get()
            ->result_array();
        
        return $result;
    }
}