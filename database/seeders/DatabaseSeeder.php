<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Job;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // set data skill
        $params_skills = [
            [
                'name' => 'PHP',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'PostgreSQL',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'API (JSON, REST)',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Version Control System (Gitlab, Github)',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
        ];

        Skill::insert($params_skills);

        $params_job = [
            [
                'name' => 'Frontend Web Developer',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fullstack Web Developer',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Quality Control',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
        ];

        Job::insert($params_job);
    }
}
