<?php

setlocale(LC_ALL, 'es_AR.UTF-8');
date_default_timezone_set('UTC');

require 'vendor/autoload.php';

$_ENV = $_SERVER;
var_dump($_ENV);

Dotenv\Dotenv::createImmutable(__DIR__)->safeLoad();

define('BLOG_DEFAULT_LOGO', '💡');
define('BLOG_TAGS_PREFIX', 'tag-');
define('BLOG_URL', $_ENV['BLOG_URL']);
