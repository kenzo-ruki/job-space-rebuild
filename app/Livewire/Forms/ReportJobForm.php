<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Utilities\FlashMessage;
use App\Mail\ReportJob;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Job;

class ReportJobForm extends Component
{

    #[Validate('required|integer')]
    public $job_id = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:5')]
    public $reason = '';
 
    #[Validate('required|min:5')]
    public $message = '';

    public function rules()
    {
        return [
            'job_id' => 'required|integer',
            'email' => 'required|email',
            'reason' =>'required|string|max:500',
            'message' =>'required|string|max:5000',
        ];
    }

    /**
     * Create a new component instance.
     */
    public function mount(Job $job)
    {
        $this->job_id = $job->job_id;
        $userObject = auth()->user();
        if (!is_null($userObject)) {
            $user = User::where('id', '=', $userObject?->id)->get()->first();
            $this->email = $user->email;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('forms.report-job-form');
    }

    /**
     * Save the form
     */
    public function save()
    {
        $this->validate();
        $job = Job::where('job_id', '=', $this->job_id)->get()->first();
        try {
            Mail::to('seth@jobspace.co.nz')
                ->send(new ReportJob($job, $this->email, $this->reason, $this->message));
                
            FlashMessage::success('Your submitted report has been sent.');
            return redirect()->to(URL::previous());
        } catch (\Exception $e) {
            FlashMessage::success('Your submitted report has been sent.');
            return redirect()->to(URL::previous());
        }
    }
}
