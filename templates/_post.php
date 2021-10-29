    <p class="mt-2">
        Publicado por <a href="."><?= $author ?? getenv('BLOG_AUTHOR') ?></a> el <?= print_date($date) ?>.
        <?php if (count($tags)): ?>
            Tags:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
