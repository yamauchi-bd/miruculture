<?php

namespace App\Http\Controllers;

use App\Models\EnrollmentRecord;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $latestEnrollmentRecords = EnrollmentRecord::with(['decidingFactor', 'jobCategory', 'jobSubcategory', 'personalityTypes'])
            ->whereHas('decidingFactor', function ($query) {
                $query->whereNotNull('factor_1');
            })
            ->latest()
            ->take(10)
            ->get();

        return view('welcome', compact('latestEnrollmentRecords'));
    }
}
