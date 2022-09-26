<?php include 'header.php'; ?>
<main>
    <p class="ctr">
        <?= getenv('BLOG_LOGO') ?? BLOG_DEFAULT_LOGO ?>
        <a href=".">
            <?= getenv('BLOG_TITLE') ?>
        </a>
    </p>
    <h1><?= $title ?></h1>
    <p>
        <?= $description ?>
        <?php if (count($tags)): ?>
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html">#<?= $tag ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </p>
    <article class="sp">
    <?= $post ?>
    </article>
    <p class="sp">
        <em>
            Publicado por <strong><?= $author ?? getenv('BLOG_AUTHOR') ?></strong> el <?= print_date($date) ?>.
            <?php if (isset($update_date)): ?>
                Última actualización: <?= print_date($update_date) ?>.
            <?php endif; ?>
        </em>
    </p>
    </p>
  </main>
<?php include 'footer.php'; ?>
