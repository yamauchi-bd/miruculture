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
        // 'factor_1_satisfaction_reason',
        'deciding_factor_2',
        'factor_2_detail',
        'factor_2_satisfaction',
        // 'factor_2_satisfaction_reason',
        'deciding_factor_3',
        'factor_3_detail',
        'factor_3_satisfaction',
        // 'factor_3_satisfaction_reason',
        'culture_0',
        'culture_1',
        'culture_2',
        'culture_3',
        'culture_4',
        'culture_5',
        'culture_6',
        'culture_7',
        'culture_8',
        'culture_9',
        'culture_detail_0',
        'culture_detail_1',
        'culture_detail_2',
        'culture_detail_3',
        'culture_detail_4',
        'culture_detail_5',
        'culture_detail_6',
        'culture_detail_7',
        'culture_detail_8',
        'culture_detail_9',
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
                    // 'satisfaction_reason' => $this->{"factor_{$i}_satisfaction_reason"},
                ]);
            }
        }
        return $factors;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'corporate_number', 'corporate_number');
    }

    public function getCultureDetailsAttribute()
    {
        $details = [];
        for ($i = 0; $i < 10; $i++) {
            $details[] = [
                'value' => $this->{"culture_$i"},
                'detail' => $this->{"culture_detail_$i"}
            ];
        }
        return $details;
    }

    public function getTotalCultureDetailLengthAttribute()
    {
        return array_sum(array_map('strlen', array_filter([
            $this->culture_detail_0, $this->culture_detail_1, $this->culture_detail_2, $this->culture_detail_3,
            $this->culture_detail_4, $this->culture_detail_5, $this->culture_detail_6, $this->culture_detail_7,
            $this->culture_detail_8, $this->culture_detail_9
        ])));
    }
}
