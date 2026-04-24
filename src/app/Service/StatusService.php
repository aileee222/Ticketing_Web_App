<?php

namespace App\Service;

use App\Enums\StatusEnum;

class StatusService
{
    // public function label(int $value): string
    // {
    //     return StatusEnum::fromValue($value)->label();
    // }

    // public function cssClass(int $value): string
    // {
    //     return StatusEnum::fromValue($value)->cssClass();
    // }

    public function info(int $value): array
    {
        $enum = StatusEnum::from($value);

        return [
            'label' => $enum->label(),
            'class' => $enum->cssClass(),
            'value' => $enum->value,
        ];
    }
}