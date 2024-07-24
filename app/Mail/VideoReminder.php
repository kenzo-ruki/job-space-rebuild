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

class VideoReminder extends Mailable
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
        $this->introLines = "<p>We noticed you haven't recorded your video profile yet, and we're here to give you a friendly reminder. 😉</p><p>A 1-minute video profile is your chance to shine! Employers love to see the real you - it's more than just words on a resume. Your personality, enthusiasm, and skills can truly come to life on camera.</p><p>🌟 If you've already recorded a video, kudos to you! 🌟 Keep up the fantastic work!</p><p>So, if you haven't already recorded one, take a moment to create a 1 min video profile! Whether it's on your phone, laptop, or computer, it's just 1 minute - you've got this!</p><p>Remember, your video profile could be the difference-maker in landing your dream job. Don't let this opportunity slip away!</p><p>Here's how: Simply log in to your account, go to your Dashboard, and look for the \"Record a video profile\" button.</p><p>Best regards,</p><p>Jobspace Team</p>";
        $this->actionText = 'View Your Dashboard';
        $this->actionUrl = route('jobseeker.dashboard') . '#resumes';
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
