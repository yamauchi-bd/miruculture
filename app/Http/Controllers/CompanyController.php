<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.search');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($corporateNumber)
    {
        $company = Company::with('industry')->where('corporate_number', $corporateNumber)->firstOrFail();
        $posts = Post::where('corporate_number', $corporateNumber)
            ->orderBy('created_at', 'desc')
            ->get();

        $decidingFactorsData = $this->calculateDecidingFactorsData($posts);

        return view('companies.show', compact('company', 'posts', 'decidingFactorsData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($corporateNumber)
    {
        $company = Company::where('corporate_number', $corporateNumber)->firstOrFail();
        $industries = Industry::all(); // 全ての業界を取得
        return view('companies.edit', compact('company', 'industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $corporate_number)
    {
        $company = Company::where('corporate_number', $corporate_number)->firstOrFail();

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_summary' => 'nullable|string',
            'company_mission' => 'nullable|string',
            'company_vision' => 'nullable|string',
            'company_values' => 'nullable|string',
            'company_url' => 'nullable|url',
            'location' => 'nullable|string',
            'employee_number' => 'nullable|integer',
            'date_of_establishment' => 'nullable|date',
            'capital_stock' => 'nullable|numeric',
            'representative_name' => 'nullable|string|max:255',
            'industry_id' => 'nullable|exists:industries,id',
            'listing_status' => 'nullable|in:,プライム,スタンダード,グロース',
        ]);

        try {
            $company->update($validatedData);
            Log::info('Company updated successfully', ['corporate_number' => $corporate_number]);
            return redirect()->route('companies.show', $company->corporate_number)
                ->with('success', '企業情報が更新されました。');
        } catch (\Exception $e) {
            Log::error('Failed to update company', ['error' => $e->getMessage(), 'corporate_number' => $corporate_number]);
            return back()->withInput()->with('error', '企業情報の更新に失敗しました。');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $companies = Cache::remember("company_search:{$query}", now()->addMinutes(60), function () use ($query) {
            return Company::search($query)->get();
        });

        return response()->json($companies);
    }

    private function calculateDecidingFactorsData($posts)
    {
        $factorCounts = [];
        $totalPosts = $posts->count();
    
        foreach ($posts as $post) {
            $factors = $post->decidingFactors->take(3)->values();
            foreach ($factors as $index => $factor) {
                $factorName = $factor->factor;
                if (!isset($factorCounts[$factorName])) {
                    $factorCounts[$factorName] = [0, 0, 0];
                }
                $factorCounts[$factorName][$index]++;
            }
        }
    
        $factorData = [];
        foreach ($factorCounts as $factor => $counts) {
            $percentages = array_map(function($count) use ($totalPosts) {
                return round(($count / $totalPosts) * 100, 1);
            }, $counts);
            $factorData[] = [
                'factor' => $factor,
                'percentages' => $percentages,
                'total' => array_sum($percentages)
            ];
        }
    
        usort($factorData, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });
    
        return $factorData; // 全ての要因を返す
    }
}
