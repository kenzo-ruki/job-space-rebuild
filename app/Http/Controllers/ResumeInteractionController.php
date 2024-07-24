<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\ResumeInteraction;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;

class ResumeInteractionController extends Controller
{

    public function messages()
    {   
        $recruiter = auth()->user()->recruiter;
        // Get all interactions for those resumes
        $resumeInteractions = ResumeInteraction::where('recruiter_id', $recruiter->recruiter_id)->get();

        // Sort by date
        $messages = $resumeInteractions->sortByDesc('created_at');
        return view('recruiter.resume-messages.list', ['messages' => $messages]);
    }

    /**
     * Present .
     */
    public function reply(ResumeInteraction $message)
    {
        //
        $resume = Resume::where('id', '=', $message->resume_id)->get()->first();
        $message->jobseeker = $message->resume_id != 0 ? $resume->jobseeker : $message->jobseeker;
        $jobseeker = User::where('jobseeker_id', '=', $resume->jobseeker_id)->get()->first();
        return view('recruiter.resume-messages.contact', ['message' => $message, 'resume' => $resume, 'jobseeker' => $jobseeker]);
    }

    /**
     * Present .
     */
    public function view(ResumeInteraction $message)
    {
        //
        $resume = Resume::where('id', '=', $message->resume_id)->get()->first();
        $message->jobseeker = $message->resume_id != 0 ? $resume->jobseeker : $message->jobseeker;
        $jobseeker = User::where('jobseeker_id', '=', $resume->jobseeker_id)->get()->first();
        return view('recruiter.resume-messages.view', ['message' => $message, 'resume' => $resume, 'jobseeker' => $jobseeker]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function download(ResumeInteraction $message)
    {
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
