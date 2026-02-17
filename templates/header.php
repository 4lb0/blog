<!doctype html>
<html lang="es">
<head>
  <title><?= (isset($title) ? "$title - " : "") . BLOG_TITLE ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($description)): ?>
  <meta name="description" content="<?= strip_tags(remove_new_lines($description)) ?>">
<?php endif; ?>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><text y='14' x='0'><?= BLOG_LOGO ?></text></svg>">
  <link rel="alternate" type="application/rss+xml" title="<?= BLOG_TITLE ?> RSS Feed" href="rss.xml">
  <style><?php echo file_get_contents(__DIR__ . '/../src/u.css') ?><?= $style ?? '' ?></style>
</head>
<body>
