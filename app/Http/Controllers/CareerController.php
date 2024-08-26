<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $careers = Career::with('user')->latest()->get();
        return view('careers.index', compact('careers'));
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
        Log::info('All form data:', $request->all());
        Log::info('graduation_year:', [$request->input('graduation_year')]);
        Log::info('graduation_month:', [$request->input('graduation_month')]);

        try {
            $baseRules = [
                'user_id' => 'required|exists:users,id',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name_kana' => 'required|string|max:255',
                'first_name_kana' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'gender_id' => 'required|exists:genders,id',
                'prefecture_id' => 'required|exists:prefectures,id',
                'career_status_id' => 'required|exists:career_statuses,id',
            ];

            $conditionalRules = [
                'current_industry_id' => 'required_if:career_status_id,1,3|exists:industries,id',
                'current_job_category_id' => 'required_if:career_status_id,1,3|exists:job_categories,id',
                'current_job_subcategory_id' => 'required_if:career_status_id,1,3|exists:job_categories,id',
                'current_job_years_id' => 'required_if:career_status_id,1,3|exists:job_years,id',
                'annual_income_id' => 'required_if:career_status_id,1,3|exists:annual_incomes,id',
                'job_change_motivation_id' => 'required_if:career_status_id,1,3|exists:job_motivations,id',
                'side_job_motivation_id' => 'required_if:career_status_id,1,3|exists:job_motivations,id',
                'college_name' => 'nullable|string|max:255',
                'college_faculty' => 'nullable|string|max:255',
                'college_department' => 'nullable|string|max:255',
                'graduation_year' => 'required_if:career_status_id,2|nullable|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
                'graduation_month' => 'required_if:career_status_id,2|nullable|integer|min:1|max:12',
            ];

            $validatedData = $request->validate(array_merge($baseRules, $conditionalRules));

            $career = Career::create($validatedData);

            Log::info('Career created successfully:', $career->toArray());

            return redirect()->route('careers.index')->with('success', 'キャリア情報が正常に保存されました。');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return back()->with('error', 'エラーが発生しました。もう一度お試しください。')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        Log::info('Show method called');
        $user = Auth::user();
        if (!$user) {
            Log::info('User not found');
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        $career = $user->career;
        Log::info('Career data:', ['career' => $career]);

        if (!$career) {
            Log::info('Career not found for user:', ['user_id' => $user->id]);
            return redirect()->route('careers.create')->with('info', 'キャリア情報がまだ登録されていません。新しく作成してください。');
        }

        return view('careers.show', ['career' => $career]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $career = $user->career;

        if (!$career) {
            return redirect()->route('careers.create')->with('info', 'キャリア情報がまだ登録されていません。新しく作成してください。');
        }

        $genders = Gender::all();
        $prefectures = Prefecture::all();
        $careerStatuses = CareerStatus::all();
        $industries = Industry::all();
        $jobMotivations = JobMotivation::all();
        $jobChangeMotivations = JobMotivation::where('type', 'change')->get();
        $sideJobMotivations = JobMotivation::where('type', 'side')->get();
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        $jobSubcategories = JobCategory::whereNotNull('parent_id')->get(); 
        $jobYears = JobYear::all();
        $annualIncomes = AnnualIncome::all();
        $collegeTypes = CollegeType::all();

        return view('careers.edit', compact(
            'career',
            'genders',
            'prefectures',
            'careerStatuses',
            'industries',
            'jobMotivations',
            'jobChangeMotivations',
            'sideJobMotivations',
            'jobCategories',
            'jobSubcategories',
            'jobYears',
            'annualIncomes',
            'collegeTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $career = $user->career;

        if (!$career) {
            return redirect()->route('careers.create')->with('info', 'キャリア情報がまだ登録されていません。新しく作成してください。');
        }

        $baseRules = [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name_kana' => 'required|string|max:255',
            'first_name_kana' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender_id' => 'required|exists:genders,id',
            'prefecture_id' => 'required|exists:prefectures,id',
            'career_status_id' => 'required|exists:career_statuses,id',
        ];

        $conditionalRules = [
            'current_industry_id' => 'required_if:career_status_id,1,3|exists:industries,id',
            'current_job_category_id' => 'required_if:career_status_id,1,3|exists:job_categories,id',
            'current_job_subcategory_id' => 'required_if:career_status_id,1,3|exists:job_categories,id',
            'current_job_years_id' => 'required_if:career_status_id,1,3|exists:job_years,id',
            'annual_income_id' => 'required_if:career_status_id,1,3|exists:annual_incomes,id',
            'job_change_motivation_id' => 'required_if:career_status_id,1,3|exists:job_motivations,id',
            'side_job_motivation_id' => 'required_if:career_status_id,1,3|exists:job_motivations,id',
            'college_name' => 'nullable|string|max:255',
            'college_faculty' => 'nullable|string|max:255',
            'college_department' => 'nullable|string|max:255',
            'graduation_year' => 'required_if:career_status_id,2|nullable|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
            'graduation_month' => 'required_if:career_status_id,2|nullable|integer|min:1|max:12',
        ];

        $validatedData = $request->validate(array_merge($baseRules, $conditionalRules));

        $career->update($validatedData);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('careers.show')->with('success', 'キャリア情報が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        //
    }
}
