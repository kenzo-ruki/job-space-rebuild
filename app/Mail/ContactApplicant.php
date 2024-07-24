<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\LaravelDriver\MailerSendTrait;
use App\Models\Recruiter;
use App\Models\Job;
use App\Models\Application;

class ContactApplicant extends Mailable
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
    public $attachment;
    public $job;
    public $application;
    public $recruiter;
    public $applicant;

    public function __construct(Job $job, Application $application, $attachment = '')
    {
        $this->job = $job;
        $this->attachment = '';
        $this->application = $application;
        $this->recruiter = Recruiter::where('recruiter_id', $job->recruiter_id)->first();
        $this->applicant = $application->jobseeker;
        $this->introLines = "<p>Hello {$this->applicant->first_name} {$this->applicant->last_name}</p><p>You have received a new message regarding the job {$job->job_title} (Reference Number: {$job->job_reference}) from {$this->recruiter->recruiter_first_name} {$this->recruiter->recruiter_last_name}. Please log in to your Jobspace account to check the message.</p>";
        $this->actionText = 'View Your Applications';
        $this->actionUrl = route('jobseeker.dashboard') . '#applications';
        $this->outroLines = '<p>Best regards,</p><p>Jobspace Team</p>';
        if ($attachment && !empty($attachment)) {
            $this->attachment = $attachment;
            $this->attachments();
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: "New Reply from Employer for Job Ref: {$this->job->job_reference}",
        );
        return $envelope;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->attachment && !empty($this->attachment)) {
            return [
                Attachment::fromPath($this->attachment),
            ];
        }
    
        return [];
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
