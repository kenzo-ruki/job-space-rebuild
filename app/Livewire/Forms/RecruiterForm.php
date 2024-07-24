<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Livewire\Forms\RecruiterFormSubmission;
use Livewire\WithFileUploads;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Zone;
use App\Models\Country;
use App\Models\Recruiter;
use Illuminate\Support\Str;
use App\Utilities\FlashMessage;

class RecruiterForm extends Component
{
    use WithFileUploads;

    public RecruiterFormSubmission $form;

    public $zones = [];
    public $successMessage;
    public $recruiter;

    /**
     * Create a new component instance.
     */
    public function mount(Recruiter $recruiter = null)
    {

        /**
         * Initialize the edit form
         */
        if ($recruiter && $recruiter?->recruiter_id) {
            $this->form->first_name = $recruiter->recruiter_first_name;
            $this->form->last_name = $recruiter->recruiter_last_name;
            $this->form->position = $recruiter->recruiter_position;
            $this->form->company_name = $recruiter->recruiter_company_name;
            $this->form->logo = $recruiter->recruiter_logo;
            $this->form->description = $recruiter->recruiter_description;
            $this->form->address1 = $recruiter->recruiter_address1;
            $this->form->address2 = $recruiter->recruiter_address2;
            $this->form->state_id = $recruiter->recruiter_state_id;
            $this->form->country_id = $recruiter->recruiter_country_id;
            $this->form->zip = $recruiter->recruiter_zip;
            $this->form->telephone = $recruiter->recruiter_telephone;
            $this->form->url = $recruiter->recruiter_url;
            $this->form->action = 'update';
            $this->recruiter = $recruiter;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country_id)->get();
        return view('forms.recruiter-form', [
            'countries' => Country::all()->sortBy('name')->toArray(),
            'zones' => $this->zones,
        ]);
    }

    public function countryChanged() 
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country_id)->get();
    }

    /**
     * Save the form
     */
    public function save()
    {
        try {
            $this->form->store();
            FlashMessage::success('Company updated successfully!');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating the Company details.');
            return;
        }
    }

    /**
     * Update the form
     */
    public function update()
    {
        try {
            $this->form->update($this->recruiter);
            FlashMessage::success('Company updated successfully!');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating the Company details.');
            return;
        }
    }
}
