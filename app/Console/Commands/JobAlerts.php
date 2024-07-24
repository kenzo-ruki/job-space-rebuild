<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\JobAlertMail;
use App\Models\JobAlert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Repositories\JobRepository;

class JobAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:job-alerts {frequency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify new Jobseekers of job matches';


    private $_jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->_jobRepository = $jobRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {       
        $frequency = $this->argument('frequency');

        $jobAlerts = JobAlert::where('frequency', $frequency)->get();

        foreach ($jobAlerts as $jobAlert) {
            $jobs = $this->_jobRepository->getJobsByAlertCriteria($jobAlert);
            if (!$jobs->isEmpty()) {
                $this->info($jobs->count().'jobs found for alert: '. $jobAlert->id);
                $user = User::where('jobseeker_id', $jobAlert->jobseeker_id)->first();
                $this->info('Notifying new Jobseeker job alert for user: ' . $user->id);
                //TODO add in for live site
                Mail::to('seth@jobspace.co.nz')
                    ->send(new JobAlertMail($user, $jobs));
                    die();
            }
                
        }
        $this->info('Notification completed.');
    }
}
