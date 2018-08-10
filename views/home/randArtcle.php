<!--猜你喜欢 start-->
<div class="">
    <h5 class="card-header bg-white"><span class="glyphicon glyphicon-fire icon"></span>猜你喜欢</h5>
    <ul class="list-unstyled artcle_list">
        <?php foreach ($randArtcle as $rand): ?>
            <li class="media">
                <a href="<?= $rand['url'] ?>" target="_blank">
                    <img class="mr-3 rounded artcle_thumb_small" src="<?= $rand['thumb'] ?>" alt="猜你喜欢">
                </a>
                <div class="media-body">
                    <h5 class="mt-1 small_title">
                        <a href="<?= $rand['url'] ?>" target="_blank"><?= $rand['title'] ?></a>
                    </h5>
                    <div class="media-footer">
                        <span class="author"><?= $rand['nickName'] ?></span>
                        <span class="publish_time"><?= $rand['publishTime'] ?></span>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!--猜你喜欢 end-->