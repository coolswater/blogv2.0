<!--main start-->
<div class="row main container">
    <!--main_left start-->
    <div class="main_left col-12 col-md-2 pl-0 pr-0 bg-white">
        <div class="card-media personal-card bg-white">
            <img src="<?= $userInfo['portrait']?>" title="<?= $userInfo['nickName']?>" alt=""/>
            <div class="presonal-info font-weight-bold"><?= $userInfo['nickName']?></div>
            <a href="/publishArtcle" target="targetDiv" class="btn btn-danger col-md-8 col-xs-2 mt-3">发表文章</a>
        </div>

        <div class="card-media personal-menu pt-4 pb-5">
            <ul class="menu-list">
                <li class="menu-list-default current">
                    <i></i>
                    <a href="/myPage" target="targetDiv">
                        <span class="glyphicon glyphicon-home"></span>
                        我的主页
                    </a>
                </li>
                <li class="menu-list-default ">
                    <i></i>
                    <a href="/myArtcles" target="targetDiv">
                        <span class="glyphicon glyphicon-th-list"></span>
                        我的文章
                    </a>
                </li>
<!--                <li class="menu-list-default ">-->
<!--                    <i></i>-->
<!---->
<!--                    <a href="/myFollow" target="targetDiv">-->
<!--                        <span class="glyphicon glyphicon-heart"></span>-->
<!--                        我的关注-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="menu-list-default ">-->
<!--                    <i></i>-->
<!--                    <a href="/myCollections" target="targetDiv">-->
<!--                        <span class="glyphicon glyphicon-folder-open"></span>-->
<!--                        我的收藏-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="menu-list-default ">-->
<!--                    <i></i>-->
<!--                    <a href="/myLink" target="targetDiv">-->
<!--                        <span class="glyphicon glyphicon-link"></span>-->
<!--                        友情链接-->
<!--                    </a>-->
<!--                </li>-->
                <li class="menu-list-default ">
                    <i></i>
                    <a href="/mySetting" target="targetDiv">
                        <span class="glyphicon glyphicon-cog"></span>
                        个人设置
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-md-10 pr-0">
        <iframe id="myIframe" src="/myPage" name="targetDiv" scrolling="no" frameborder="0"
                style="width: 100%;height: 100%;"></iframe>
    </div>

    <!--main_right end-->
</div>
<!--main end-->
<script>
    $('.menu-list-default').on('click', function (e) {
        $('.menu-list-default').removeClass('current');
        $(this).addClass('current');
    })

    // 计算页面的实际高度，iframe自适应会用到
    function calcPageHeight(doc) {
        var cHeight = Math.max(doc.body.clientHeight, doc.documentElement.clientHeight)
        var sHeight = Math.max(doc.body.scrollHeight, doc.documentElement.scrollHeight)
        var height = Math.max(cHeight, sHeight)
        return height
    }

    //根据ID获取iframe对象
    var ifr = document.getElementById('myIframe')
    ifr.onload = function () {
        //解决打开高度太高的页面后再打开高度较小页面滚动条不收缩
        ifr.style.height = '0px';
        var iDoc = ifr.contentDocument || ifr.document
        var height = calcPageHeight(iDoc)
        if (height < 850) {
            height = 950;
        }
        ifr.style.height = height + 'px'
    }
</script>