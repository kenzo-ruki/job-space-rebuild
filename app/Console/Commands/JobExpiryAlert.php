<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\JobExpiry;
use App\Models\Job;
use App\Models\Recruiter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class JobExpiryAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:job-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify recruiters of expiring jobs';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $expiryDate = Carbon::now()->addDays(6);
        $jobs = Job::whereDate('expired', $expiryDate)
                    ->orderBy('recruiter_id', 'desc')
                    ->get();
        $jobsGroupedByRecruiter = $jobs->groupBy('recruiter_id');
    
        foreach ($jobsGroupedByRecruiter as $recruiterId => $jobsForRecruiter) {
            $recruiter = Recruiter::find($recruiterId); // Assuming the recruiter is a User
            if ($recruiter) {
                $this->info('Notifying Recruiter of Expiring Jobs for Recruiter : ' . $recruiter->recruiter_id);
                Mail::to('seth@jobspace.co.nz')
                    ->send(new JobExpiry($recruiter, $jobsForRecruiter));
            }
            die();
        }
    
        $this->info('Notification completed.');
    }
}
