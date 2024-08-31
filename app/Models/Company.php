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

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('company_name', 'LIKE', "%{$searchTerm}%")
                     ->select('corporate_number', 'company_name', 'location');
    }
}
