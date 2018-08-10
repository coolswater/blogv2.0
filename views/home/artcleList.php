<!--最新文章 start-->
<div class="artcle_list">
    <h5 class="card-header bg-white">
        <span class="glyphicon glyphicon-th-list icon"></span>
        <?= $category ?>
    </h5>
    <ul class="list-unstyled">
        <?php foreach ($artcleList as $artcle): ?>
            <li class="media">
                <a href="<?= $artcle['url'] ?>" target="_blank">
                    <img class="mr-3 artcle_thumb rounded" src="<?= $artcle['thumb'] ?>" alt="文章缩略图">
                </a>
                <div class="media-body">
                    <h5 class="mt-1 mb-3"><a href="<?= $artcle['url'] ?>" target="_blank"><?= $artcle['title'] ?></a>
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