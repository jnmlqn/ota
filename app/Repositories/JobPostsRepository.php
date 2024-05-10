<?php

namespace App\Repositories;

use App\Dto\JobPostDto;
use App\Enums\Status;
use App\Events\JobPostCreatedEvent;
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
        $jobPosts = JobPost::with('submittedBy:id,name')
            ->where('status', Status::PUBLISHED->value)
            ->get()
            ->toArray();

        $jobPosts = array_map(function ($jobPost) {
            $jobPost['submitted_by'] = $jobPost['submitted_by']['name'];

            return $jobPost;
        }, $jobPosts);

        $xml = simplexml_load_string(file_get_contents('https://mrge-group-gmbh.jobs.personio.de/xml'), "SimpleXMLElement", LIBXML_NOCDATA);
        $externalJobPosts = json_encode($xml);
        $externalJobPosts = json_decode($externalJobPosts,TRUE);
        $externalJobPosts = array_map(function ($jobPost) {
            $description = '';

            foreach ($jobPost['jobDescriptions']['jobDescription'] as $jd) {
                $description .= $jd['name'] . "\n";
                $description .= $jd['value'] . "\n";
            }

            return [
                'title' => $jobPost['name'],
                'description' => $description,
                'sub_company' => $jobPost['subcompany'],
                'office' => $jobPost['office'],
                'department' => $jobPost['department'],
                'recruiting_category' => $jobPost['recruitingCategory'],
                'employment_type' => $jobPost['employmentType'],
                'seniority' => $jobPost['seniority'],
                'schedule' => $jobPost['schedule'],
                'years_of_exp' => $jobPost['yearsOfExperience'],
                'keywords' => explode(',', $jobPost['keywords']),
                'occupation' => $jobPost['occupation'],
                'occupation_category' => $jobPost['occupationCategory'],
                'submitted_by' => 'external',
            ];
        }, $externalJobPosts);

        return array_merge($jobPosts, $externalJobPosts);
    }

    public function create(JobPostDto $dto): array
    {
        $jobPost = $this->jobPost->create($dto->toArray());

        $event = (new JobPostCreatedEvent)->setJobPost($jobPost);
        event($event);

        return $jobPost->toArray();
    }

    public function updateStatus(string $id, string $status): bool
    {
        $jobPost = $this->jobPost->findOrFail($id);
        $jobPost->status = $status;
        $jobPost->save();

        return true;
    }

    public function getCountByEmail(string $email): int
    {
        $jobPostsCount = $this->jobPost->whereHas('submittedBy', function ($q) use ($email) {
            $q->where('email', $email);
        })->count();

        return $jobPostsCount;
    }
}
