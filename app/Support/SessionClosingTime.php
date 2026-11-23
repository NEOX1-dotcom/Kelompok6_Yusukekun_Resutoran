<?php

namespace App\Support;

use Carbon\CarbonImmutable;

final class SessionClosingTime
{
    public const TIMEZONE = 'Asia/Makassar';

    public static function nextClosingTimestamp(): int
    {
        $now = CarbonImmutable::now(self::TIMEZONE);
        $closingTime = $now->setTime(23, 0);

        if ($now->greaterThanOrEqualTo($closingTime)) {
            $closingTime = $closingTime->addDay();
        }

        return $closingTime->getTimestamp();
    }
}
