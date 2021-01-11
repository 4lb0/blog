<?php
declare(strict_types=1);

namespace App\Component;

use DateTime;

class PostDate 
{
    public $timestamp;

    private function parseDate(int $time): string
    {
        $dateTime = new DateTime();
        $dateTime->setTimestamp($time);
        return $dateTime->format('l jS F Y');
    }

    public function __toString(): string
    {
        $date = $this->parseDate((int) $this->timestamp);
        return <<<EOH
            <p>
                <span class="date">Posted on {$date}</span>
            </p>
EOH;
    }
}
