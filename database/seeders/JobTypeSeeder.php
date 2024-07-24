<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobType;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobTypes = [
            [1, 'Full-time'],
            [2, 'Part-time'],
            [3, 'Contract'],
            [4, 'Permanent'],
            [5, 'Temporary'],
        ];

        foreach ($jobTypes as $jobType) {
            JobType::create([
                'id' => $jobType[0],
                'type_name' => $jobType[1],
            ]);
        }
    }
}
