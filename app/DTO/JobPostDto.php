<?php

namespace App\DTO;

class JobPostDto
{
    private string $title;
    private string $description;
    private string $subCompany;
    private string $office;
    private string $department;
    private string $recruitingCategory;
    private string $status = 'unpublished';
    private string $employmentType;
    private string $seniority;
    private string $schedule;
    private int $yearsOfExp;
    private array $keywords;
    private string $occupation;
    private string $occupationCategory;
    private int $submittedBy;

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setSubCompany(string $subCompany): self
    {
        $this->subCompany = $subCompany;

        return $this;
    }

    public function getSubCompany(): string
    {
        return $this->subCompany;
    }

    public function setOffice(string $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getOffice(): string
    {
        return $this->office;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setRecruitingCategory(string $recruitingCategory): self
    {
        $this->recruitingCategory = $recruitingCategory;

        return $this;
    }

    public function getRecruitingCategory(): string
    {
        return $this->recruitingCategory;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setEmploymentType(string $employmentType): self
    {
        $this->employmentType = $employmentType;

        return $this;
    }

    public function getEmploymentType(): string
    {
        return $this->employmentType;
    }

    public function setSeniority(string $seniority): self
    {
        $this->seniority = $seniority;

        return $this;
    }

    public function getSeniority(): string
    {
        return $this->seniority;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    public function setYearsOfExp(int $yearsOfExp): self
    {
        $this->yearsOfExp = $yearsOfExp;

        return $this;
    }

    public function getYearsOfExp(): int
    {
        return $this->yearsOfExp;
    }

    public function setKeywords(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getKeywords(): array
    {
        return $this->keywords;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function setOccupationCategory(string $occupationCategory): self
    {
        $this->occupationCategory = $occupationCategory;

        return $this;
    }

    public function getOccupationCategory(): string
    {
        return $this->occupationCategory;
    }

    public function setSubmittedBy(int $submittedBy): self
    {
        $this->submittedBy = $submittedBy;

        return $this;
    }

    public function getSubmittedBy(): int
    {
        return $this->submittedBy;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'sub_company' => $this->getSubCompany(),
            'office' => $this->getOffice(),
            'department' => $this->getDepartment(),
            'recruiting_category' => $this->getRecruitingCategory(),
            'status' => $this->getStatus(),
            'employment_type' => $this->getEmploymentType(),
            'seniority' => $this->getSeniority(),
            'schedule' => $this->getSchedule(),
            'years_of_exp' => $this->getYearsOfExp(),
            'keywords' => $this->getKeywords(),
            'occupation' => $this->getOccupation(),
            'occupation_category' => $this->getOccupationCategory(),
            'submitted_by' => $this->getSubmittedBy(),
        ];
    }

    public function setAttributes(array $data): void
    {
        $this->setTitle($data['title']);
        $this->setDescription($data['description']);
        $this->setSubCompany($data['sub_company']);
        $this->setOffice($data['office']);
        $this->setDepartment($data['department']);
        $this->setRecruitingCategory($data['recruiting_category']);
        $this->setStatus($data['status'] ?? 'unpublished');
        $this->setEmploymentType($data['employment_type']);
        $this->setSeniority($data['seniority']);
        $this->setSchedule($data['schedule']);
        $this->setYearsOfExp($data['years_of_exp']);
        $this->setKeywords($data['keywords']);
        $this->setOccupation($data['occupation']);
        $this->setOccupationCategory($data['occupation_category']);
        $this->setSubmittedBy($data['submitted_by']);
    }
}
