<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\ApplicantInteraction;
use App\Models\ResumeInteraction;
use App\Models\Application;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;

class RecruiterInteractionController extends Controller
{

    public function messages()
    {
        $jobseeker_id = auth()->user()->jobseeker_id;
        // Get all job ids for the jobseeker
        $applicationIds = Application::where('jobseeker_id', $jobseeker_id)->pluck('id');

        // Get count of all interactions for those applications
        $applicationInteractions = ApplicantInteraction::whereIn('application_id', $applicationIds);

        // Get count of interactions sent by the jobseeker with application_id of 0 and not in $applicationIds
        $directInteractions = ApplicantInteraction::where('jobseeker_id', $jobseeker_id)
            ->whereNotIn('application_id', $applicationIds)
            ->where('application_id', 0);

        $messages = $applicationInteractions->union($directInteractions)->get();
        $resumeMessages = ResumeInteraction::where('jobseeker_id', $jobseeker_id)->get();

        return view('jobseeker.messages.list', ['messages' => $messages, 'resumeMessages' => $resumeMessages]);
    }

    /**
     * Present .
     */
    public function reply(ApplicantInteraction $message)
    {
        //
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->jobseeker_id !== $application->jobseeker_id) {
            abort(403);
        }
        $recruiter = Recruiter::where('recruiter_id', '=', $job->recruiter_id)->get()->first();
        return view('jobseeker.messages.contact', ['message' => $message, 'application' => $application, 'recruiter' => $recruiter]);
    }

    /**
     * Present .
     */
    public function view(ApplicantInteraction $message)
    {
        //
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        if (Auth::user()->jobseeker_id !== $application->jobseeker_id) {
            abort(403);
        }
        $recruiter = Recruiter::where('recruiter_id', '=', $job->recruiter_id)->get()->first();
        return view('jobseeker.messages.view', ['message' => $message, 'application' => $application, 'recruiter' => $recruiter]);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function download(ApplicantInteraction $message, Application $application)
    {
        $user = auth()->user();
        $application = Application::where('id', '=', $message->application_id)->get()->first();
        if (!$user->jobseeker_id || $user->jobseeker_id !== $application->jobseeker_id) {
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
