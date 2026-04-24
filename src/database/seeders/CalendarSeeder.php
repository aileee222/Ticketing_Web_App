<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calendar;
use App\Models\User;
class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$user = User::first();
    	$calendar = [
			[
				'name' => 'Login error', 
				'description' => 'User cannot log in with valid credentials', 
				'start' => '2026-02-06 10:30:00', 
				'end' => '2026-02-06 11:30:00',
				'user_id' => $user->id,
			],
			[
				'name' => 'API Integration', 
				'description' => 'Integrate payment gateway with backend', 
				'start' => '2026-01-01 11:30:00', 
				'end' => '2026-01-01 12:30:00',
				'user_id' => $user->id,
			],
		];
		foreach ($calendar as $cal) {
				Calendar::create($cal);
		}
    }
}
