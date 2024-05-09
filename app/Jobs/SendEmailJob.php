<?php

namespace App\Jobs;

use App\Mail\JobPostCreatedMail;
use App\Models\JobPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private JobPost $jobPost
    ) {
        $this->jobPost = $jobPost;
        $this->onQueue('EmailNotificationQueue');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->jobPost->submittedBy->email)->send(
            new JobPostCreatedMail($this->jobPost)
        );
    }
}
