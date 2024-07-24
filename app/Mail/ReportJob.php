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

class ReportJob extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    public $reason;
    public $actionText;
    public $actionUrl;
    public $introLines;
    public $outroLines;

    public function __construct(Job $job, $email, $reason, $message)
    {
        $this->introLines = '<p>Someone has reported the job ' . $job->job_title . ' as being ' . $reason . '.</p>';
        $this->actionText = 'View The Reported Job';
        $this->actionUrl = route('jobs.single_id', ['job' => $job]);
        $this->outroLines = '<p>User email is: ' . $email .'<p>Message from user: ' . $message. '</p>';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'JobSpace Reported Job By User',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(markdown: 'emails.report.job');
    }
}
