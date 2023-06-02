<?php

setlocale(LC_ALL, 'es_AR.UTF-8');
date_default_timezone_set('UTC');

require 'vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__)->load();

define('BLOG_DEFAULT_LOGO', '💡');
define('BLOG_TAGS_PREFIX', 'tag-');
define('BLOG_URL', $_ENV['BLOG_URL']);
