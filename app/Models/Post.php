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
        // 'employment_type',
        'entry_type',
        'status',
        'start_year',
        'end_year',
        'current_job_category_id',
        // 'current_job_subcategory_id',
        'deciding_factor_1',
        'factor_1_detail',
        'factor_1_satisfaction',
        'factor_1_satisfaction_reason',
        'deciding_factor_2',
        'factor_2_detail',
        'factor_2_satisfaction',
        'factor_2_satisfaction_reason',
        'deciding_factor_3',
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
        return $this->belongsTo(JobCategory::class, 'current_job_category_id');
    }
    
    // public function jobSubcategory()
    // {
    //     return $this->belongsTo(JobCategory::class, 'current_job_subcategory_id');
    // }
    
    public function getDecidingFactorsAttribute()
    {
        $factors = collect();
        for ($i = 1; $i <= 3; $i++) {
            if ($this->{"deciding_factor_$i"}) {
                $factors->push((object)[
                    'factor' => $this->{"deciding_factor_$i"},
                    'detail' => $this->{"factor_{$i}_detail"},
                    'satisfaction' => $this->{"factor_{$i}_satisfaction"},
                    'satisfaction_reason' => $this->{"factor_{$i}_satisfaction_reason"},
                ]);
            }
        }
        return $factors;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'corporate_number', 'corporate_number');
    }
}
