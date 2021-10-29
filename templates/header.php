<!doctype html>
<html lang="es">
<head>
  <title><?= (isset($title) ? "$title - " : "") . getenv('BLOG_TITLE') ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($description)): ?>
  <meta name="description" content="<?= $description ?>">
<?php endif; ?>
  <link rel="icon" href="data:image/svg+xml,&lt;svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22&gt;&lt;text y=%22.9em%22 font-size=%2290%22&gt;<?= getenv('BLOG_LOGO') ?: BLOG_DEFAULT_LOGO ?>&lt;/text&gt;&lt;/svg&gt;">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/4lb0/blouse.css@latest/dist/blouse.css" media="screen" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles.css" media="screen">
</head>
<body>
