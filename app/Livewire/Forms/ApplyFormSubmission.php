<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Application;
use App\Utilities\Sanitizer;
use App\Models\JobQuestionResponse;
use Carbon\Carbon;

class ApplyFormSubmission extends Form
{
    use WithFileUploads;

    public $resumes = [];
    public $questions = [];
    public $responses = [];

    #[Validate('required|string')]
    public $first_name = '';
 
    #[Validate('required|string')]
    public $last_name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|string')]
    public $cover_letter = '';
 
    #[Validate('required|integer')]
    public $resume = null;

    #[Validate('required|integer')]
    public $job_id = null;

    public $action = 'save';

    public function setUser()
    {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
    }

    public function setQuestions($questions = [])
    {
        $this->questions = $questions;
        foreach ($questions as $question) {
            if ($this->action == 'update') {
                $response = $question->response;
            } else {
                $response = '';
            }
            $this->responses[] = [
                'question' => $question->question,
                'response' => $response,
            ];
        }
    }

    /**
     * Save the form
     */
    public function store() 
    {
        $current_timestamp = Carbon::now()->timestamp;
        $jobseeker_id = Auth::user()->jobseeker_id; 
        $application_id = $current_timestamp . '-' . $this->job_id . '-' . $jobseeker_id;
        if ($this->cover_letter) {
            $this->cover_letter = Sanitizer::HTML($this->cover_letter);
        }
        $application = Application::create([
            'jobseeker_id' => $jobseeker_id,
            'job_id' => $this->job_id,
            'resume_id' => $this->resume,
            'cover_letter' => $this->cover_letter,
            'application_id' => $application_id,
        ]);
        foreach ($this->responses as $response) {
            JobQuestionResponse::create([
                'application_id' => $application->id,
                'jobseeker_id' => $jobseeker_id,
                'question' => $response['question'],
                'response' => $response['response'],
            ]);
        }
        return [$application->id, $this->job_id];
    }
}
