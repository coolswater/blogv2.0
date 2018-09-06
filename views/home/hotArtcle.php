<!--热门文章 start-->
<div class="">
    <h5 class="card-header bg-white"><span class="glyphicon glyphicon-fire icon"></span>热门文章</h5>
    <ul class="list-unstyled artcle_list hot_list">
        <?php foreach ($hotArtcleList as $key => $hot): ?>
            <li class="media">
                <a href="<?= $hot['url'] ?>" target="_blank">
                    <img class="mr-3 rounded artcle_thumb_small" src="/assets/images/Parallax.jpg" alt="热门文章"></a>
                <div class="media-body">
                    <h5 class="mt-1 small_title">
                        <a href="<?= $hot['url'] ?>" target="_blank"><?= $hot['title'] ?></a>
                    </h5>
                    <?php if ((int)$key !== 0): ?>
                        <div class="media-footer"><?= $hot['hits'] ?> 人已阅读</div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!--热门文章 end-->