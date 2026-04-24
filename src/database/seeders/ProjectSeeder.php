<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\TrashProject;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $user2 = User::find(2);

        $projects = [
            [
                'name' => 'Website Redesign',
                'description' => 'Complete overhaul of the corporate website',
                'owner' => 'Jane Doe',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'status' => 0,
                'user_id' => $user->id,
            ],
            [
                'name' => 'API Integration',
                'description' => 'Integrate payment gateway with backend',
                'owner' => 'John Smith',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'status' => 4,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Bug Fixes',
                'description' => 'Resolve top priority UI and backend bugs',
                'owner' => 'Jane Doe',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'status' => 0,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Mobile App Launch',
                'description' => 'Deploy mobile app to App Store and Play Store',
                'owner' => 'David Lee',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'status' => 2,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Performance Optimization',
                'description' => 'Improve dashboard loading time and API response',
                'owner' => 'Emma Brown',
                'tlimit' => '2026-02-06',
                'comment' => 'ras',
                'status' => 3,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Authentication System',
                'description' => 'Handles login, registration, and security features',
                'owner' => 'John Smith',
                'tlimit' => '2026-06-01',
                'comment' => 'ras',
                'status' => 1,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'Admin Panel',
                'description' => 'Internal dashboard for managing users and data',
                'owner' => 'Alice Martin',
                'tlimit' => '2026-05-15',
                'comment' => 'ras',
                'status' => 0,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'E-commerce Platform',
                'description' => 'Online store with payment integration',
                'owner' => 'Michael Brown',
                'tlimit' => '2026-07-10',
                'comment' => 'ras',
                'status' => 1,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'Mobile API',
                'description' => 'Backend API for mobile applications',
                'owner' => 'Sarah Connor',
                'tlimit' => '2026-04-30',
                'comment' => 'ras',
                'status' => 2,
                'user_id' => $user2->id,
            ],
            [
                'name' => 'Notification Service',
                'description' => 'Manages emails, SMS, and push notifications',
                'owner' => 'David Lee',
                'tlimit' => '2026-05-25',
                'comment' => 'ras',
                'status' => 0,
                'user_id' => $user2->id,
            ],
        ];

        $created = [];
        foreach ($projects as $project) {
            $created[] = Project::create($project);
        }

        $first = $created[0];

        TrashProject::create([
            'project_id'  => $first->id,
            'name'        => $first->name,
            'owner'       => $first->owner,
            'description' => $first->description,
            'tlimit'      => $first->tlimit,
            'comment'     => $first->comment,
            'status'      => $first->status,
            'user_id'     => $user->id,
        ]);

        $first->delete();

    }
}
