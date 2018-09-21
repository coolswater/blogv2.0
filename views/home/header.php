<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <title>贺小东的个人网站-Hexd&#039;s Personal Website一个记录程序员成长历程网站，与大家一起分享!http://www.hexiaodong.com</title>
    <meta name="Keywords" content=PHP,PHP开发, Hexd,PHP笔记，编程开发，网络日志(Blog)/>
    <meta name="Description" content=Hexd&#039;s Personal Website一个记录程序员成长历程网站，与大家一起分享，http:
    //www.hexiaodong.com/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icon.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <script src="/assets/js/jquery.min.js"></script>
</head>
<body class="bg-light"><!--header start-->
<div class="container-fluid bg-dark fixed-top header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/"><img src="/assets/images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php foreach ($categoryList as $cate): ?>
                        <?php if (isset($cid) && $cid === $cate['cid']): ?>
                            <li class="nav-item active">
                        <?php else: ?>
                            <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= $cate['url'] ?>"><?= $cate['category'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!--<form class="form-inline">-->
                <!--<input class="form-control form-control-sm" type="search" placeholder="请输入" aria-label="Search">-->
                <!--</form>-->
                <?php if ($userInfo): ?>
                    <div class="sign-in">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= $userInfo['portrait'] ?>"/>
                                <span><?=$userInfo['nickName']?></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">个人主页</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:logout()">用户退出</a>
                            </div>
                        </li>
                    </div>
                <?php else: ?>
                    <div class="sign-in">
                        <button type="button" class="btn btn-secondary btn-sm col-sm-12" data-toggle="modal"
                                data-target="#login">
                            <span class="glyphicon glyphicon-user"> </span>登录
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <?php $this->load->view('home/login') ?>
    <!--    --><?php //$this->load->view('home/forgetPwd') ?>
    <!--    --><?php //$this->load->view('home/success') ?>
    <!--    --><?php //$this->load->view('home/register') ?>

</div>
<!--header end-->
