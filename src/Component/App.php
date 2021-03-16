<?php
declare(strict_types=1);

namespace App\Component;

use Fernet\Framework;

class App
{
    /* Component configuration */
    public bool $preventWrapper = true;
    private string $currentTitle = '';
    private string $siteTitle;
    private string $siteLogo;
    private string $tracker;
    private bool $showAbout = false;

    public function __construct()
    {
        $this->siteTitle = $_ENV['APP_TITLE'] ?? $_SERVER['HTTP_HOST'];
        $this->siteLogo = $_ENV['APP_LOGO'] ?? '';
        $this->tracker = $_ENV['APP_TRACKER'] ?? '';
    }

    public function about(): void
    {
        $this->showAbout = true;
        $this->setTitle('About me');
    }

    public function setTitle($title): void
    {
        $this->currentTitle = "{$title}. {$this->siteTitle}";
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
    <link rel="stylesheet" href="/css/solarized-dark.css">
    <title><?= $title ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22><?= $this->siteLogo ?></text></svg>">
    <Tracker id="<?= $this->tracker ?>" />
  </head>
  <body>
    <h2 class="center"><a href="/"><?= $this->siteLogo ?> <?= $this->siteTitle ?></a></h2>
    <Menu />
    <?php if (!$this->showAbout): ?>
        <ShowPost />
    <?php else: ?>
        <AboutMe />
    <?php endif; ?>
    <Menu />
    <FernetClientScript />
    <A9sTracker />
  </body>
</html><?php
    return \ob_get_clean();
    }
}
