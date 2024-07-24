<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Utilities\FlashMessage;
use App\Mail\ContactApplicant;
use App\Models\ApplicantInteraction;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use App\Models\Job;
use App\Models\Application;
use App\Utilities\Sanitizer;
use Illuminate\Support\Facades\Storage;

class ContactApplicantForm extends Component
{
    use WithFileUploads;
 
    public $application_id = '';
    public $contact_applicant_subject = '';
    public $contact_applicant_message = '';
    public $email_attachment = null;

    public function rules()
    {
        return [
            'application_id' => 'integer',
            'contact_applicant_subject' =>'required|string|max:500',
            'contact_applicant_message' =>'required|string|max:5000',
            'email_attachment' => 'nullable|file|mimes:pdf,doc,docx|max:50000', // Add this line
        ];
    }

    /**
     * Create a new component instance.
     */
    public function mount(Application $application)
    {
        $this->application_id = $application->id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.contact-applicant-form');
    }

    /**
     * Save the form
     */
    public function save()
    {

        $application = Application::where('id', '=', $this->application_id)->get()->first();
        $job = Job::where('job_id', '=', $application->job_id)->get()->first();
        try {
            if ($this->contact_applicant_message) {
                $this->contact_applicant_message = Sanitizer::HTML($this->contact_applicant_message);
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

            //TODO add in for live site
            Mail::to('seth@jobspace.co.nz')
                ->send(new ContactApplicant($job, $application, $attachmentPath));
                $message = new ApplicantInteraction([
                    'recruiter_id' => auth()->user()->recruiter_id,
                    'jobseeker_id' => $application->jobseeker_id,
                    'application_id' => $this->application_id,
                    'subject' => $this->contact_applicant_subject,
                    'message' => $this->contact_applicant_message,
                    'attachment_file' => $filename,
                    'sender' => 'recruiter',
                ]);
                $message->save();
            FlashMessage::success('Your message has been sent to the applicant.');
            return redirect()->to(URL::previous());
        } catch (\Illuminate\Validation\ValidationException $e) {
            FlashMessage::success('Your message could not be sent.');
            return redirect()->to(URL::previous());
        }
    }
}
