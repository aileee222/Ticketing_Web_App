<?php

namespace App\Enums;

enum StatusEnum: int
{
    case CRITICAL = 4;
    case HIGH = 3;
    case MEDIUM = 2;
    case LOW = 1;
    case NOT_STARTED = 0;

    public function label(): string
    {
        return match($this) {
            self::CRITICAL => 'Critical',
            self::HIGH => 'High',
            self::MEDIUM => 'Medium',
            self::LOW => 'Low',
            self::NOT_STARTED => 'Not Started',
        };
    }

    public function cssClass(): string
    {
        return match($this) {
            self::CRITICAL => 'state_critical',
            self::HIGH => 'state_high',
            self::MEDIUM => 'state_medium',
            self::LOW => 'state_low',
            self::NOT_STARTED => 'state_not_started',
        };
    }

    public static function fromValue(int $value): self
    {
        return self::tryFrom($value) ?? self::NOT_STARTED;
    }
}