<?php

namespace App\Listeners;

use App\Events\JobPostCreatedEvent;
use App\Jobs\SendEmailJob;
use App\Repositories\JobPostsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JobPostCreatedListener
{
    public function __construct(
        private JobPostsRepository $jobPostsRepository
    ) {
        $this->jobPostsRepository = $jobPostsRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(JobPostCreatedEvent $event): void
    {
        $jobPost = $event->getJobPost();
        $jobPostsCount = $this->jobPostsRepository->getCountByEmail($jobPost->submittedBy->email);

        if ($jobPostsCount === 1) {
            SendEmailJob::dispatch($jobPost);
        }
    }
}
