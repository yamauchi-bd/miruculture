<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnrollmentRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'corporate_number',
        'entry_type',
        'status',
        'start_year',
        'end_year',
        'current_job_category_id',
        'current_job_subcategory_id',
        'user_id',
    ];

    public function personalityTypes()
    {
        return $this->hasMany(PersonalityType::class);
    }

    public function decidingFactor()
    {
        return $this->hasOne(DecidingFactor::class);
    }

    public function companyCultures()
    {
        return $this->hasMany(CompanyCulture::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'current_job_category_id');
    }

    public function jobSubcategory()
    {
        return $this->belongsTo(JobCategory::class, 'current_job_subcategory_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'corporate_number', 'corporate_number');
    }
}
