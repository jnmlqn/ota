<?php

namespace App\Jobs;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use App\Models\User;
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
        $role = Role::where('name', RoleEnum::MODERATOR->value)->first();
        $moderator = User::where('role_id', $role->id)->first();

        if ($moderator) {
            Mail::to($moderator->email)->send(
                new JobPostCreatedMail($this->jobPost, $moderator)
            );
        }
    }
}
