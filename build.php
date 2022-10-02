<?php

require_once 'common.php';

use Blog\Posts;

setlocale(LC_ALL, 'es_AR.UTF-8');

write(
    'index',
    'home', [
        'posts' => Posts::list(), 
        'date' => get_date_from_list(Posts::list()),
    ]
);

foreach (Posts::list() as $post) {
    write($post['file'], $post['template'], $post);
}

foreach (Posts::tags() as $tag  => $posts) {
    $url = link_tag($tag);
    write(
        "tag-$url",
        'tags',
        [
            'posts' => $posts,
            'tag' => $tag,
            'date' => get_date_from_list($posts),
        ]
    );
}

sitemap();
