<!--推荐 start-->
<div class="featured pt-3">
    <?php foreach ($recommendList as $recommend): ?>
        <div class="featured-item">
            <a href="/artcle/<?= $recommend['id'] ?>.html">
                <img class="w-100 artcle_thumb" src="<?= $recommend['thumb'] ?>">
            </a>
            <h5>
                <a href="/artcle/<?= $recommend['id'] ?>.html"><?= $recommend['title'] ?></a>
            </h5>
        </div>
    <?php endforeach; ?>
</div>
<!--推荐 end-->