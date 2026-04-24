<?php

namespace App\Service;

use Carbon\Carbon;

class GetTicketInvoicing
{
    public function get(string $date)
    {
        $target = Carbon::parse($date);
        $now = Carbon::now();

        $nbHours = $now->floatDiffInHours($target); 

        $factor = 20;

        return round($factor * $nbHours, 2);
    }
}