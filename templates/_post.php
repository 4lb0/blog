    <p>
        <?= $description ?>
    </p>
    <p>
        Publicado el <?= print_date($date) ?>
        en <a href="tag-<?= link_tag($tags[0]) ?>.html"><?= $tags[0] ?></a>.
        <?php if (isset($update_date)): ?>
            Actualizado el <?= print_date($update_date) ?>.
        <?php endif; ?>
    </p>
