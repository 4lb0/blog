<?php

setlocale(LC_ALL, 'es_AR.UTF-8');
date_default_timezone_set('UTC');

require 'vendor/autoload.php';

$_ENV = $_SERVER;

Dotenv\Dotenv::createImmutable(__DIR__)->safeLoad();

define('BLOG_LOGO',  $_ENV['BLOG_LOGO'] ?? '💡');
define('BLOG_TITLE', $_ENV['BLOG_TITLE'] ?? 'My Blog');
define('BLOG_TAGS_PREFIX', 'tag-');
define('BLOG_URL', $_ENV['BLOG_URL'] ?? 'http://localhost:8000');
define('BLOG_AUTHOR', $_ENV['BLOG_AUTHOR'] ?? 'Anonymous');
