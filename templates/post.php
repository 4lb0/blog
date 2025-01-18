<?php include 'header.php'; ?>
<main>
    <p>
        <a href="."><?= BLOG_TITLE ?></a>
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
        <?php if (isset($illustration) && $illustration): ?>
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
  </main>
    <p>
        <em>
            Publicado por <strong><?= $author ?? BLOG_AUTHOR ?></strong> el <?= print_date($date) ?>
            en <a href="tag-<?= link_tag($tags[0]) ?>.html"><?= $tags[0] ?></a>.
            <?php if (isset($update_date)): ?>
                Actualizado el <?= print_date($update_date) ?>.
            <?php endif; ?>
        </em>
    </p>
    <p style="color:#902593;padding-top:2em">
        Este blog respeta tu privacidad, no guarda analíticas ni cookies.
        Si te gusto este artículo puedes darle me gusta de manera anónima.
    </p>
    <form method="POST" action="//stats.albo.ar" style="text-align:center">
        <input type="hidden" name="url" value="<?= BLOG_URL ?>/<?= $url ?>">
        <input type="email" name="email" placeholder="No escribas nada aca, es solo para bots" aria-hidden="true" />
        <input type="submit" value="👍" aria-label="Me gusta" style="font-size:2.5em;cursor:pointer" />
    </form>
<?php include 'footer.php'; ?>
