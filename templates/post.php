<?php include 'header.php'; ?>
<main>
    <p>
        <a href="."><?= $_ENV['BLOG_TITLE'] ?></a>
    </p>
    <h1><?= $title ?></h1>
    <article>
        <p>
            <em>
                Tiempo estimado de lectura:
                <?= $readingTime ?> minuto<?php if ($readingTime != 1): ?>s<?php endif; ?>.
            </em>
        </p>
        <p>
            <?= $description ?>
        </p>
        <?php if ($illustration): ?>
            <img src="<?= $illustration ?>.svg" class="s" alt="" />
            <?= $post ?>
            <p>
                <em>
                    La Ilustración es de <a href=https://undraw.co/license rel="noopener noreferrer" target=_blank>Katerina Limpitsouni</a>
                    publicada en <a href=https://undraw.co/ rel="noopener noreferrer" target=_blank>unDraw</a>.
                </em>
            </p>
        <?php else: ?>
            <?= $post ?>
        <?php endif ?>
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
