<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <title>贺小东的个人网站-Hexd&#039;s Personal Website hexiaodong.com</title>
    <meta name="Keywords" content=PHP,PHP开发, Hexd,PHP笔记，编程开发，网络日志(Blog)/>
    <meta name="Description" content=Hexd&#039;s Personal Website一个记录程序员成长历程网站，与大家一起分享，www.hexiaodong.com/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icon.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/share.css">
</head>
<body class="bg-light">
<!--header start-->
<div class="container-fluid bg-dark fixed-top header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="/assets/images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">前端开发</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">后端开发</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">系统运维</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">大数据</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">网站运营</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            数据库
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <!--<form class="form-inline">-->
                <!--<input class="form-control form-control-sm" type="search" placeholder="请输入" aria-label="Search">-->
                <!--</form>-->
                <div class="sign-in">
                    <button type="button" class="btn btn-secondary btn-sm col-sm-12" data-toggle="modal"
                            data-target="#login">
                        <span class="glyphicon glyphicon-user"> </span> Login
                    </button>
                </div>

            </div>
        </nav>
    </div>
    <!-- 登录窗口 start -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="loginLabel">用户登录</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-group" id="loginForm">
                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            <input class="form-control" name="username" id="username" placeholder="用户名/邮箱"
                                   type="text" placeholder="text">
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <input class="form-control" name="password" id="password" placeholder="登录密码"
                                   type="password"
                                   placeholder="text">
                        </div>
                        <div class="text-left">
                            <button class="btn btn-danger w-100 mt-4" type="submit">登录</button>
                            <div class="mt-2 button" data-toggle="modal" data-dismiss="modal" data-target="#register">
                                没有账号？<span class="text-primary">去注册<span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录窗口 end -->
    <!-- 注册窗口 start -->
    <div id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registerLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="registerLabel">用户注册</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-group" id="registerForm">
                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            <input class="form-control" id="regusername" name="regusername" type="text"
                                   placeholder="用户名：6-15位字母或数字">
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <input class="form-control" id="regpassword" name="regpassword" type="password"
                                   placeholder="密码：至少6位字母或数字">
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <input class="form-control" id="confirm_password" name="confirm_password"
                                   type="password"
                                   placeholder="确认密码：至少6位字母或数字">
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <input class="form-control" id="email" name="email" type="text"
                                   placeholder="邮箱：例如:123@123.com">
                        </div>
                        <div class="text-left">
                            <button class="btn btn-danger w-100 mt-4" type="submit">注册</button>
                            <div class="mt-2 button" data-toggle="modal" data-dismiss="modal" data-target="#login">
                                已有账号？<span class="text-primary">去登录</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 注册窗口 end -->

