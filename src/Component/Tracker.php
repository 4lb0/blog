<?php

declare(strict_types=1);

namespace App\Component;

class Tracker
{
    public bool $preventWrapper = true;
    public string $id = '';

    public function __toString(): string
    {
        if (!$this->id) {
            return '';
        }
        return <<<EOH
            <script async src="https://www.googletagmanager.com/gtag/js?id={$this->id}"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag("js", new Date());
              gtag("config", "{$this->id}");
            </script>
EOH;
    }
}
