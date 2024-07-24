<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Livewire\Forms\ResumeSearchFormSubmission;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Zone;

class ResumeSearchForm extends Component
{

    public ResumeSearchFormSubmission $form;

    public $zones = [];
    public $keywords = '';
    public $resumes = [];
    public $job_types = []; 
    public $categories = []; 

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
        $this->job_types = JobType::all()->toArray();
        $this->categories = JobCategory::all()->toArray();
        return view('forms.resume-search-form');
    }

    /**
     * Save the form
     */
    public function search()
    {
        $result = $this->form->validate();

        // Redirect to controller search method
        return redirect()->route('resume.search', [
            'job_type' => $this->form->job_type,
            'keywords' => $this->form->keywords,
            'country' => $this->form->country, 
            'job_category' => $this->form->job_category,
            'zone' => $this->form->zone,
        ]);
    }

    public function countryChanged() 
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
    }
}
