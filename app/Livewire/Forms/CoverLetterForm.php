<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\CoverLetter;
use App\Utilities\FlashMessage;
use Illuminate\Support\Facades\Auth;
use App\Utilities\Sanitizer;

class CoverLetterForm extends Component
{
    public $successMessage;

    public $action = 'create';

    #[Validate('required|string')]
    public $title = '';

    #[Validate('required|string')]
    public $text = '';

    public $coverLetter = null;

    public function rules()
    {
        return [
            'title' => 'required|string',
            'text' => 'required|string',
        ];
    }

    /**
     * Create a new component instance.
     */
    public function mount(CoverLetter $coverLetter = null)
    {

        /**
         * Initialize the edit form
         */
        if ($coverLetter && $coverLetter?->id) {
            $this->coverLetter = $coverLetter;
            $this->title = $coverLetter->title;
            if ($coverLetter->text) {
                $this->text = Sanitizer::HTML($coverLetter->text);
            }
            $this->action = 'update';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.cover-letter-form');
    }

    /**
     * Save the form
     */
    public function create()
    {
        try {
            $this->validate();
            $user = Auth::user();
    
            if ($this->text) {
                $this->text = Sanitizer::HTML($this->text);
            }
            $coverLetter = CoverLetter::create([
                'jobseeker_id' => $user->jobseeker_id,
                'title' => $this->title,
                'text' => $this->text,
            ]);
            $coverLetter->save();
            $this->coverLetter = $coverLetter;
            $this->action = 'update';
            FlashMessage::success('Your cover letter has been created.');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this cover letter.');
            return;
        }
    }

    /**
     * Update the form
     */
    public function update()
    {
        try {
            $this->validate();
            if ($this->text) {
                $this->text = Sanitizer::HTML($this->text);
            }
            $this->coverLetter->update([
                'title' => $this->title,
                'text' => $this->text
            ]);
            FlashMessage::success('Your cover letter has been updated.');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this cover letter.');
            return;
        }
    }
}
