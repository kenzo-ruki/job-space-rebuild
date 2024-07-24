<?php

namespace App\Livewire\SaveJob;

use Livewire\Component;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class SaveFeaturedJob extends Component
{
    public $jobId;
    public $saved = false;

    public function mount($jobId, $saved)
    {
        $this->jobId = $jobId;
        $this->saved = $saved;
    }

    public function save($jobId)
    {
        if (Auth::user() && Auth::user()->hasRole('jobseeker')) {
            $user = Auth::user();
            // Check if a SavedJob with the same user_id and job_id already exists
            if (SavedJob::where('jobseeker_id', $user->jobseeker_id)->where('job_id', $jobId)->exists()) {
                $this->saved = true;
                return;
            }
            $savedJob = new SavedJob();
            $savedJob->jobseeker_id = $user->jobseeker_id;
            $savedJob->job_id = $jobId;
            $savedJob->save();
            $this->saved = true;
            // Store the saved jobs in the session
            session(['saved_jobs' => SavedJob::where('jobseeker_id', $user->jobseeker_id)->get()]);
        }
    }

    public function delete($jobId)
    {
        if (Auth::user() && Auth::user()->hasRole('jobseeker')) {
            $user = Auth::user();
            $savedJob = SavedJob::query()
                ->where('job_id', '=', $jobId)
                ->where('jobseeker_id', '=', $user->jobseeker_id)
                ->first();
            $savedJob->jobseeker_id = $user->jobseeker_id;
            $savedJob->job_id = $jobId;
            $savedJob->delete();
            $this->saved = false;
            // Store the saved jobs in the session
            session(['saved_jobs' => SavedJob::where('jobseeker_id', $user->jobseeker_id)->get()]);
        }
    }

    public function render()
    {
        $savedJobs = session('saved_jobs', collect());
        $this->saved = $savedJobs->contains('job_id', $this->jobId);
        
        return view('livewire.save-job.save-featured-job');
    }

}
