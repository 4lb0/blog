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
  <style><?php echo file_get_contents(__DIR__ . '/../src/u.css') ?><?= $style ?? '' ?></style>
</head>
<body>
