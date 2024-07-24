<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruiter;
use App\Models\Job;
use App\Mail\NewRecruiter;
use Illuminate\Support\Facades\Mail;
use App\Repositories\JobRepository;
use App\Models\ApplicantInteraction;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;

class RecruiterController extends Controller
{
    private $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    //
    public function dashboard()
    {
        $recruiter = null;
        $currentJobs = [];
        $currentApplications = [];
        $users = [];
        $recruiter = auth()->user()->recruiter;
        $jobs = Job::where('recruiter_id', '=', $recruiter?->recruiter_id);
        $allJobs = $jobs->get();
        $totalViews = $allJobs->sum(function ($job) {
            return $job->jobStatistics->viewed ?? 0;
        });
        $currentJobs = $jobs->whereDate('created_at', '<=', Carbon::now())
            ->whereDate('expired', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();
        $currentJobIds = $currentJobs->pluck('job_id');
        $currentApplications = Application::with(['job', 'user'])
            ->whereIn('job_id', $currentJobIds)
            ->get()
            ->groupBy('job_id');
        if (null !== $recruiter) {
            $users = User::where('recruiter_id', '=', $recruiter?->recruiter_id)->get();
        } else {
            $recruiter = new Recruiter();
        }

        $messageCount = $this->getMessageCount();

        return view('recruiter.dashboard',
            [
                'recruiter' => $recruiter,
                'currentJobs' => $currentJobs,
                'totalViews' => $totalViews,
                'messageCount' => $messageCount,
                'currentApplications' => $currentApplications,
                'users' => $users,
            ]
        );
    }

    //
    public function single(String $recruiter_company_seo_name)
    {
        $recruiter = Recruiter::where('recruiter_company_seo_name', '=', $recruiter_company_seo_name)->first();
        $jobs = Job::where('recruiter_id', '=', $recruiter->recruiter_id);
        $currentJobs = $this->jobRepository->applyFilters($jobs);
        return view('recruiter.single', ['recruiter' => $recruiter, 'jobs' => $currentJobs]);
    }

    public function createUser()
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        
        $recruiter = auth()->user()->recruiter;
        $data['recruiter_id'] = $recruiter?->recruiter_id;
        $data['password'] = bcrypt($data['password']);
        
        $user = User::create($data);
        $user->assignRole('recruiter');

        return redirect()->back();
    }

    public function subscriptions()
    {
        $recruiter = auth()->user()->recruiter;
        $subscriptions = $recruiter->accountHistories()
            ->where('plan_for', 'job_post')
            ->orderBy('start_date', 'desc')
            ->get();
        return view('recruiter.subscriptions.list', ['subscriptions' => $subscriptions]);
    }

    public function getMessageCount()
    {
        $recruiter = auth()->user()->recruiter;

        // Get all job ids for the recruiter
        $jobIds = Job::where('recruiter_id', $recruiter->recruiter_id)->pluck('job_id');

        // Get all application ids for those jobs
        $applicationIds = Application::whereIn('job_id', $jobIds)->pluck('id');

        // Get count of all interactions for those applications
        $applicationInteractionsCount = ApplicantInteraction::whereIn('application_id', $applicationIds)->count();

        // Get count of interactions sent by the recruiter with application_id of 0
        $directInteractionsCount = ApplicantInteraction::where('recruiter_id', $recruiter->recruiter_id)
            ->where('application_id', 0)
            ->count();

        // Sum the two counts
        $allInteractionsCount = $applicationInteractionsCount + $directInteractionsCount;

        return $allInteractionsCount;
    }
}
