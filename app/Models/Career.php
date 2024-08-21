<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'birth_date',
        'gender_id',
        'prefecture_id',
        'career_status_id',
        'current_industry_id',
        'current_job_category_id',
        'current_job_subcategory_id',
        'current_job_years_id',
        'annual_income_id',
        'job_change_motivation_id',
        'side_job_motivation_id',
        'college_name',
        'college_faculty',
        'college_department',
        'graduation_year',
        'graduation_month',
    ];

    protected $dates = [
        'birth_date',
    ];

    // リレーションシップ

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function careerStatus(): BelongsTo
    {
        return $this->belongsTo(CareerStatus::class);
    }

    public function jobChangeMotivation(): BelongsTo
    {
        return $this->belongsTo(JobMotivation::class, 'job_change_motivation_id');
    }

    public function sideJobMotivation(): BelongsTo
    {
        return $this->belongsTo(JobMotivation::class, 'side_job_motivation_id');
    }

    public function currentIndustry(): BelongsTo
    {
        return $this->belongsTo(Industry::class, 'current_industry_id');
    }

    public function currentJobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'current_job_category_id');
    }

    public function currentJobSubcategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'current_job_subcategory_id');
    }

    public function currentJobYears(): BelongsTo
    {
        return $this->belongsTo(JobYear::class, 'current_job_years_id');
    }

    public function annualIncome(): BelongsTo
    {
        return $this->belongsTo(AnnualIncome::class);
    }

    public function collegeType(): BelongsTo
    {
        return $this->belongsTo(CollegeType::class);
    }
}