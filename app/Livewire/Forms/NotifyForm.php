<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Livewire\Forms\NotifyFormSubmission;
use App\Utilities\FlashMessage;

class NotifyForm extends Component
{
    public NotifyFormSubmission $form;

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
        return view('forms.notify-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        $this->form->store();
        $this->form->reset();

        FlashMessage::success('Thanks for getting in touch. You will receive notifications of any matching roles.');
        return redirect()->to(URL::previous());
    }
}
