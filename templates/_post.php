    <p><?= $description ?></p>
    <p>
        Publicado el <?= print_date($date) ?>.
    </p>
    <p>
        <?php if (count($tags)): ?>
            Etiquetas:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
