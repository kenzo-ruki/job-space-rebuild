<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\LaravelDriver\MailerSendTrait;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class DeclineApplicant extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;


    /**
     * The email subject line.
     */
    public $subject;
    public $actionText;
    public $actionUrl;
    public $introLines;
    public $outroLines;
    public $job;
    public $application;
    public $recruiter;
    public $applicant;

    public function __construct(Job $job, Application $application)
    {
        $this->job = $job;
        $this->application = $application;
        $this->recruiter = $job->recruiter;
        $this->applicant = $application->user;
        $this->introLines = "<p>Hello {$this->applicant->first_name} {$this->applicant->last_name}</p><p>This email notification is to inform you that your application for {$job->job_title} (Job Ref: {$job->job_reference}) at {$this->recruiter->recruiter_first_name} {$this->recruiter->recruiter_last_name} has been unsuccessful. The employer has decided not to proceed with your application, and unfortunately, the reason for this decision is unknown to us.</p>";
        $this->actionText = 'View Your Application';
        $this->actionUrl = route('apply.view', ['application' => $application, 'job' => $job]);
        $this->outroLines = '<p>Best regards,</p><p>Jobspace Team</p>';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Your Application Update: Job Ref {$this->job->job_reference}",
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(markdown: 'emails.contact.applicant');
    }
}
