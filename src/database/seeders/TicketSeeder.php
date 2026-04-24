<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TrashTicket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $user2 = User::find(2);

        $tickets = [
            [
                'name' => 'Login error',
                'description' => 'User cannot log in with valid credentials',
                'fromproject' => 'Website Redesign',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 4,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Password reset',
                'description' => 'Password reset email not received',
                'fromproject' => 'Bug Fixes',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 3,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Performance issue',
                'description' => 'Dashboard loading slower than expected',
                'fromproject' => 'Performance Optimization',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 1,
                'user_id' => $user->id,
            ],
            [
                'name' => 'UI bug',
                'description' => 'Button overlap on dashboard',
                'fromproject' => 'UI Improvements',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 0,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Data sync',
                'description' => 'Delay in database synchronization',
                'fromproject' => 'Database Maintenance',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 4,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Slow dashboard loading',
                'description' => 'Dashboard takes more than 10 seconds to load',
                'fromproject' => 'Admin Panel',
                'tlimit' => '2026-03-15',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 2,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'Broken image links',
                'description' => 'Images are not displayed on product pages',
                'fromproject' => 'E-commerce Platform',
                'tlimit' => '2026-03-08',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 0,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'API returns 500 error',
                'description' => 'Internal server error when fetching user data',
                'fromproject' => 'Mobile API',
                'tlimit' => '2026-03-20',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 3,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'Notification emails not sent',
                'description' => 'Users do not receive confirmation emails',
                'fromproject' => 'Notification Service',
                'tlimit' => '2026-03-18',
                'comment' => 'ras',
                'invoicing' => 145.00,
                'status' => 1,
                'user_id' => $user2->id,
            ],
        ];

        $created = [];
        foreach ($tickets as $ticket) {
            $created[] = Ticket::create($ticket);
        }

        $first = $created[0];

        TrashTicket::create([
            'ticket_id'   => $first->id,
            'name'        => $first->name,
            'fromproject' => $first->fromproject,
            'description' => $first->description,
            'tlimit'      => $first->tlimit,
            'comment'     => $first->comment,
            'invoicing'     => $first->invoicing,
            'status'      => $first->status,
            'user_id'     => $user->id,
        ]);

        $first->delete();
    }
}
