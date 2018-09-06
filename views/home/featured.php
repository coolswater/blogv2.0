<div class="card-deck mt-3 mb-3">
    <?php foreach ($recommendList as $recomment): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title h6"><?= $recomment['title'] ?></h5>
                <p class="card-text"><?= $recomment['summary'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>