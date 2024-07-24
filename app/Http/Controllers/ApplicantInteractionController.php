<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\ApplicantInteraction;
use App\Models\ResumeInteraction;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;

class ApplicantInteractionController extends Controller
{

    public function messages()
    {   
        $recruiter = auth()->user()->recruiter;
        // Get all job ids for the recruiter
        $jobIds = Job::where('recruiter_id', $recruiter->recruiter_id)->pluck('job_id');

        // Get all application ids for those jobs
        $applicationIds = Application::whereIn('job_id', $jobIds)->pluck('id');

        // Get all interactions for those applications
        $applicationInteractions = ApplicantInteraction::whereIn('application_id', $applicationIds)->get();

        // Get interactions sent by the recruiter with application_id of 0
        $directInteractions = ApplicantInteraction::where('recruiter_id', $recruiter->recruiter_id)
            ->where('application_id', 0)
            ->get();

        // Merge the two collections
        $allInteractions = $applicationInteractions->concat($directInteractions);

        // Get the jobseeker user for each interaction
        $allInteractions->each(function ($interaction) {
            $interaction->jobseeker = $interaction->application_id != 0 ? Application::find($interaction->application_id)->jobseeker : $interaction->jobseeker;
        });

        $resumeMessages = ResumeInteraction::where('recruiter_id', $recruiter->recruiter_id)->get();
        // Sort by date
        $messages = $allInteractions->sortByDesc('created_at');
        return view('recruiter.messages.list', ['messages' => $messages, 'resumeMessages' => $resumeMessages]);
    }

    /**
     * Present .
     */
    public function reply(ApplicantInteraction $message)
    {
        //
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        $message->jobseeker = $message->application_id != 0 ? $application->jobseeker : $message->jobseeker;
        $jobseeker = User::where('jobseeker_id', '=', $message->jobseeker->jobseeker_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $jobseeker = User::where('jobseeker_id', '=', $application->jobseeker_id)->get()->first();
        return view('recruiter.messages.contact', ['message' => $message, 'application' => $application, 'jobseeker' => $jobseeker]);
    }

    /**
     * Present .
     */
    public function view(ApplicantInteraction $message)
    {
        //
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        $message->jobseeker = $message->application_id != 0 ? $application->jobseeker : $message->jobseeker;
        $jobseeker = User::where('jobseeker_id', '=', $message->jobseeker->jobseeker_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }
        $jobseeker = User::where('jobseeker_id', '=', $application->jobseeker_id)->get()->first();
        return view('recruiter.messages.view', ['message' => $message, 'application' => $application, 'jobseeker' => $jobseeker]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function download(ApplicantInteraction $message, Application $application)
    {
        $user = auth()->user();
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (!$user->recruiter_id || $user->recruiter_id !== $job->recruiter_id) {
            abort(403);
        }

        // Define the file path
        $filename = $message->attachment_file;
        $folder = substr($filename, 0, 8); // Extracts the first 6 characters
        $filePath = storage_path(join(DIRECTORY_SEPARATOR, ['app', 'public', 'recruiter_mail_attachment', $folder, $filename]));
        // Create a new File instance
        $file = new File($filePath);
        // Guess the mime type
        $mimeType = $file->getMimeType();
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$message->attachment_file.'"',
        ];
        return response()->download($filePath, null, $headers);
    }
}
