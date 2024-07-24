<?php

namespace App\Utilities;

use App\Models\JobStatistics;

class JobStatAdder
{
    public static function view($jobId)
    {
        $jobStatistics = JobStatistics::firstOrCreate(
            ['job_id' => $jobId],
            ['viewed' => 1, 'clicked' => 0, 'applications' => 0]
        );
    
        $jobStatistics->viewed += 1;
        $jobStatistics->save();
    }

    public static function click($jobId)
    {
        $jobStatistics = JobStatistics::firstOrCreate(
            ['job_id' => $jobId],
            ['viewed' => 0, 'clicked' => 1, 'applications' => 0]
        );
    
        $jobStatistics->clicked += 1;
        $jobStatistics->save();
    }

    public static function apply($jobId)
    {
        $jobStatistics = JobStatistics::firstOrCreate(
            ['job_id' => $jobId],
            ['viewed' => 0, 'clicked' => 0, 'applications' => 1]
        );
    
        $jobStatistics->applications += 1;
        $jobStatistics->save();
    }
}