</div>
<!--header end-->
<!--main start-->
<div class="row main container">
    <!--main_left start-->
    <div class="main_left pt-4 pl-4 col-12 col-md-9 bg-white">
        <!-- 代码 开始 -->
        <div id="appgame-leftside-share">
            <div class="appgame-leftside-share rwt_share" id="rwt_share">
                <a class="appgame-leftside-weixin" data-cmd="weixin" title="分享到微信">微信</a>
                <a class="appgame-leftside-qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a>
                <a class="appgame-leftside-sqq" data-cmd="sqq" title="分享到QQ好友">QQ好友</a>
                <a class="appgame-leftside-tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a>
            </div>
        </div>
        <!-- 代码 结束 -->
        <!--文章内容 start-->
        <div class="artcle_header">
            <h4>少听大忽悠的AI万能论：不打开四道锁，企业永远无法享用AI</h4>
            <ul class="nav_list mt-4">
                <li title="作者">来源：hexd</li>
                <li title="发布时间">日期：2018.04.18</li>
                <li title="阅读量">阅读： 1</li>
            </ul>
        </div>
        <div class="summary">
            一次针对委内瑞拉总统马杜罗的无人机刺杀行动，预示着一个可怕的未来：无人机+人工智能+小型化，现在人工智能可以胜任人类所有的工作。
        </div>
        <div class="artcle_content mt-5">
            如果你是一位科技和AI爱好者，想必会在各种信息渠道看到“人工智能又能干什么了”、“人工智能又在某领域超过人类了”，这类消息近乎于每天都在我们的眼球前摇晃。
        </div>
        <!--文章内容 end-->
        <!--文章标签 start-->
        <div class="tags mt-5 mb-5">
            <span>TAGS:</span>
            <a href="#" rel="tag">mobile</a>
            <a href="#" rel="tag">gadgets</a>
            <a href="#" rel="tag">satelite</a>
        </div>
        <!--文章标签 end-->
        <!--文章评论 start-->
        <div class="artcle_comment">
            <h6 class="mb-3 font-weight-bold">说点什么</h6>
            <textarea class="col-md-12" id="comment" name="comment" rows="5" required="required"
                      placeholder="请留下您宝贵的意见"></textarea>
            <input type="button" value="发表" class="btn btn-danger w-25">
        </div>
        <!--文章评论 end-->
        <!--评论列表 start-->
        <div class="comment">
            <ul class="list-unstyled mt-5">
                <li class="media">
                    <img class="portrait rounded-circle mr-3" src="/assets/images/header.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <span class="font-weight-bold">牛盾007</span>
                        <span class="ml-3">2018/05/05</span>
                        <p class="mt-2">
                            ad发送到发生了，发加速度，就按时，打飞机；ad发送到发生了，发加速度，就按时，打飞机
                        </p>
                        <p class="comment_nav">
                            <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                            <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                        </p>
                    </div>
                </li>
                <li class="media">
                    <img class="portrait rounded-circle mr-3" src="/assets/images/header.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <span class="font-weight-bold">牛盾007</span>
                        <span class="ml-3">2018/05/05</span>
                        <p class="mt-2">
                            ad发送到发生了，发加速度，就按时，打飞机；ad发送到发生了，发加速度，就按时，打飞机
                        </p>
                        <p class="comment_nav">
                            <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                            <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                        </p>
                    </div>
                </li>
                <li class="media">
                    <img class="portrait rounded-circle mr-3" src="/assets/images/header.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <span class="font-weight-bold">牛盾007</span>
                        <span class="ml-3">2018/05/05</span>
                        <p class="mt-2">
                            ad发送到发生了，发加速度，就按时，打飞机；ad发送到发生了，发加速度，就按时，打飞机
                        </p>
                        <p class="comment_nav">
                            <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                            <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                        </p>
                    </div>
                </li>
                <li class="media">
                    <img class="portrait rounded-circle mr-3" src="/assets/images/header.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <span class="font-weight-bold">牛盾007</span>
                        <span class="ml-3">2018/05/05</span>
                        <p class="mt-2">
                            ad发送到发生了，发加速度，就按时，打飞机；ad发送到发生了，发加速度，就按时，打飞机
                        </p>
                        <p class="comment_nav">
                            <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                            <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                        </p>
                    </div>
                </li>
                <li class="media">
                    <img class="portrait rounded-circle mr-3" src="/assets/images/header.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <span class="font-weight-bold">牛盾007</span>
                        <span class="ml-3">2018/05/05</span>
                        <p class="mt-2">
                            ad发送到发生了，发加速度，就按时，打飞机；ad发送到发生了，发加速度，就按时，打飞机
                        </p>
                        <p class="comment_nav">
                            <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                            <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                        </p>
                    </div>
                </li>
            </ul>
            <!--页码 start-->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--页码 end-->
        </div>
        <!--评论列表 end-->
    </div>
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-12 col-md-3 bg-white pt-3">
        <!--专题 start-->
        <div class="card">
            <div class="card-body">
                <span class="badge badge-primary">专题</span>
                <h5 class="card-title small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                <p class="card-text">
                    个人认为：弹性盒子是Bootstrap中比较重要同时理解也比较困难的一部分，接下来，我就根据自己的理解详细讲述一下对于弹性盒子的看法。
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item small_title">Bootstrap4之弹性盒子详解flexbox</li>
                <li class="list-group-item small_title">Bootstrap4之弹性盒子详解flexbox</li>
                <li class="list-group-item small_title">Bootstrap4之弹性盒子详解flexbox</li>
            </ul>
        </div>
        <!--专题 end-->
        <div class="right_ads">
            <img class="w-100" src="/assets/images/right_ads.jpg"/>
        </div>
        <!--猜你喜欢 start-->
        <div class="">
            <h5 class="card-header bg-white">
                <span class="glyphicon glyphicon-fire icon"></span>
                猜你喜欢
                <span class="refresh"><span class="glyphicon glyphicon-repeat pr-1"></span>换一批</span>
            </h5>
            <ul class="list-unstyled artcle_list">
                <li class="media">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-1 small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                        <div class="media-footer">
                            <span class="category">linux</span>
                            <span class="author">Hexd</span>
                            <span class="publish_time">2018/06/07</span>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-1 small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                        <div class="media-footer">
                            <span class="category">linux</span>
                            <span class="author">Hexd</span>
                            <span class="publish_time">2018/06/07</span>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-1 small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                        <div class="media-footer">
                            <span class="category">linux</span>
                            <span class="author">Hexd</span>
                            <span class="publish_time">2018/06/07</span>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-1 small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                        <div class="media-footer">
                            <span class="category">linux</span>
                            <span class="author">Hexd</span>
                            <span class="publish_time">2018/06/07</span>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg"
                         alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-1 small_title">Bootstrap4之弹性盒子详解flexbox</h5>
                        <div class="media-footer">
                            <span class="category">linux</span>
                            <span class="author">Hexd</span>
                            <span class="publish_time">2018/06/07</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--猜你喜欢 end-->
        <!--我的标签 start-->
        <div class="my-tags">
            <h5 class="card-header bg-white"><span class="glyphicon glyphicon-tags icon"></span>我的标签</h5>
            <div class="mt-2 tag-list">
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
                <a href="#" class="">php</a>
            </div>
        </div>
    </div>
    <!--main_right end-->
