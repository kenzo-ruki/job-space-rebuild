<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\ResumeInteraction;
use App\Models\Resume;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;

class ResumeInteractionReplyController extends Controller
{

    public function messages()
    {   
        $jobseeker = auth()->user();
    
        // Get all interactions for those resumes
        $resumeInteractions = ResumeInteraction::whereIn('jobseeker_id', $jobseeker->jobseeker_id)->get();
    
        // Sort by date
        $messages = $resumeInteractions->sortByDesc('created_at');
        return view('jobseeker.resume-messages.list', ['messages' => $messages]);
    }
    
    public function reply(ResumeInteraction $message)
    {
        $resume = Resume::where('id', '=', $message->resume_id)->get()->first();
        $user = auth()->user();
        if (!$user->jobseeker_id || $user->jobseeker_id !== $resume->jobseeker_id) {
            abort(403);
        }
        $recruiter = Recruiter::where('recruiter_id', '=', $message->recruiter_id)->get()->first();
        return view('jobseeker.resume-messages.contact', ['message' => $message, 'resume' => $resume, 'jobseeker' => $user, 'recruiter' => $recruiter]);
    }
    
    public function view(ResumeInteraction $message)
    {
        $resume = Resume::where('id', '=', $message->resume_id)->get()->first();
        $user = auth()->user();
        if (!$user->jobseeker_id || $user->jobseeker_id !== $resume->jobseeker_id) {
            abort(403);
        }
        $recruiter = Recruiter::where('recruiter_id', '=', $message->recruiter_id)->get()->first();
        return view('jobseeker.resume-messages.view', ['message' => $message, 'resume' => $resume, 'jobseeker' => $user, 'recruiter' => $recruiter]);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function download(ResumeInteraction $message, Resume $resume)
    {
        $user = auth()->user();
        $resume = Resume::where('id', '=', $message->resume_id)->get()->first();
        if (!$user->jobseeker_id || $user->jobseeker_id !== $resume->jobseeker_id) {
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
