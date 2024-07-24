<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Recruiter;
use App\Rules\ImageOrString;
use App\Utilities\Sanitizer;

class RecruiterFormSubmission extends Form
{
    use WithFileUploads;

    #[Validate('required|string')]
    public $description = '';

    #[Validate('required|integer')]
    public $country_id = 0;

    #[Validate('integer')]
    public $state_id = 0;
 
    #[Validate('required|string')]
    public $first_name = '';

    #[Validate('required|string')]
    public $last_name = '';

    #[Validate('string')]
    public $position = '';

    #[Validate('string')]
    public $company_name = '';

    #[Validate('string')]
    public $address1 = '';

    #[Validate('string')]
    public $address2 = '';

    #[Validate('string')]
    public $zip = '';

    #[Validate('string')]
    public $telephone = '';

    #[Validate('string')]
    public $url = '';

    #[Validate(new ImageOrString())]
    public $logo = '';

    public $action = 'save';

    public $recruiter = null;

    /**
     * Save the form
     */
    public function store() 
    {
        $this->validate();

        $logo = ($this->logo) ? $this->logo->store('recruiter_logos', 'public') : '';

        if ($this->description) {
            $this->description = Sanitizer::HTML($this->description);
        }
        $recruiter = Recruiter::create([
            'recruiter_description' => $this->description,
            'recruiter_country_id' => $this->country_id,
            'recruiter_state_id' => $this->state_id,
            'recruiter_first_name' => $this->first_name,
            'recruiter_last_name' => $this->last_name,
            'recruiter_position' => $this->position,
            'recruiter_company_name' => $this->company_name,
            'recruiter_address1' => $this->address1,
            'recruiter_address2' => $this->address2,
            'recruiter_zip' => $this->zip,
            'recruiter_telephone' => $this->telephone,
            'recruiter_url' => $this->url,
            'recruiter_logo' => $this->logo,
        ]);

        $this->recruiter = $recruiter;
        $user = Auth::user();
        $user->recruiter_id = $recruiter->recruiter_id;
        $user->save();
        return $recruiter->recruiter_id;
    }

    /**
     * Save the form
     */
    public function update($recruiter)
    {
        $this->validate();

        if (!empty($this->logo) && ($this->logo instanceof \Illuminate\Http\UploadedFile)) {
            $logo = $this->logo->store('recruiter_logos', 'public');
        } else {
            $logo = $this->logo;
        }
        if ($this->description) {
            $this->description = Sanitizer::HTML($this->description);
        }
        $recruiter->update([
            'recruiter_description' => $this->description,
            'recruiter_country_id' => $this->country_id,
            'recruiter_state_id' => $this->state_id,
            'recruiter_first_name' => $this->first_name,
            'recruiter_last_name' => $this->last_name,
            'recruiter_position' => $this->position,
            'recruiter_company_name' => $this->company_name,
            'recruiter_address1' => $this->address1,
            'recruiter_address2' => $this->address2,
            'recruiter_zip' => $this->zip,
            'recruiter_telephone' => $this->telephone,
            'recruiter_url' => $this->url,
            'recruiter_logo' => $logo,
        ]);

        return $recruiter->recruiter_id;
    }
}
