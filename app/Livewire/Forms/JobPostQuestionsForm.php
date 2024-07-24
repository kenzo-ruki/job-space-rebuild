<?php

namespace App\Livewire\Forms;

use App\Filament\Admin\Widgets\Job;
use Livewire\Component;
use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Utilities\FlashMessage;

class JobPostQuestionsForm extends Component
{
    public $job;
    public $recruiter;
    public $questions = [];
    public $newQuestion = '';

    public function mount($job)
    {
        $this->job = $job;
        $this->recruiter = $this->job->recruiter;
        $this->questions = JobQuestion::where('job_id', $this->job->job_id)->get()->toArray();
    }

    public function addQuestion()
    {
        $this->questions[] = ['text' => ''];
    }

    public function removeQuestion($question_id)
    {
        $jobQuestion = JobQuestion::find($question_id);

        if ($jobQuestion) {
            $jobQuestion->delete();
        }
        $this->questions = JobQuestion::where('job_id', $this->job->job_id)->get()->toArray();
        FlashMessage::success('Job question deleted successfully.');
    }

    public function save()
    {
        foreach ($this->questions as $question) {
            $jobQuestion = JobQuestion::find($question['id']);
            $jobQuestion->update(['question' => $question['question']]);
        }
        if ($this->newQuestion) {
            JobQuestion::create([
                'job_id' => $this->job->job_id,
                'recruiter_id' => $this->recruiter->recruiter_id,
                'question' => $this->newQuestion,
            ]);
        }
        $this->questions = JobQuestion::where('job_id', $this->job->job_id)->get()->toArray();
        
        FlashMessage::success('Job questions saved successfully.');
    }

    public function render()
    {
        $this->questions = JobQuestion::where('job_id', $this->job->job_id)->get()->toArray();
        return view('forms.job-post-questions-form', ['questions' => $this->questions]);
    }
}