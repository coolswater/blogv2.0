<!--main start-->
<div class="row main container">
    <!--main_left start-->
    <div class="main_left col-12 col-md-9 bg-white">
        <?php $this->load->view('home/featured'); ?>
        <?php $this->load->view('home/artcleList'); ?>
    </div>
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-12 col-md-3 bg-white pt-3">
        <div class="right_ads">
            <img class="w-100" src="/assets/images/right_ads.jpg"/>
        </div>
        <!--猜你喜欢 start-->
        <?php $this->load->view('home/randArtcle'); ?>
    </div>
    <!--main_right end-->
</div>
<!--main end-->