<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * author: hexiaodong
 * Date: 2018/8/8
 */
class Artcle extends MY_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_artcle', 'artcle');
        $this->load->model('M_category', 'category');
    }
    
    //首页
    public function index() {
        //用户信息
        $userInfo = $this->userInfo;
        //获取栏目列表
        $categoryList = $this->getCategoryList();
        //获取推荐文章
        $recommendList = $this->getRecommendList();
        //获取最新文章
        $artcleList = $this->getLastArtcleList();
        //获取专题列表
        $subjectList = $this->getSubjectList();
        //获取热门文章
        $hotArtcleList = $this->getHotArtcleList();
        //我的标签
        $myTagList = $this->getTagsList();
        //统计数据
        $totalInfo = $this->getTotalInfo();
        //获取猜你喜欢
        $randArtcle = $this->getRandArtcle();
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        $this->load->view('home/header', compact('userInfo', 'category', 'categoryList', 'recommendList', 'artcleList', 'subjectList', 'hotArtcleList', 'myTagList', 'totalInfo', 'randArtcle', 'friendLink'));
        $this->load->view('home/homePage');
        $this->load->view('home/footer');
    }
    
    //列表页
    public function lists($cid) {
        //用户信息
        $userInfo = $this->userInfo;
        //获取栏目列表
        $categoryList = $this->getCategoryList();
        //获取专题列表
        $subjectList = $this->getSubjectList();
        //获取猜你喜欢
        $randArtcle = $this->getRandArtcle();
        //获取推荐文章
        $recommendList = $this->getRecommendList(4);
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        
        $this->load->view('home/header', compact('userInfo', 'cid', 'categoryList', 'subjectList', 'randArtcle', 'recommendList', 'friendLink'));
        $this->load->view('home/listsPage');
        $this->load->view('home/footer');
    }
    
    /**
     * 内容页
     *
     * @param $artcleId
     */
    public function show($artcleId) {
        //用户信息
        $userInfo = $this->userInfo;
        //获取文章
        $artcle = $this->getArtcleById($artcleId);
        //获取专题列表
        $subjectList = $this->getSubjectList();
        //我的标签
        $myTagList = $this->getTagsList();
        //获取栏目列表
        $categoryList = $this->getCategoryList();
        //获取文章标签
        $artcleTags = $this->getArtcleTagsByArtcleId($artcleId);
        //获取猜你喜欢
        $randArtcle = $this->getRandArtcle();
        
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        $this->load->view('home/header', compact('userInfo', 'artcle', 'artcleTags', 'categoryList', 'myTagList', 'subjectList', 'randArtcle', 'friendLink'));
        $this->load->view('home/artclePage');
        $this->load->view('home/footer');
    }
    
    //发表文章
    public function publishArtcle() {
        if ($_POST) {
            $title = getParam($this->input->post('title'), 'string');
            $summary = getParam($this->input->post('summary'), 'string');
            $type = getParam($this->input->post('type'), 'int');
            $cid = getParam($this->input->post('category'), 'int');
            $status = getParam($this->input->post('status'), 'int', 1);
            $content = getParam($this->input->post('content'), 'html');
            $thumb = getParam($this->input->post('thumb'), 'string');
            $user_id = $this->userInfo['id'];
            $create_time = $update_time = $publish_time = date('Y-m-d H:i:s');
            $data = compact('cid', 'title', 'summary', 'type', 'thumb', 'content', 'status', 'user_id', 'create_time', 'update_time', 'publish_time');
            $result = $this->artcle->addArtcle($data);
            if ($result) {
                PJsonMsg(REQUEST_SUCCESS, lang('publish_success'));
            } else {
                PJsonMsg(REQUEST_ERROR, lang('publish_error'));
            }
        } else {
            $categoryList = $this->category->getAllCategory();
            $data = compact('categoryList');
            $this->load->view('home/publishArtcle', $data);
        }
    }
    
    //删除文章
    public function deleteArtcle() {
        $id = getParam($this->input->post('id'), 'int');
        $user_id = $this->userInfo['id'];
        $where = compact('id', 'user_id');
        $result = $this->artcle->deleteArtcle($where);
        if ($result) {
            PJsonMsg(REQUEST_SUCCESS, lang('delete_success'));
        } else {
            PJsonMsg(REQUEST_ERROR, lang('delete_error'));
        }
    }
    
    //修改文章
    public function modifyArtcle() {
        if ($_POST) {
            $id = getParam($this->input->post('id'), 'int');
            $title = getParam($this->input->post('title'), 'string');
            $summary = getParam($this->input->post('summary'), 'string');
            $type = getParam($this->input->post('type'), 'int');
            $cid = getParam($this->input->post('category'), 'int');
            $status = getParam($this->input->post('status'), 'int', 1);
            $content = getParam($this->input->post('content'), 'html');
            $thumb = getParam($this->input->post('thumb'), 'string');
            $update_time = date('Y-m-d H:i:s');
            $where = compact('id');
            $data = compact('cid', 'title', 'summary', 'type', 'thumb', 'content', 'status', 'update_time');
            $result = $this->artcle->modifyArtcle($data, $where);
            if ($result) {
                PJsonMsg(REQUEST_SUCCESS, lang('update_success'));
            } else {
                PJsonMsg(REQUEST_ERROR, lang('update_error'));
            }
        } else {
            //查询文章信息
            $id = getParam($this->input->get('id'), 'int');
            $artcle = $this->getArtcleById($id);
            if (!$artcle) {
                PJsonMsg(REQUEST_ERROR, lang('request_invalid'));
            }
            $categoryList = $this->category->getAllCategory();
            $data = compact('categoryList', 'artcle');
            $this->load->view('home/modifyArtcle', $data);
        }
    }
    
    //切换状态
    public function modifyStatus() {
        $id = getParam($this->input->post('id'), 'int');
        $status = getParam($this->input->post('status'), 'int');
        $user_id = $this->userInfo['id'];
        //查询当前文章是否属于当前用户
        $where = compact('id', 'user_id');
        $artcle = $this->artcle->getOneArtcle($where);
        if (empty($artcle)) {
            PJsonMsg(REQUEST_ERROR, lang('request_invalid'));
        }
        $publish_time = $update_time = date('Y-m-d H:i:s');
        if ($status === 1) {
            $data = compact('status', 'update_time', 'publish_time');
        } else {
            $data = compact('status', 'update_time');
        }
        $result = $this->artcle->modifyArtcle($data, $where);
        if ($result) {
            PJsonMsg(REQUEST_SUCCESS, lang('operation_success'));
        } else {
            PJsonMsg(REQUEST_ERROR, lang('operation_error'));
        }
    }
    
    //获取推荐文章
    private function getRecommendList($pageSize = 5) {
        $recommendList = $this->artcle->getRecommendList($pageSize);
        
        return $recommendList;
    }
    
    //获取最新文章
    private function getLastArtcleList() {
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 10);
        $param = compact('pageNo', 'pageSize', 'cid');
        $artcleList = $this->artcle->getLastArtcleList($param);
        if ($artcleList) {
            foreach ($artcleList as &$artcle) {
                $artcle['url'] = '/artcle/' . $artcle['id'] . parent::$urlSuffix;
                $artcle['categoryUrl'] = '/artcle/' . $artcle['cid'] . parent::$urlSuffix;
                $artcle['publishTime'] = formatTime(strtotime($artcle['publishTime']), 'Y.m.d');
            }
        }
        
        return $artcleList;
    }
    
    //获取文章列表
    public function getArtcleList() {
        $cid = getParam($this->input->post('cid'), 'int');
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 10);
        $param = compact('pageNo', 'pageSize', 'cid');
        $artcleList = $this->artcle->getArtcleList($param);
        if ($artcleList['list']) {
            foreach ($artcleList['list'] as &$artcle) {
                $artcle['url'] = '/artcle/' . $artcle['id'] . parent::$urlSuffix;
                $artcle['categoryUrl'] = '/artcle/' . $artcle['cid'] . parent::$urlSuffix;
                $artcle['publishTime'] = formatTime(strtotime($artcle['publishTime']), 'Y.m.d');
            }
            $artcleList['category'] = $artcle['category'];
        } else {
            //查询栏目名称
            $this->load->model('M_category', 'category');
            $category = $this->category->getCategoryByCid($cid);
            $artcleList = array_merge($category, $artcleList);
        }
        
        PJsonMsg(REQUEST_SUCCESS, lang('request_success'), $artcleList);
    }
    
    //获取专题列表
    private function getSubjectList() {
        $subjectList = $this->artcle->getSubjectList();
        if ($subjectList) {
            foreach ($subjectList as &$value) {
                $value['url'] = '/artcle/' . $value['id'] . parent::$urlSuffix;
            }
        }
        
        return $subjectList;
    }
    
    //获取热门文章
    private function getHotArtcleList() {
        $hotArtcleList = $this->artcle->getHotArtcleList();
        if ($hotArtcleList) {
            foreach ($hotArtcleList as &$value) {
                $value['url'] = '/artcle/' . $value['id'] . parent::$urlSuffix;
                if ($value['hits'] >= 1000) {
                    $value['hits'] = round(($value['hits'] / 1000), 2) . 'K';
                }
            }
        }
        
        return $hotArtcleList;
    }
    
    //获取我的标签
    private function getTagsList() {
        $getTagsList = $this->artcle->getTagsList();
        
        return $getTagsList;
    }
    
    //获取统计信息
    private function getTotalInfo() {
        $artcleTotalInfo = $this->artcle->getTotalInfo();
        if ($artcleTotalInfo) {
            $artcleTotalInfo['lastTime'] = date('Y.m.d', strtotime($artcleTotalInfo['lastTime']));
        }
        $commentCount = $this->artcle->getCommentCount();
        
        $totalInfo = array_merge($artcleTotalInfo, $commentCount);
        
        return $totalInfo;
    }
    
    /**
     * 根据id获取文章信息
     *
     * @param int $id 文章id
     *
     * @return mixed
     */
    private function getArtcleById($id) {
        $artcle = $this->artcle->getArtcleById($id);
        if ($artcle) {
            $artcle['publishTime'] = date('Y.m.d', strtotime($artcle['publishTime']));
        }
        
        return $artcle;
    }
    
    //获取文章标签
    private function getArtcleTagsByArtcleId($artcleId) {
        $tagsList = $this->artcle->getArtcleTagsByArtcleId($artcleId);
        
        return $tagsList;
    }
    
    //获取随机文章
    public function getRandArtcle() {
        $randArtcle = $this->artcle->getRandArtcle();
        if ($randArtcle) {
            foreach ($randArtcle as &$value) {
                $value['url'] = '/artcle/' . $value['id'] . parent::$urlSuffix;
                $value['publishTime'] = date('Y.m.d', strtotime($value['publishTime']));
            }
        }
        
        return $randArtcle;
    }
    
    //上传图片
    public function uploadThumb() {
        if (isset($_FILES['thumb']) && !empty($_FILES['thumb'])) {
            $thumb = $_FILES['thumb'];
            //验证图片格式
            switch ($thumb['type']) {
                case 'image/jpeg':
                case 'image/jpg':
                    $ext = '.jpg';
                    break;
                case 'image/png':
                    $ext = '.png';
                    break;
                case 'image/gif':
                    $ext = '.gif';
                    break;
                default:
                    PJsonMsg(REQUEST_ERROR, lang('thumbType_error'));
                    break;
            }
            if ($thumb['size'] > 1024 * 1024) {
                PJsonMsg(REQUEST_ERROR, lang('thumbSize_error'));
            }
            if (!is_dir(UPLOAD_FILE_PATH)) {
                mkdir(UPLOAD_FILE_PATH, 0755);
            }
            $newThumb = UPLOAD_FILE_PATH . time() . random(6) . $ext;
            $result = move_uploaded_file($thumb['tmp_name'], $newThumb);
            if ($result) {
                $newThumb = substr($newThumb, 1);
                PJsonMsg(REQUEST_SUCCESS, lang('upload_success'), $newThumb);
            } else {
                PJsonMsg(REQUEST_ERROR, lang('upload_error'));
            }
        } else {
            PJsonMsg(REQUEST_ERROR, lang('request_invalid'));
        }
        
    }
    
    //获取我的文章列表
    public function getMyArtcleList() {
        $pageNo = getParam($this->input->post('pageNo'), 'int', 1);
        $pageSize = getParam($this->input->post('pageSize'), 'int', 8);
        $status = getParam($this->input->post('type'), 'int');
        $user_id = $this->userInfo['id'];
        $data = compact('status', 'user_id', 'pageNo', 'pageSize');
        $result = $this->artcle->getMyArtcleList($data);
        if ($result) {
            foreach ($result['list'] as &$artcle) {
                $artcle['url'] = '/artcle/' . $artcle['id'] . parent::$urlSuffix;
                $artcle['publishTime'] = formatTime(strtotime($artcle['publishTime']), 'Y.m.d');
            }
            PJsonMsg(REQUEST_SUCCESS, lang('request_success'), $result);
        } else {
            PJsonMsg(REQUEST_ERROR, lang('request_error'));
        }
    }
}