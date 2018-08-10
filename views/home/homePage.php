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
        <!--ads 最新文章-->
        <?php $this->load->view('home/artcleList'); ?>
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
        <?php $this->load->view('home/artcleTags'); ?>
        <!--统计信息-->
        <?php $this->load->view('home/totalInfo'); ?>
    </div>
    <!--main_right end-->
</div>
<!--main end-->