<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php if(isset($artcle['title'])):?>
    <title><?= $artcle['title'] ?>--Hexd Personal Website~</title>
    <?php else:?>
    <title>Hexd Personal Website一个记录程序员成长历程网站，与大家一起分享!http://www.hexiaodong.com</title>
    <?php endif;?>
    <meta name="Keywords" content="网站开发、编程开发、网站运营、PHP、PHP开发" />
    <meta name="Description" content="Hexd Personal Website一个记录程序员成长历程网站，与大家一起分享，http://www.hexiaodong.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <meta name="baidu_union_verify" content="dca16dff7c9ed932b27fd76ba6d1d5d2">
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icon.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <script src="/assets/js/jquery.min.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?0745ccb7f659e04927bbaee9e0d6e433";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

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
                        <?php if (isset($cid) && $cid === $cate['id']): ?>
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
</div>
<!--header end-->
