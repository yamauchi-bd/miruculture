<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Prefecture;
use App\Models\CareerStatus;
use App\Models\Industry;
use App\Models\JobMotivation;
use App\Models\JobCategory;
use App\Models\JobYear;
use App\Models\AnnualIncome;
use App\Models\CollegeType;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $prefectures = Prefecture::all();
        $careerStatuses = CareerStatus::all();
        $industries = Industry::all();
        $jobChangeMotivations = JobMotivation::where('type', 'change')->get();
        $sideJobMotivations = JobMotivation::where('type', 'side')->get();
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        $jobYears = JobYear::all();
        $annualIncomes = AnnualIncome::all();
        $collegeTypes = CollegeType::all();

        return view('careers.create', compact(
            'genders',
            'prefectures',
            'careerStatuses',
            'industries',
            'jobChangeMotivations',
            'sideJobMotivations',
            'jobCategories',
            'jobYears',
            'annualIncomes',
            'collegeTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        //
    }
}
