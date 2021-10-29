<?php

require __DIR__ . '/vendor/autoload.php';

setlocale(LC_ALL, 'es_AR.UTF-8');

use Blog\Posts;

$url = pathinfo($_SERVER['REQUEST_URI']);
$staticFile = __DIR__ . '/public' . $_SERVER['REQUEST_URI'];

if ($url['filename'] === '') {
    echo render('home', ['posts' => Posts::list()]);
} elseif (substr($url['filename'], 0, strlen(BLOG_TAGS_PREFIX)) === BLOG_TAGS_PREFIX) {
    $tag = substr($url['filename'], strlen(BLOG_TAGS_PREFIX));
    echo render('tags', ['posts' => Posts::listByTag($tag), 'tag' => $tag]);
} elseif (Posts::exists($url['filename'])) {
    $post = Posts::get($url['filename']);
    echo render($post['template'], $post);
} elseif (file_exists($staticFile) && is_file($staticFile)) {
    return false;
} else {
    header('HTTP/1.0 404 Not Found');
    echo '<html><body>404 Not Found</body></html>';
}
