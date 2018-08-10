<!--main start-->
<div class="row main container">
    <!--main_left start-->
    <div class="main_left col-12 col-md-9 bg-white">
        <!--推荐文章-->
        <?php $this->load->view('home/recommendList'); ?>
        <!--ads start-->
        <div class="md_ads">
            <img src="/assets/images/ads.jpg" class="w-100">
        </div>
        <!--ads end-->
        <!--最新文章 start-->
        <div class="artcle_list">
            <h5 class="card-header bg-white">
                <span class="glyphicon glyphicon-th-list icon"></span>
                <span id="listCategory">最新文章</span>
            </h5>
            <ul class="list-unstyled" id="artcleList">
                <?php foreach ($artcleList as $artcle): ?>
                    <li class="media">
                        <a href="<?= $artcle['url'] ?>" target="_blank">
                            <img class="mr-3 artcle_thumb rounded" src="<?= $artcle['thumb'] ?>" alt="文章缩略图">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-1 mb-3"><a href="<?= $artcle['url'] ?>"
                                                     target="_blank"><?= $artcle['title'] ?></a>
                            </h5>
                            <p class="media-content"><?= $artcle['summary'] ?></p>
                            <div class="media-footer">
                        <span class="category">
                            <a href="<?= $artcle['categoryUrl'] ?>" target="_blank"><?= $artcle['category'] ?></a>
                        </span>
                                <span>/</span>
                                <span class="author"><?= $artcle['nickName'] ?></span>
                                <span>/</span>
                                <span class="publish_time"><?= $artcle['publishTime'] ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--最新文章 end-->
    </div>
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-12 col-md-3 bg-white pt-3">
        <!--专题-->
        <?php $this->load->view('home/subject'); ?>
        <!--热门文章 -->
        <?php $this->load->view('home/hotArtcle'); ?>
        <!--右侧广告-->
        <div class="right_ads">
            <img class="w-100" src="/assets/images/right_ads.jpg"/>
        </div>
        <!--统计信息-->
        <?php $this->load->view('home/totalInfo'); ?>
    </div>
    <!--main_right end-->
</div>
<!--main end-->