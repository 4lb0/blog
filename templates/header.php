<!doctype html>
<html lang="es">
<head>
  <title><?= (isset($title) ? "$title - " : "") . getenv('BLOG_TITLE') ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($description)): ?>
  <meta name="description" content="<?= $description ?>">
<?php endif; ?>
  <link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20100%20100%22%3E%3Ctext%20y=%22.9em%22%20font-size=%2290%22%3E<?= getenv('BLOG_LOGO') ?: BLOG_DEFAULT_LOGO ?>%3C/text%3E%3C/svg%3E">
  <style>
<?php echo file_get_contents('https://cdn.jsdelivr.net/gh/4lb0/blouse.css@latest/dist/blouse-critical.css') ?>
main { margin-bottom: 4em }
article img { display: block; width:100%; max-width:800px; margin: auto; }
.youtube-embed { display: block; margin: auto; width: 100%; max-width: 560px; height: 315px; }
  </style>
  <link rel="preload" href="https://cdn.jsdelivr.net/gh/4lb0/blouse.css@latest/dist/blouse-non-critical.css" media="screen" crossorigin="anonymous" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="/styles.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
</head>
<body>
