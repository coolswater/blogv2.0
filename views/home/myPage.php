<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0">
    <div class="mydata p-3 mb-3 bg-white">
        <ul class="head clearfix border-bottom pb-2">
            <li class="h6 float-left">数据统计</li>
            <li class="float-right"><span>全部</span>
                <span class="glyphicon glyphicon-chevron-down text-muted"></span>
                <ul class="date-select hide" style="display: none;">
                    <li data-days="0"><a href="javascript:;" class="member_statisic_all">全部</a></li>
                    <li data-days="1"><a href="javascript:;" class="member_statisic_all">昨天</a></li>
                    <li data-days="7"><a href="javascript:;" class="member_statisic_all">近一周</a></li>
                    <li data-days="30"><a href="javascript:;" class="member_statisic_all">近一月</a></li>
                </ul>
            </li>
        </ul>
        <ul class="row text-center mt-4">
            <li class="col-md-3 border-right-dashed">
                <p class="font-weight-bold"><?= $totalArtcle ?></p>
                <span>文章数</span>
            </li>
            <li class="col-md-3 border-right-dashed">
                <p class="font-weight-bold"><?= $totalHits ?></p>
                <span>阅读数</span>
            </li>
            <li class="col-md-3 border-right-dashed bg-light">
                <p class="font-weight-bold">2</p>
                <span>粉丝数</span>
            </li>
            <li class="col-md-3 bg-light">
                <p class="font-weight-bold">2</p>
                <span>粉丝数</span>
            </li>
        </ul>
    </div>
    <div class="row p-3 bg-white">
        <div class="mydata col-md-6">
            <div class="h6 border-bottom pb-3">最新评论</div>
            <ul class="list-unstyled mt-3" id="commentList"></ul>
            <nav aria-label="Page navigation example">
                <ul id="commentPagination" class="pagination"></ul>
            </nav>
        </div>
        <div class="mydata col-md-6">
            <ul class="head clearfix border-bottom pb-2">
                <li class="h6 float-left">数据统计</li>
                <li class="float-right"><span>全部</span>
                    <span class="glyphicon glyphicon-chevron-down text-muted"></span>
                    <ul class="date-select hide" style="display: none;">
                        <li data-days="0"><a href="javascript:;" class="member_statisic_all">全部</a></li>
                        <li data-days="1"><a href="javascript:;" class="member_statisic_all">昨天</a></li>
                        <li data-days="7"><a href="javascript:;" class="member_statisic_all">近一周</a></li>
                        <li data-days="30"><a href="javascript:;" class="member_statisic_all">近一月</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>

</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/bootstrap-paginator.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    $(document).ready(function () {
        //获取最新评论列表
        var param = {
            url: '/getCommentListByUserId'
        };
        getCommentList(param);
    });
</script>
</body>
</html>