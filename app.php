<?php

require_once 'common.php';

use Blog\Posts;

$url = pathinfo($_SERVER['REQUEST_URI'])['filename'];
$staticFile = __DIR__ . '/public' . $_SERVER['REQUEST_URI'];

if ($url === '') {
    echo render('home', ['posts' => Posts::list()]);
} elseif (file_exists($staticFile) && is_file($staticFile)) {
    return false;
} elseif (substr($url, 0, strlen(BLOG_TAGS_PREFIX)) === BLOG_TAGS_PREFIX) {
    $tag = substr($url, strlen(BLOG_TAGS_PREFIX));
    echo render('tags', ['posts' => Posts::listByTag($tag), 'tag' => $tag]);
} elseif (Posts::exists($url)) {
    $post = Posts::get($url);
    echo render($post['template'], $post);
} else {
    header('HTTP/1.0 404 Not Found');
    echo '<html><body>404 Not Found</body></html>';
}
