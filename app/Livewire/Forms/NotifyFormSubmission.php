<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\NotifySubmission;

class NotifyFormSubmission extends Form
{
    //    
    #[Validate('required|email')]
    public $email = '';
 
    #[Validate('required|string')]
    public $frequency = '';

    // TODO: wire to main occupations
    #[Validate('numeric')]
    public $occupation = '';

    // TODO: wire to main locations
    #[Validate('string')]
    public $location = '';

    /**
     * Save the form
     */
    public function store() 
    {
        // TODO - manage categories etc and set up notifications
        $this->validate();
        NotifySubmission::create($this->all());
    }
}
