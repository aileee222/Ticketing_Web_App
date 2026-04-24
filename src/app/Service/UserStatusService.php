<?php

namespace App\Service;

use App\Enums\UserStatusEnum;

class UserStatusService
{
    public function info(int $value): array
    {
        $enum = UserStatusEnum::from($value);

        return [
            'label' => $enum->label(),
            'value' => $enum->value,
        ];
    }
}