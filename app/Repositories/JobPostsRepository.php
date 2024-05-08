<?php

namespace App\Repositories;

use App\Dto\JobPostDto;
use App\Models\JobPost;

class JobPostsRepository
{
    public function __construct(
        private JobPost $jobPost
    ) {
        $this->jobPost = $jobPost;
    }

    public function index(): array
    {
        $jobPosts = JobPost::with('submittedBy:id,name')->get()->toArray();

        return array_map(function ($jobPost) {
            $jobPost['submitted_by'] = $jobPost['submitted_by']['name'];

            return $jobPost;
        }, $jobPosts);
    }

    public function create(JobPostDto $dto): array
    {
        $jobPost = $this->jobPost->create($dto->toArray());

        return $jobPost->toArray();
    }

    public function updateStatus(string $id, string $status): bool
    {
        $jobPost = $this->jobPost->findOrFail($id);
        $jobPost->status = $status;
        $jobPost->save();

        return true;
    }
}
