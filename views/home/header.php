<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <title>贺小东的个人网站-Hexd&#039;s Personal Website一个记录程序员成长历程网站，与大家一起分享!http://www.hexiaodong.com</title>
    <meta name="Keywords" content=PHP,PHP开发, Hexd,PHP笔记，编程开发，网络日志(Blog)/>
    <meta name="Description" content=Hexd&#039;s Personal Website一个记录程序员成长历程网站，与大家一起分享，http://www.hexiaodong.com/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icon.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/share.css">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="/">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <?php foreach ($categoryList as $cate): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $cate['url'] ?>" target="_blank"><?= $cate['category'] ?></a>
                        </li>
                    <?php endforeach; ?>
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
    <?php $this->load->view('home/login') ?>
    <?php $this->load->view('home/register') ?>

</div>
<!--header end-->
