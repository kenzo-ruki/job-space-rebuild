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

class NewJobseeker extends Mailable
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
        $this->introLines = "<p>Welcome to Jobspace! We're excited to have you join our platform and take the first step towards finding your dream job.</p><p>Your registration is successful! You're now ready to explore and apply for jobs on jobspace.co.nz.</p><p>We'd like to highlight our unique feature: the Video Profile. A 1-minute video introduction can significantly boost your profile and help you stand out to employers. It's a great way to showcase your personality and skills, increasing your chances of getting noticed in the competitive job market.</p><p>If you haven't already, log in to your account and head to your Dashboard. Look for the \"Record a Video Profile\" button. This is your chance to make a lasting impression - don't miss it!</p><p>Thank you for choosing Jobspace. We're committed to supporting you every step of the way.</p>";
        $this->actionText = 'View Your Dashboard';
        $this->actionUrl = route('jobseeker.dashboard');
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
