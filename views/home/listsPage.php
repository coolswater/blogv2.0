<!--main start-->
<div class="row main container">
    <!--main_left start-->
    <div class="main_left col-12 col-md-9 bg-white">
        <?php $this->load->view('home/artcleList'); ?>
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
    <!--main_left end-->
    <!--main_right start-->
    <div class="main_right col-12 col-md-3 bg-white pt-3">
        <!--专题-->
        <?php $this->load->view('home/subject'); ?>
        <div class="right_ads">
            <img class="w-100" src="/assets/images/right_ads.jpg"/>
        </div>
        <!--猜你喜欢 start-->
        <?php $this->load->view('home/randArtcle'); ?>
    </div>
    <!--main_right end-->
</div>
<!--main end-->