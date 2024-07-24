<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Livewire\Forms\ResumeFormSubmission;
use Livewire\WithFileUploads;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Zone;
use App\Models\Country;
use App\Models\Resume;
use App\Utilities\FlashMessage;

class ResumeForm extends Component
{
    use WithFileUploads;

    public ResumeFormSubmission $form;

    public $zones = [];
    public $successMessage;

    /**
     * Create a new component instance.
     */
    public function mount(Resume $resume = null, $recruiter = false)
    {

        /**
         * Initialize the edit form
         */
        if ($resume && $resume?->id) {
            $this->form->resume = $resume;
            $this->form->title = $resume->title;
            $this->form->objective = $resume->objective;
            $this->form->job_type = array_map('intval', explode(',', $resume->job_type_id));
            $this->form->job_category = array_map('intval', explode(',', $resume->job_category));
            $this->form->zone = $resume->region;
            $this->form->country = $resume->country;
            $this->form->relocate = $resume->relocate;
            $this->form->searchable = $resume->searchable;
            $this->form->resume_text = $resume->resume_text;
            $this->form->resume_file = $resume->resume;
            $this->form->photo = $resume->photo;
            if ($recruiter) {
                $this->form->action = 'none';
            } else {
                $this->form->action = 'update';
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
        return view('forms.resume-form', [
            'job_types' => JobType::all()->toArray(),
            'categories' => JobCategory::all()->toArray(),
            'countries' => Country::all()->sortBy('name')->toArray(),
            'zones' => $this->zones,
        ]);
    }

    public function countryChanged() 
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
    }

    /**
     * Save the form
     */
    public function save()
    {
        try {
            $resume_id = $this->form->store();
            return redirect()->to("/resume/$resume_id");
        } catch (\Exception $e) {
            FlashMessage::error('There was an error saving this resume.' . $e->getMessage());
            return;
        }
    }

    /**
     * Update the form
     */
    public function update()
    {
        try {
            $resume_id = $this->form->update();
            FlashMessage::success('Your resume has been updated.');
            return redirect()->to("/resume/$resume_id");
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this resume.');
            return;
        }
    }
}
