<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'corporate_number',
        'employment_type',
        'entry_type',
        'status',
        'start_date',
        'end_date',
        'job_category_id',
        'factor_1',
        'factor_1_detail',
        'factor_1_satisfaction',
        'factor_1_satisfaction_reason',
        'factor_2',
        'factor_2_detail',
        'factor_2_satisfaction',
        'factor_2_satisfaction_reason',
        'factor_3',
        'factor_3_detail',
        'factor_3_satisfaction',
        'factor_3_satisfaction_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }
}