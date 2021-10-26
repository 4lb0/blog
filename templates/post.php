<?php include __DIR__ . '/header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="text-center"><?= $title ?></h1>
    <?php include __DIR__ . '/_post.php'; ?>
    <article class="mt-2">
    <?= $post ?>
    </article>
  </main>
<?php include __DIR__ . '/footer.php'; ?>
