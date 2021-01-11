<?php
declare(strict_types=1);

namespace App\Component;

class Menu 
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function about(): void
    {
        $this->app->about();
    }

    public function __toString(): string
    {
        \ob_start(); ?>
            <p class="menu">
                <a href="/">Home</a>
                • <a @onClick="about">About me</a>
                <?php if (isset($_ENV['TWITTER'])): ?>
                    • <a href="<?= $_ENV['TWITTER'] ?>">Twitter</a>
                <?php endif; ?>
                <?php if (isset($_ENV['GITHUB'])): ?>
                    • <a href="<?= $_ENV['GITHUB'] ?>">Github</a>
                <?php endif; ?>
            </p><?php 
        return \ob_get_clean();
    }
}

