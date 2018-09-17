<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route = array(
    'translate_uri_dashes'   => FALSE,
    '404_override'           => 'Errors/error404',                //404页面
    'default_controller'     => 'Artcle/index',                   //网站首页
    'publish'                => 'Artcle/publish',                 //发表文章
    'lists/(:num)'           => 'Artcle/lists/$1',                //文章列表
    'artcle/(:num)'          => 'Artcle/show/$1',                 //文章详情
    'getArtcleList'          => 'Artcle/getArtcleList',           //文章列表
    'deleteArtcle'           => 'Artcle/deleteArtcle',            //删除文章
    'modifyArtcle'           => 'Artcle/modifyArtcle',            //编辑文章
    'modifyStatus'           => 'Artcle/modifyStatus',            //切换文章状态
    'getMyArtcleList'        => 'Artcle/getMyArtcleList',         //我的文章列表
    'publishArtcle'          => 'Artcle/publishArtcle',           //发表文章
    'uploadThumb'            => 'Artcle/uploadThumb',             //上传图片
    'deleteThumb'            => 'Artcle/deleteThumb',             //上传图片
    'comment'                => 'Comment/comment',                //提交评论
    'getCommentListById'     => 'Comment/getCommentListById',     //根据文章id获取评论列表
    'getCommentListByUserId' => 'Comment/getCommentListByUserId', //根据用户id获取评论列表
    'login'                  => 'User/login',                     //用户登录
    'logout'                 => 'User/logout',                    //用户退出
    'myPage'                 => 'User/myPage',                    //我的主页
    'myArtcles'              => 'User/myArtcles',                 //我的文章
    'myCollections'          => 'User/myCollections',             //我的收藏
    'myFollow'               => 'User/myFollow',                  //我的关注
    'mySetting'              => 'User/mySetting',                 //个人设置
    'profile'                => 'User/profile',                   //用户中心
    'register'               => 'User/register',                  //用户注册
    'forgetPwd'              => 'User/forgetPwd',                 //忘记密码
    'getVerifyCode'          => 'User/getVerifyCode',             //验证码
);