    <p class="mt-2">
        <?= $description ?>
    </p>
    <p>
        Publicado el <?= print_date($date) ?>.
    </p>
    <p>
        <?php if (count($tags)): ?>
            Tags:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
