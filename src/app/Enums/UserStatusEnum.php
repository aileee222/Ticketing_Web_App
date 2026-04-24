<?php

namespace App\Enums;

enum UserStatusEnum: int
{
    case TEST = 9;
    case MANAGER = 2;
    case DEVELOPPER = 1;
    case CLIENT = 0;

    public function label(): string
    {
        return match($this) {
            self::TEST => 'test',
            self::MANAGER => 'Manager',
            self::DEVELOPPER => 'Developper',
            self::CLIENT => 'Client',
        };
    }

    public static function fromValue(int $value): self
    {
        return self::tryFrom($value) ?? self::TEST;
    }
    
    public static function fromString(string $value): self
    {
        return match($value) {
            'test' => self::TEST,
            'Manager' => self::MANAGER,
            'Developper' => self::DEVELOPPER,
            'Client' => self::CLIENT,
            default => self::TEST,
        };
    }
}