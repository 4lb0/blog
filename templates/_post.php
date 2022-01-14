    <p>
        <?= $description ?>
        <?php if (count($tags)): ?>
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html">#<?= $tag ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </p>
    <p>
        <strong>
            Publicado el <?= print_date($date) ?>.
        </strong>
    </p>
