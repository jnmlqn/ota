<?php

namespace App\Events;

use App\Models\JobPost;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobPostCreatedEvent
{
    use Dispatchable, SerializesModels;

    private JobPost $jobPost;

    public function setJobPost(JobPost $jobPost): self
    {
        $this->jobPost = $jobPost;

        return $this;
    }

    public function getJobPost(): JobPost
    {
        return $this->jobPost;
    }
}
