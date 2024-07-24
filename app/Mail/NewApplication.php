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
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class NewApplication extends Mailable
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

    public function __construct(Job $job, Application $application)
    {
        $this->job = $job;
        $this->application = $application;
        $this->recruiter = $job->recruiter;
        $this->applicant = $application->user;
        $this->introLines = "<p>Hello {$this->recruiter->recruiter_first_name} {$this->recruiter->recruiter_last_name}</p><p><p>A new application from {$this->applicant->first_name} {$this->applicant->last_name} has been received for the position of {$this->job->job_title} listed on Jobspace. The reference number for this job is {$this->job->job_reference}.</p><p>To review and download the application, please log in to your Jobspace account. You can access the application and any accompanying documents from your dashboard.</p><p>Should you have any questions or need assistance, feel free to contact us at site@jobspace.co.nz.</p>";
        $this->actionText = 'View Your Applications';
        $this->actionUrl = route('recruiter.dashboard') . '#current-jobs';
        $this->outroLines = '<p>Best regards,</p><p>Jobspace Team</p>';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: "New Application for {$this->job->job_title} - {$this->job->job_reference}",
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
        return [
            Attachment::fromPath($this->attachment),
        ];
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
