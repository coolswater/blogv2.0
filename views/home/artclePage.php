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
        <div class="artcle_header pb-2">
            <h4><?= $artcle['title'] ?></h4>
            <ul class="nav_list mt-4">
                <li title="作者">来源：<?= $artcle['nickName'] ?></li>
                <li title="发布时间">日期：<?= $artcle['publishTime'] ?></li>
                <li title="阅读量">阅读： <?= $artcle['hits'] ?></li>
            </ul>
        </div>
        <div class="summary">
            <?= $artcle['summary'] ?>
        </div>
        <div class="artcle_content mt-4">
            <?= $artcle['content'] ?>
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
        <!--评论列表-->
        <?php $this->load->view('home/commentList') ?>
    </div>
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-12 col-md-3 bg-white pt-3 pb-3">
        <!--专题 start-->
        <?php $this->load->view('home/subject') ?>
        <div class="right_ads">
            <img class="w-100" src="/assets/images/right_ads.jpg"/>
        </div>
        <!--猜你喜欢 start-->
        <?php $this->load->view('home/randArtcle') ?>
        <!--我的标签 start-->
        <?php $this->load->view('home/artcleTags') ?>
    </div>
    <!--main_right end-->
</div>
<!--main end-->