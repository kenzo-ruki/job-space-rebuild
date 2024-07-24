<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\LaravelDriver\MailerSendTrait;

class JobExpiry extends Mailable
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
    public $recruiter;

    public function __construct($recruiter, $jobs)
    {
        $this->recruiter = $recruiter;
        $introLines = "These job listing(s):\n\n";
        foreach ($jobs as $index => $job) {
            $introLines .= ($index + 1) . ". " . $job->job_title . " - " . $job->job_reference. "\n";
        }
        $introLines .= "\n will expire in 6 days. If you'd like to relist it for another 36 days, please log in to your Jobspace account or contact your Account Manager.";

        $this->introLines = $introLines;
        $this->actionText = 'View Your Dashboard';
        $this->actionUrl = route('recruiter.dashboard') . '#current-jobs';
        $this->outroLines = '<p>Best regards,</p><p>Jobspace Team</p>';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: "Hello {$this->recruiter->recruiter_first_name} {$this->recruiter->recruiter_last_name}",
        );
        return $envelope;
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
