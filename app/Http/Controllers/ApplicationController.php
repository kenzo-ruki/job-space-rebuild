<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Resume;
use App\Models\User;
use App\Models\Application;
use App\Models\CoverLetter;
use App\Models\ApplicantInteraction;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeclineApplicant;
use Illuminate\Support\Facades\Mail;
use App\Utilities\FlashMessage;
use App\Utilities\JobStatAdder;

class ApplicationController extends Controller
{
    /**
     * Create a single application.
     */
    public function create(Job $job)
    {
        //
        $resumes = Resume::where('jobseeker_id', '=', auth()->user()->jobseeker_id)->get();
        $user = auth()->user();
        $coverLetters = CoverLetter::where('jobseeker_id', $user->jobseeker_id)->get();
        $application = null;
        JobStatAdder::apply($job->job_id);
        return view('jobseeker.application.apply', compact('job', 'resumes', 'application', 'coverLetters'));
    }

    /**
     * Create a single application.
     */
    public function update(Application $application, int $job_id)
    {
        //
        $job = Job::where('job_id', '=', $job_id)->get()->first();
        $user = auth()->user();
        $coverLetters = CoverLetter::where('jobseeker_id', $user->jobseeker_id)->get();
        $resumes = Resume::where('jobseeker_id', '=', $user->jobseeker_id)->get();
        return view('jobseeker.application.apply', compact('job', 'resumes', 'application', 'coverLetters'));
    }

    /**
     * Remove the specified resource from saved searches.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect('/jobseeker/dashboard#applications');
    }

    /**
     * Review a single application.
     */
    public function review(Application $application)
    {
        //
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $user = User::where('jobseeker_id', '=', $application->jobseeker_id)->get()->first();
        $resume = Resume::where('id', '=', $application->resume_id)->get()->first();
        return view('recruiter.applications.view', compact('job', 'resume', 'application', 'user'));
    }

    /**
     * Create a single application.
     */
    public function contact(Application $application)
    {
        //
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $jobseeker = User::where('jobseeker_id', '=', $application->jobseeker_id)->get()->first();
        $message = ApplicantInteraction::where('application_id', '=', $application->id)->get()->last();
        return view('recruiter.applications.contact', ['message' => $message, 'application' => $application, 'jobseeker' => $jobseeker]);
    }

    /**
     * Create a single application.
     */
    public function statusUpdate(Application $application, $status=1)
    {
        //
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $application->status = $status;
        $application->save();
        if (6 === $status || '6' === $status) {
            try {
                $user = User::where('jobseeker_id', '=', $application->jobseeker_id)->get()->first();
                $job = Job::where('job_id', '=', $application->job_id)->get()->first();
                //Mail::to($user->email)
                Mail::to('seth@jobspace.co.nz')
                    ->send(new DeclineApplicant($job, $application));
                FlashMessage::success('The applicant has been notified that their application has been declined.');
                return redirect()->back();
            } catch (\Exception $e) {
                FlashMessage::error('The applicant was unable to be notified that their application has been declined');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    /**
     * View single job applications
     */
    public function list(Job $job)
    {
        //
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $applications = Application::where('job_id', '=', $job->job_id)->with('jobseeker')->get();
        return view('recruiter.applications.list', compact('job', 'applications'));
    }
}
