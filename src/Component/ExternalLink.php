<?php
declare(strict_types=1);

namespace App\Component;

class ExternalLink 
{
    public bool $preventWrapper = true;
    public string $href;

    public function __toString()
    {
        return "<a href=\"$this->href\" target=\"_blank\">$this->childContent ⬈</a>";
    }
}
