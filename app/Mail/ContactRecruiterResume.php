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
use App\Models\Resume;

class ContactRecruiterResume extends Mailable
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
    public $resume;
    public $recruiter;
    public $applicant;

    public function __construct(Recruiter $recruiter, Resume $resume, $attachment = '')
    {
        $this->attachment = '';
        $this->resume = $resume;
        $this->recruiter =  $recruiter;
        $this->applicant = $resume->jobseeker;
        $this->introLines = "<p>Hello {$this->recruiter->recruiter_first_name} {$this->recruiter->recruiter_last_name}</p><p>{$this->applicant->first_name} {$this->applicant->last_name} has replied to your message regarding your resume. Please log in to your Jobspace account to check the message.</p>";
        $this->actionText = 'View Your Messages';
        $this->actionUrl = route('recruiter.dashboard') . '#messages';
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
            subject: "New Reply from Applicant for Job Ref: {$this->job->job_reference}",
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
