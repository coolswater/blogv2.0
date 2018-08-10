<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 评论控制器
 * author: hexiaodong
 * Date: 2018/8/10
 */
class Comment extends MY_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_comment', 'comment');
    }
    
    //评论列表
    public function getCommentList() {
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 10);
        $artcleId = getParam($this->input->post('artcleId'), 'int');
        $param = compact('pageNo', 'pageSize', 'artcleId');
        $commentList = $this->comment->getCommentListByArtcleId($param);
        if ($commentList) {
            foreach ($commentList['list'] as &$value) {
                $value['portrait'] = $value['portrait'] ?? '/assets/images/header.jpg';
            }
        }
        PJsonMsg(REQUEST_SUCCESS, lang('request_success'), $commentList);
    }
}