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
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        $this->load->view('home/header', compact('userInfo', 'category', 'categoryList', 'recommendList', 'artcleList', 'subjectList', 'hotArtcleList', 'myTagList', 'totalInfo', 'friendLink'));
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
        //获取友情连接
        $friendLink = $this->getFriendLinks();
        
        $this->load->view('home/header', compact('userInfo', 'cid', 'categoryList', 'subjectList', 'randArtcle', 'friendLink'));
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
    public function publish() {
        $this->load->view('home/publishArtcle');
    }
    
    
    //获取推荐文章
    private function getRecommendList() {
        $recommendList = $this->artcle->getRecommendList();
        
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
                $artcle['publishTime'] = formatTime(strtotime($artcle['publishTime']));
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
                $artcle['publishTime'] = formatTime(strtotime($artcle['publishTime']));
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
    
    //根据id获取文章信息
    private function getArtcleById($id) {
        $artcleInfo = $this->artcle->getArtcleById($id);
        if ($artcleInfo) {
            $artcleInfo['publishTime'] = date('Y.m.d', strtotime($artcleInfo['publishTime']));
        }
        
        return $artcleInfo;
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
}