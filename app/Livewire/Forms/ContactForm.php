<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Livewire\Forms\ContactFormSubmission;
use App\Utilities\FlashMessage;

class ContactForm extends Component
{
    public ContactFormSubmission $form;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.contact-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        $this->form->store();
        $this->form->reset();

        FlashMessage::success('Thanks for getting in touch. We\'ll respond shortly.');
        return redirect()->to(URL::previous());
    }
}
