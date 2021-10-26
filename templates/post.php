<?php include __DIR__ . '/header.php'; ?>
<main>
    <h1 class="text-center"><?= $title ?></h1>
    <?php include __DIR__ . '/_post.php'; ?>
    <article class="mt-2">
    <?= $post ?>
    </article>
    <p class="mt-4"><a href=".">← Ver todos los artículos</a>
  </main>
<?php include __DIR__ . '/footer.php'; ?>
