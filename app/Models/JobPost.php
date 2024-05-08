<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Str;

class JobPost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sub_company',
        'office',
        'department',
        'recruiting_category',
        'status',
        'employment_type',
        'seniority',
        'schedule',
        'years_of_exp',
        'keywords',
        'occupation',
        'occupation_category',
        'submitted_by',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public $incrementing = false;

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function submittedBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'submitted_by');
    }
}
