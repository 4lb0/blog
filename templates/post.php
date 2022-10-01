<?php include 'header.php'; ?>
<main>
    <p>
        <a href="." aria-label="Ver todos los artículos">
            <?= getenv('BLOG_TITLE') ?>
        </a>
    </p>
    <h1><?= $title ?></h1>
    <p>
        <?= $description ?>
    </p>
    <article>
    <?= $post ?>
    </article>
    <p>
        <em>
            Publicado por <strong><?= $author ?? getenv('BLOG_AUTHOR') ?></strong> el <?= print_date($date) ?>
            en <a href="tag-<?= link_tag($tags[0]) ?>.html"><?= $tags[0] ?></a>.
            <?php if (isset($update_date)): ?>
                Actualizado el <?= print_date($update_date) ?>.
            <?php endif; ?>
        </em>
    </p>
    </p>
  </main>
<?php include 'footer.php'; ?>
