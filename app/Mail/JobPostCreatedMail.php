<?php

namespace App\Mail;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobPostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private JobPost $jobPost,
        private User $moderator
    ) {
        $this->jobPost = $jobPost;
        $this->moderator = $moderator;
        $this->onQueue('EmailNotificationQueue');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->jobPost->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $token = $this->moderator->createToken(
            'basic', 
            ['ota:job_status'],
            now()->addHour()
        )->plainTextToken;

        return new Content(
            view: 'job_posts.email.created',
            with: [
                'id' => $this->jobPost->id,
                'token' => $token,
                'submitted_by' => $this->jobPost->submittedBy->email,
                'description' => $this->jobPost->description,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
