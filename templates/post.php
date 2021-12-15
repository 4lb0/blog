<?php include 'header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="ctr"><a href="<?= $file ?>"><?= $title ?></a></h1>
    <p class="ctr sp">
        Publicado por <strong><?= $author ?? getenv('BLOG_AUTHOR') ?></strong> el <?= print_date($date) ?>.
        <?php if (count($tags)): ?>
            Tags:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
    <?php if (isset($update_date)): ?>
    <p class="ctr">
        Última actualización: <?= print_date($update_date) ?>.
    </p>
    <?php endif; ?>
    <article class="sp">
    <?= $post ?>
    </article>
  </main>
<?php include 'footer.php'; ?>
