<!--footer start-->
<div class="container-fluid bg-dark">
    <div class="footer container pt-2 pb-2">
        <div class="col-12 col-md-8">
            <span class="col-md-3 pl-0"><span class="glyphicon glyphicon-link">友情链接：</span></span>
            <?php foreach ($friendLink as $link): ?>
                <a class="text-light mr-3 text-uppercase" href="<?= $link['url'] ?>"
                   target="_blank"><?= $link['name'] ?></a>
            <?php endforeach; ?>
        </div>
        <div class="col-12 col-md-6">Copyright © 2017-2018 京ICP备16001516号-2</div>
    </div>

    <div id="leftsead">
        <ul>
            <li>
                <a href="https://github.com/coolswater">
                    <img src="/assets/images/github.png" title="GitHub" width="47" height="49" class="shows"/>
                </a>
            </li>
            <li>
                <a class="youhui">
                    <img src="/assets/images/l02.png" width="47" height="49" class="shows"/>
                    <img src="/assets/images/wechat.jpg" title="Wechat" class="hides" usemap="#taklhtml"/>
                </a>
            </li>
            <li>
                <a id="top_btn">
                    <img src="/assets/images/l06.png" width="47" height="49" class="shows"/>
                </a>
            </li>
        </ul>
    </div><!--leftsead end-->


</div>
<!--footer end-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<!--<script src="/assets/js/share.min.js"></script>-->
<script src="/assets/js/bootstrap-paginator.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/myjs.js"></script>
</body>
</html>