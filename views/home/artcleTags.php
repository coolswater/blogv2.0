<!--我的标签 start-->
<div class="my-tags">
    <h5 class="card-header bg-white"><span class="glyphicon glyphicon-tags icon"></span>我的标签</h5>
    <div class="mt-2 tag-list">
        <?php foreach ($myTagList as $tag): ?>
            <a href="#" class=""><?= $tag['tag_name'] ?></a>
        <?php endforeach; ?>
    </div>
</div>
<!--我的标签 end-->