<?php

namespace App\Mail;

use App\Models\Recruiter;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\LaravelDriver\MailerSendTrait;

class JobAlertMail extends Mailable
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
    public $user;

    public function __construct($user, $jobs)
    {
        $this->user = $user;
        $introLines = "Exciting news! We've found some new job opportunities that match your criteria. Here they are:\n\n";
        foreach ($jobs as $index => $job) {
            $recruiter = Recruiter::find($job->recruiter_id);
            $introLines .= ($index + 1) . ". " . $job->job_title . " - " . $recruiter->recruiter_first_name . " " . $recruiter->recruiter_last_name . "\n";
        }
        $introLines .= "\nTo view more details and apply, visit your dashboard.\n\nHappy exploring!";

        $this->introLines = $introLines;
        $this->actionText = 'View Your Dashboard';
        $this->actionUrl = route('jobseeker.dashboard') . '#saved-jobs';
        $this->outroLines = '<p>Best regards,</p><p>Jobspace Team</p>';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: "Hello {$this->user->first_name} {$this->user->last_name}",
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
