<?php include 'header.php'; ?>
<main>
    <p>
        <a href="."><?= $_ENV['BLOG_TITLE'] ?></a>
    </p>
    <h1><?= $title ?></h1>
    <article>
        <p>
            <?= $description ?>
        </p>
        <?= $post ?>
    </article>
    <p>
        <em>
            Publicado por <strong><?= $author ?? $_ENV['BLOG_AUTHOR'] ?></strong> el <?= print_date($date) ?>
            en <a href="tag-<?= link_tag($tags[0]) ?>.html"><?= $tags[0] ?></a>.
            <?php if (isset($update_date)): ?>
                Actualizado el <?= print_date($update_date) ?>.
            <?php endif; ?>
        </em>
    </p>
    </p>
  </main>
<?php include 'footer.php'; ?>
