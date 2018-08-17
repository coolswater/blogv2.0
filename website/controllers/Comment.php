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
    
    //根据文章id评论列表
    public function getCommentListById() {
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 10);
        $artcleId = getParam($this->input->post('param'), 'int');
        $param = compact('pageNo', 'pageSize', 'artcleId');
        $commentList = $this->comment->getCommentListByArtcleId($param);
        if ($commentList) {
            foreach ($commentList['list'] as &$value) {
                $value['portrait'] = $value['portrait'] ?? DEFAULT_HEADER;
            }
        }
        PJsonMsg(REQUEST_SUCCESS, lang('request_success'), $commentList);
    }
    
    //根据用户id评论列表
    public function getCommentListByUserId() {
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 10);
        $userId = $this->userInfo['id'];
        $param = compact('pageNo', 'pageSize', 'userId');
        $commentList = $this->comment->getCommentListByUserId($param);
        if ($commentList) {
            foreach ($commentList['list'] as &$value) {
                $value['portrait'] = $value['portrait'] ?? DEFAULT_HEADER;
            }
        }
        PJsonMsg(REQUEST_SUCCESS, lang('request_success'), $commentList);
    }
    
    //发表评论
    public function comment() {
        //防刷
        $this->preventBrush();
        $content = getParam($this->input->post('content'), 'string');
        if (empty($content)) {
            PJsonMsg(REQUEST_ERROR, lang('comment_error'));
        }
        //判断是否登录
        if (!isset($this->userInfo['id'])) {
            PJsonMsg(NEED_LOGIN, lang('please_login'));
        } else {
            $user_id = $this->userInfo['id'];
        }
        //查询文章是否存在
        $artcle_id = getParam($this->input->post('artcleId'), 'int');
        $this->load->model('M_artcle', 'artcle');
        $artcleInfo = $this->artcle->getArtcleById($artcle_id);
        if (empty($artcleInfo)) {
            PJsonMsg(REQUEST_ERROR, lang('request_invalid'));
        }
        $create_time = date('Y-m-d H:i:s');
        $param = compact('artcle_id', 'content', 'user_id', 'pid', 'create_time');
        $result = $this->comment->addComment($param);
        if ($result) {
            PJsonMsg(REQUEST_SUCCESS, lang('comment_success'));
        } else {
            PJsonMsg(REQUEST_ERROR, lang('server_error'));
        }
    }
}