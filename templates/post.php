<?php include __DIR__ . '/header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="text-center"><a href="<?= $file ?>"><?= $title ?></a></h1>
    <p class="text-center mt-2 mute">
        Publicado por <strong><?= $author ?? getenv('BLOG_AUTHOR') ?></strong> el <?= print_date($date) ?>.
        <?php if (count($tags)): ?>
            Tags:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
    <?php if (isset($update_date)): ?>
    <p class="text-center mute">
        Última actualización: <?= print_date($update_date) ?>.
    </p>
    <?php endif; ?>
    <article class="mt-2">
    <?= $post ?>
    </article>
  </main>
<?php include __DIR__ . '/footer.php'; ?>
