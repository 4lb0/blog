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

    public function about()
    {
        $this->showAbout = true;
    }

    public function setTitle($title)
    {
        $this->currentTitle = "{$title} - {$this->siteTitle}";
    }

    public function __toString(): string
    {
        $title = $this->currentTitle ?: $this->siteTitle;
        ob_start(); ?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/styles.css">
    <title><?= $title ?></title>
  </head>
  <body>
    <h2 class="title"><a href="/"><?= $this->siteTitle ?></a></h2>
    <p class="menu">
        <a @onClick="about">About me</a> •
        <a href="https://twitter.com/4lb0">Twitter</a> •
        <a href="https://github.com/4lb0">Github</a>
    </p>
    <?php if (!$this->showAbout): ?>
    <Post />
    <?php else: ?>
    <AboutMe />
    <?php endif; ?>
    <FernetClientScript />
  </body>
</html><?php
    return ob_get_clean();
    }
}
