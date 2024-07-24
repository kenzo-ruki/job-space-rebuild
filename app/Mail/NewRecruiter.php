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

class NewRecruiter extends Mailable
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

    public function __construct($user)
    {
        $this->user = $user;
        $this->introLines = '<p>Congratulations on registering with Jobspace, a 100% Kiwi-owned jobsite in New Zealand. You\'ve taken the first step towards finding top talent for your company.</p><p>Your account has been successfully created. Now you can start posting job listings, searching resumes, and connecting with qualified candidates today.</p><p>We\'re thrilled to partner with you on your hiring journey. If you have any questions or need assistance, please don\'t hesitate to reach out to us at site@jobspace.co.nz.</p>';
        $this->actionText = 'View Your Dashboard';
        $this->actionUrl = route('recruiter.dashboard');
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
