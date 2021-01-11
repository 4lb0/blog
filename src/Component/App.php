<?php
declare(strict_types=1);

namespace App\Component;

use Fernet\Framework;

class App
{
    /* Component configuration */
    public bool $preventWrapper = true;
    private string $currentTitle = '';
    private string $siteTitle = '';
    private bool $showAbout = false;

    public function __construct()
    {
        $this->siteTitle = $_ENV['TITLE'];
    }

    public function about(): void
    {
        $this->showAbout = true;
        $this->setTitle('About me');
    }

    public function setTitle($title): void
    {
        $this->currentTitle = "{$title} - {$this->siteTitle}";
    }

    public function __toString(): string
    {
        $title = $this->currentTitle ?: $this->siteTitle;
        \ob_start(); ?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/styles.css">
    <title><?= $title ?></title>
  </head>
  <body>
    <h2 class="title"><a href="/"><?= $this->siteTitle ?></a></h2>
    <Menu />
    <?php if (!$this->showAbout): ?>
        <Post />
    <?php else: ?>
        <AboutMe />
    <?php endif; ?>
    <Menu />
    <FernetClientScript />
  </body>
</html><?php
    return \ob_get_clean();
    }
}