</div>
<!--main end-->
<!--footer start-->
<div class="container-fluid bg-dark">
    <div class="footer container row">
        <div class="col-12 col-md-6">
            <span>友情连接：</span>
            <a href="http://www.luotianchang.com" target="_blank">罗天昌</a>
            <a href="http://www.lvlvstart.com" target="_blank">lvlvstart</a>
            <a href="http://www.liuzhaoning.com" target="_blank">刘朝宁</a>
            <a href="http://www.forex.com.cn" target="_blank">外汇通</a>
            <a href="http://www.itwithauto.com" target="_blank">大兵</a>
        </div>
        <div class="col-12 col-md-6 copyright">Copyright © 2017-2018 京ICP备16001516号-2</div>
    </div>

    <div id="leftsead">
        <ul>
            <li>
                <a href="">
                    <img src="/assets/images/ll03.png" width="47" height="49" class="hides"/>
                    <img src="/assets/images/l03.png" width="47" height="49" class="shows"/>
                </a>
            </li>

            <li>
                <a href="">
                    <img src="/assets/images/ll02.png" width="166" height="49" class="hides"/>
                    <img src="/assets/images/l04.png" width="47" height="49" class="shows"/>
                </a>
            </li>

            <li>
                <a class="youhui">
                    <img src="/assets/images/l02.png" width="47" height="49" class="shows"/>
                    <img src="/assets/images/wechat.jpg" class="hides" usemap="#taklhtml"/>
                </a>
            </li>
            <li>
                <a id="top_btn">
                    <img src="/assets/images/ll06.png" width="47" height="49" class="hides"/>
                    <img src="/assets/images/l06.png" width="47" height="49" class="shows"/>
                </a>
            </li>

        </ul>
    </div><!--leftsead end-->
</div>
<!--footer end-->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/assets/js/jquery.slim.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/myjs.js"></script>
<script src="/assets/js/share.min.js"></script>

</body>
</html>