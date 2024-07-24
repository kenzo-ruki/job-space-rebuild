<?php

namespace App\Livewire\Jobseeker;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;

class UpdateOptions extends Component
{

    #[Validate('boolean')]
    public $newsletter = false;

    #[Validate('integer')]
    public $contact_details_visibility = false;

    #[Validate('boolean')]
    public $cv_visible = false;

    public $successMessage;

    /**
     * Save the form
     */
    public function mount() 
    {
        $user = User::find(auth()->user()->id);
        $this->contact_details_visibility = $user->contact_details_visibility;
        $this->cv_visible = $user->cv_visible ? true : false;
        $this->newsletter = $user->newsletter ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('jobseeker.update-options');
    }

    /**
     * Save the form
     */
    public function update() 
    {
        try {
            $this->validate();
            $user = User::find(auth()->user()->id);
            $newsletter = $this->newsletter ? 1 : 0;
            $cv_visible = $this->cv_visible ? 1 : 0;
            $user->update([
                'newsletter' => $newsletter,
                'cv_visible' => $cv_visible,
                'contact_details_visibility' => $this->contact_details_visibility,
            ]);
            $user->save();
            $this->successMessage = 'Options updated successfully!';
            return;
        } catch (\Exception $e) {
            $this->successMessage = 'There was an error updating your options.';
            return;
        }
    }
    
}
