<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Utilities\FlashMessage;
use App\Mail\ContactRecruiterResume;
use App\Models\ResumeInteraction;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use App\Models\Recruiter;
use App\Models\Resume;
use App\Utilities\Sanitizer;
use Illuminate\Support\Facades\Storage;

class ContactRecruiterResumeForm extends Component
{
    use WithFileUploads;
 
    public $recruiter_id = '';
    public $resume_id = '';
    public $contact_recruiter_subject = '';
    public $contact_recruiter_message = '';
    public $email_attachment = null;

    public function rules()
    {
        return [
            'recruiter_id' => 'integer',
            'resume_id' => 'integer',
            'contact_recruiter_subject' =>'required|string|max:500',
            'contact_recruiter_message' =>'required|string|max:5000',
            'email_attachment' => 'nullable|file|mimes:pdf,doc,docx|max:50000', // Add this line
        ];
    }

    /**
     * Create a new component instance.
     */
    public function mount(Recruiter $recruiter, Resume $resume)
    {
        $this->recruiter_id = $recruiter->recruiter_id;
        $this->resume_id = $resume->id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.contact-recruiter-resume-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        $resume = Resume::where('id', '=', $this->resume_id)->get()->first();
        try {
            if ($this->contact_recruiter_message) {
                $this->contact_recruiter_message = Sanitizer::HTML($this->contact_recruiter_message);
            }
            $this->validate();
            $filename = '';
            $attachmentPath = '';
            if ($this->email_attachment) {
                $folder = date("Ymd"); // Get current year and month
                $storagePath = 'recruiter_mail_attachment/' . $folder; // Define the storage path
            
                // Check if the folder exists, if not create it
                if (!Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->makeDirectory($storagePath);
                }
            
                // Get the original filename without extension
                $originalFilename = pathinfo($this->email_attachment->getClientOriginalName(), PATHINFO_FILENAME);
            
                // Get the original extension
                $extension = $this->email_attachment->getClientOriginalExtension();
            
                // Generate a unique filename
                $filename = $folder . rand(100, 999) . $originalFilename . '.' . $extension;
            
                // Store the file in the new folder with the new filename
                $this->email_attachment->storeAs($storagePath, $filename, 'public');
                $fullPath = $storagePath . '/' . $filename;
                $attachmentPath = storage_path('app/public/' . $fullPath);
            }
            //TODO fix for live site
            Mail::to('seth@jobspace.co.nz')
                ->send(new ContactRecruiterResume($resume, $attachmentPath));
                $message = new ResumeInteraction([
                    'jobseeker_id' => auth()->user()->jobseeker_id,
                    'recruiter_id' => $recruiter->recruiter_id,
                    'resume_id' => $this->resume_id,
                    'subject' => $this->contact_recruiter_subject,
                    'message' => $this->contact_recruiter_message,
                    'attachment_file' => $filename,
                    'attachment_file' => $filename,
                    'sender' => 'jobseeker',
                ]);
                $message->save();
            FlashMessage::success('Your message has been sent to the recruiter.');
            return redirect()->to(URL::previous());
        } catch (\Illuminate\Validation\ValidationException $e) {
            FlashMessage::success('Your message could not be sent.');
            return redirect()->to(URL::previous());
        }
    }
}
