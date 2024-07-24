<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\ResumeVideo;

class ResumeVideoForm extends Component
{

    /**
     * Create a new component instance.
     */
    public function mount()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.resume-video-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        $video_path = '';
        $resume = ResumeVideo::create([
            'user_id' => auth()->user()->id,
            'video_path' => $video_path,
        ]);

        return redirect()->route('resume.show', $resume);
    }
}
