<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'corporate_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'company_name',
        'business_summary',
        'company_mission',
        'company_vision',
        'company_values',
        'company_url',
        'location',
        'employee_number',
        'date_of_establishment',
        'capital_stock',
        'representative_name',
        'industry_id',
        'listing_status',
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('company_name', 'LIKE', "%{$searchTerm}%")
            ->select('corporate_number', 'company_name', 'location');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
