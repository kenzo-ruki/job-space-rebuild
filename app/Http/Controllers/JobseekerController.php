<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Repositories\JobRepository;
use App\Models\Job;
use App\Models\Resume;
use App\Models\ResumeVideo;
use App\Models\JobAlert;
use App\Models\CoverLetter;
use App\Models\ApplicantInteraction;
use Carbon\Carbon;

class JobseekerController extends Controller
{
    private $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    //
    public function dashboard()
    {
        $jobseeker_id = auth()->user()->jobseeker_id;
        $recommendedJobs = $this->jobRepository->getRecommendedJobs();
        $savedJobIds = session('saved_jobs', []);
        $savedJobs = Job::whereIn('job_id', $savedJobIds->pluck('job_id'))->get();
        $applications = Application::where('jobseeker_id', $jobseeker_id)->with(['job', 'resume'])->get();
        $jobAlerts = JobAlert::where('jobseeker_id', '=', $jobseeker_id)->get();
        $resumes = Resume::where('jobseeker_id', '=', $jobseeker_id)->get();
        $coverLetters = CoverLetter::where('jobseeker_id', '=', $jobseeker_id)->get();
        $video = ResumeVideo::where('jobseeker_id', '=', $jobseeker_id)->orderBy('created_at', 'desc')->first();
        $messageCount = $this->getMessageCount();

        return view('jobseeker.dashboard',
            [
                'jobAlerts' => $jobAlerts,
                'recommendedJobs' => $recommendedJobs,
                'applications' => $applications,
                'coverLetters' => $coverLetters,
                'savedJobs' => $savedJobs,
                'messageCount' => $messageCount,
                'resumes' => $resumes,
                'video' => $video,
            ]
        );
    }

    public function getMessageCount()
    {
        $jobseeker_id = auth()->user()->jobseeker_id;
        // Get all job ids for the jobseeker
        $applicationIds = Application::where('jobseeker_id', $jobseeker_id)->pluck('id');

        // Get count of all interactions for those applications
        $applicationInteractionsCount = ApplicantInteraction::whereIn('application_id', $applicationIds)->count();

        // Get count of interactions sent by the jobseeker with application_id of 0 and not in $applicationIds
        $directInteractionsCount = ApplicantInteraction::where('jobseeker_id', $jobseeker_id)
            ->whereNotIn('application_id', $applicationIds)
            ->where('application_id', 0)
            ->count();

        // Sum the two counts
        $allInteractionsCount = $applicationInteractionsCount + $directInteractionsCount;

        return $allInteractionsCount;
    }
}
