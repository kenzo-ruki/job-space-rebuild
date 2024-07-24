<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Resume;
use App\Utilities\Sanitizer;
use Illuminate\Support\Facades\Storage;

class ResumeFormSubmission extends Form
{
    use WithFileUploads;

    #[Validate('required|string')]
    public $title = '';
 
    #[Validate('string')]
    public $objective = '';

    public $job_type = [];

    public $job_category = [];

    #[Validate('string')]
    public $country = '';

    #[Validate('string')]
    public $zone = '';

    public $relocate = 0;

    public $searchable = 0;

    #[Validate('string')]
    public $resume_text = '';

    #[Validate('nullable|mimes:pdf,doc,docx|max:51200')]
    public $resume_file = '';
 
    #[Validate('image|max:51200')]
    public $photo = '';

    public $action = 'save';

    public $resume = null;

    /**
     * Save the form
     */
    public function store() 
    {
        $this->validate();
        
        if (is_array($this->job_category)) {
            $category_ids = implode(', ', $this->job_category);
        } else {
            $category_ids = $this->job_category;

        }
        if (is_array($this->job_type)) {
            $job_type_ids = implode(', ', $this->job_type);
        } else {
            $job_type_ids = $this->job_type;

        }

        $resume_file = '';
        $photo = ($this->photo) ? $this->photo->store('resume_photos', 'public') : '';
        $filename = '';
        if ($this->resume_file) {
            $folder = date("Ym"); // Get current year and month
            $storagePath = 'resumes/' . $folder; // Define the storage path
        
            // Check if the folder exists, if not create it
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->makeDirectory($storagePath);
            }
        
            // Get the original filename without extension
            $originalFilename = pathinfo($this->resume_file->getClientOriginalName(), PATHINFO_FILENAME);
        
            // Get the original extension
            $extension = $this->resume_file->getClientOriginalExtension();
        
            // Generate a unique filename
            $filename = $folder . rand(100, 999) . $originalFilename . '.' . $extension;
        
            // Store the file in the new folder with the new filename
            $this->resume_file->storeAs($storagePath, $filename, 'public');
        }

        $user = Auth::user();
        $resume = Resume::create([
            'jobseeker_id' => $user->jobseeker_id,
            'title' => $this->title,
            'objective' => $this->objective,
            'job_type_id' => $job_type_ids,
            'job_category' => $category_ids,
            'country' => $this->country,
            'region' => $this->zone,
            'relocate' => $this->relocate ? 1 : 0,
            'searchable' => $this->searchable ? 1 : 0,
            'resume_text' => !empty($this->resume_text) ? Sanitizer::HTML($this->resume_text) : '',
            'resume' => $filename,
            'photo' => $photo,
        ]);

        $this->resume = $resume;
        return $resume->id;
    }

    /**
     * Save the form
     */
    public function update() 
    {
        $this->validate();
        
        if (is_array($this->job_category)) {
            $category_ids = implode(', ', $this->job_category);
        } else {
            $category_ids = $this->job_category;

        }
        if (is_array($this->job_type)) {
            $job_type_ids = implode(', ', $this->job_type);
        } else {
            $job_type_ids = $this->job_type;

        }

        $resume_file = '';
        $filename = '';
        $photo = ($this->photo) ? $this->photo->store('resume_photos', 'public') : '';
        if ($this->resume_file) {
            $folder = date("Ym"); // Get current year and month
            $storagePath = 'resumes/' . $folder; // Define the storage path
        
            // Check if the folder exists, if not create it
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->makeDirectory($storagePath);
            }
        
            // Get the original filename without extension
            $originalFilename = pathinfo($this->resume_file->getClientOriginalName(), PATHINFO_FILENAME);
        
            // Get the original extension
            $extension = $this->resume_file->getClientOriginalExtension();
        
            // Generate a unique filename
            $filename = $folder . rand(100, 999) . $originalFilename . '.' . $extension;
        
            // Store the file in the new folder with the new filename
            $resume_file = $this->resume_file->storeAs($storagePath, $filename, 'public');
        }

        $user = Auth::user();
        $this->resume->update([
            'jobseeker_id' => $user->jobseeker_id,
            'title' => $this->title,
            'objective' => $this->objective,
            'job_type_id' => $job_type_ids,
            'job_category' => $category_ids,
            'country' => $this->country,
            'region' => $this->zone,
            'relocate' => $this->relocate ? 1 : 0,
            'searchable' => $this->searchable ? 1 : 0,
            'resume_text' => Sanitizer::HTML($this->resume_text),
            'resume' => $resume_file,
            'photo' => $photo,
        ]);

        return $this->resume->id;
    }
}
