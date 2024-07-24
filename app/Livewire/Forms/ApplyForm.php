<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Livewire\Forms\ApplyFormSubmission;
use Livewire\WithFileUploads;
use App\Models\JobQuestion;
use App\Models\JobQuestionResponse;
use App\Models\CoverLetter;
use App\Utilities\Sanitizer;

class ApplyForm extends Component
{
    use WithFileUploads;

    public ApplyFormSubmission $form;

    public $resumes = [];
    public $coverLetters = [];
    public $questions = [];
    public $responses = [];
    public $job = null;
    public $application = null;

    /**
     * Create a new component instance.
     */
    public function mount()
    {
        $this->form->setUser();
        
        if ($this->application && $this->application?->id) {
            $this->form->action = 'update';
            $this->form->resume = $this->application->resume_id;
            if ($this->application->cover_letter) {
                $this->form->cover_letter = Sanitizer::HTML($this->application->cover_letter);
            }
            $this->questions = JobQuestionResponse::where('application_id', '=', $this->application->id)->get();
            $this->form->setQuestions($this->questions);
            $this->responses = $this->form->responses;
        } else {
            $this->form->job_id = $this->job->job_id;
            $this->questions = JobQuestion::where('job_id', '=', $this->job->job_id)->get();
            $this->form->setQuestions($this->questions);
            $this->responses = $this->form->responses;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.apply-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        [$application_id, $job_id] = $this->form->store();

        return redirect()->to("/apply/$application_id/$job_id");
    }

    /**
     * Update the form
     */
    public function update()
    {
        [$application_id, $job_id] = $this->form->store();

        return redirect()->to("/apply/$application_id/$job_id");
    }

    public function coverLetterChanged($coverLetterId)
    {
        $coverLetter = CoverLetter::find($coverLetterId);
        $this->dispatch('coverLetterChanged', json_encode($coverLetter->text));
    }
}
