<!--专题 start-->
<div class="card">
    <?php foreach ($subjectList as $key => $subject): ?>
        <?php if ($key === 0): ?>
            <div class="card-body">
                <span class="badge badge-primary">专题</span>
                <h5 class="card-title small_title">
                    <a href="<?= $subject['url'] ?>" target="_blank"><?= $subject['title'] ?></a>
                </h5>
                <p class="card-text">
                    <?= $subject['summary'] ?>
                </p>
            </div>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <li class="list-group-item small_title">
                    <a href="<?= $subject['url'] ?>" target="_blank"><?= $subject['title'] ?></a>
                </li>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<!--专题 end-->