<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\ContactSubmission;

class ContactFormSubmission extends Form
{
    //    
    #[Validate('string')]
    public $first_name = '';
 
    #[Validate('string')]
    public $last_name = '';

    #[Validate('required|email')]
    public $email = '';
 
    #[Validate('numeric')]
    public $phone = '';

    #[Validate('required|min:5')]
    public $subject = '';
 
    #[Validate('required|min:5')]
    public $message = '';

    /**
     * Save the form
     */
    public function store() 
    {
        $this->validate();
        ContactSubmission::create($this->all());
    }
}
