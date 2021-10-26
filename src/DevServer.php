<?php

namespace Blog;

class DevServer 
{
    const TITLE = 'albo.ar';
    const LOGO = '💡';
    const TAGS_URL = '/tag';
    const IMAGES_URL = '/images';

    public function __invoke()
    {
        $url = pathinfo($_SERVER['REQUEST_URI']);
        $render = new Render();
        if ($url['filename'] === '') {
            echo $render('home', ['posts' => (new Posts)()]);
        } elseif ($url['dirname'] === static::IMAGES_URL) {
            echo file_get_contents(__DIR__ . '/../public' . $_SERVER['REQUEST_URI']);
        } elseif ($url['dirname'] === static::TAGS_URL) {
            $posts = (new Posts)($url['filename']);
            echo $render('tags', ['posts' => $posts, 'tag' => $url['filename']]);
        } else {
            echo $render->post($url['filename']);
        }
    }
}
