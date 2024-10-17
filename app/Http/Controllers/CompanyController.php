<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\EnrollmentRecord;
use App\Models\CompanyCulture;
use App\Models\PersonalityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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
    public function show($corporate_number)
    {
        Log::info('Showing company with corporate number: ' . $corporate_number);
    
        try {
            // データベースから企業データを取得
            $dbCompany = Company::where('corporate_number', $corporate_number)->first();

            // APIから企業データを取得
            $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin/" . $corporate_number;
            $response = Http::withHeaders([
                'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
            ])->get($apiUrl);
    
            Log::info('API Response:', $response->json());
    
            $apiData = $response->json();

            if (!isset($apiData['hojin-infos']) || empty($apiData['hojin-infos'])) {
                Log::error('Company not found in API response');
                abort(404, '企業情報が見つかりません。');
            }

            $apiCompanyData = $apiData['hojin-infos'][0] ?? $apiData['hojin-infos'];

            // データベースデータとAPIデータを結合（データベースデータを優先）
            $company = [
                'corporate_number' => $corporate_number,
                'company_name' => $dbCompany->company_name ?? $apiCompanyData['name'],
                'location' => $dbCompany->location ?? $apiCompanyData['location'],
                'company_url' => $dbCompany->company_url ?? $apiCompanyData['company_url'] ?? null,
                'employee_number' => $dbCompany->employee_number ?? $apiCompanyData['employee_number'] ?? null,
                'date_of_establishment' => $dbCompany->date_of_establishment ?? $apiCompanyData['date_of_establishment'] ?? null,
                'capital_stock' => $dbCompany->capital_stock ?? $apiCompanyData['capital_stock'] ?? null,
                'representative_name' => $dbCompany->representative_name ?? $apiCompanyData['representative_name'] ?? null,
                'business_summary' => $dbCompany->business_summary ?? $apiCompanyData['business_summary'] ?? null,
                'company_mission' => $dbCompany->company_mission ?? null,
                'company_vision' => $dbCompany->company_vision ?? null,
                'company_values' => $dbCompany->company_values ?? null,
                'industry' => $dbCompany->industry->name ?? null,
                'listing_status' => $dbCompany->listing_status ?? null,
            ];
    
            // 決め手が存在する投稿を取得
            $decidingFactorRecords = EnrollmentRecord::where('corporate_number', $corporate_number)
                ->with(['personalityTypes', 'decidingFactor', 'jobCategory', 'jobSubcategory'])
                ->whereHas('decidingFactor', function ($query) {
                    $query->whereNotNull('factor_1');
                })
                ->get()
                ->sortByDesc(function ($record) {
                    return $record->decidingFactor->created_at;
                })
                ->values(); // インデックスをリセット

            // 社風が存在する投稿を取得
            $companyCultureRecords = EnrollmentRecord::where('corporate_number', $corporate_number)
                ->with(['personalityTypes', 'companyCultures', 'jobCategory', 'jobSubcategory'])
                ->whereHas('companyCultures', function ($query) {
                    $query->where(function ($q) {
                        for ($i = 0; $i < 8; $i++) {
                            $q->orWhereNotNull("culture_{$i}");
                        }
                    });
                })
                ->get()
                ->map(function ($record) {
                    $record->latest_culture_date = $record->companyCultures->max('created_at');
                    return $record;
                })
                ->sortByDesc('latest_culture_date')
                ->values(); // インデックスをリセット

            $decidingFactorsData = $this->calculateDecidingFactorsData($decidingFactorRecords);
            $companyCultureFactors = $this->aggregateCompanyCultureData($companyCultureRecords);

            // デバッグ用のログ出力
            Log::info('Deciding Factor Records:', ['count' => $decidingFactorRecords->count()]);
            Log::info('Company Culture Records:', ['count' => $companyCultureRecords->count()]);
            Log::info('Deciding Factors Data:', $decidingFactorsData);
    
            $personalityTypeRecords = EnrollmentRecord::where('corporate_number', $corporate_number)
                ->with('personalityTypes')
                ->get();

            $personalityTypeData = $this->getPersonalityTypeData($personalityTypeRecords);

            return view('companies.show', compact('company', 'decidingFactorRecords', 'companyCultureRecords', 'decidingFactorsData', 'companyCultureFactors', 'personalityTypeRecords', 'personalityTypeData'));
    
        } catch (\Exception $e) {
            Log::error('Error in show method: ' . $e->getMessage());
            abort(500, '内部サーバーエラーが発生しました。');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($corporateNumber)
    {
        // データベースから既存のデータを取得（存在しない場合は新規作成）
        $dbCompany = Company::firstOrNew(['corporate_number' => $corporateNumber]);

        // APIから企業データを取得
        $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin/" . $corporateNumber;
        $response = Http::withHeaders([
            'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
        ])->get($apiUrl);

        $apiData = $response->json();

        if (!isset($apiData['hojin-infos']) || empty($apiData['hojin-infos'])) {
            abort(404, '企業情報が見つかりません。');
        }

        $apiCompanyData = $apiData['hojin-infos'][0];

        // データベースデータとAPIデータを結合（データベースデータを優）
        $company = [
            'corporate_number' => $corporateNumber,
            'company_name' => $dbCompany->company_name ?? $apiCompanyData['name'],
            'business_summary' => $dbCompany->business_summary ?? $apiCompanyData['business_summary'] ?? null,
            'company_url' => $dbCompany->company_url ?? $apiCompanyData['company_url'] ?? null,
            'location' => $dbCompany->location ?? $apiCompanyData['location'] ?? null,
            'employee_number' => $dbCompany->employee_number ?? $apiCompanyData['employee_number'] ?? null,
            'date_of_establishment' => $dbCompany->date_of_establishment ?? $apiCompanyData['date_of_establishment'] ?? null,
            'capital_stock' => $dbCompany->capital_stock ?? $apiCompanyData['capital_stock'] ?? null,
            'representative_name' => $dbCompany->representative_name ?? $apiCompanyData['representative_name'] ?? null,
            'company_mission' => $dbCompany->company_mission,
            'company_vision' => $dbCompany->company_vision,
            'company_values' => $dbCompany->company_values,
            'industry_id' => $dbCompany->industry_id,
            'listing_status' => $dbCompany->listing_status,
        ];

        $industries = Industry::all();

        return view('companies.edit', compact('company', 'industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $corporate_number)
    {
        Log::info('Update method called', [
            'corporate_number' => $corporate_number,
            'request_method' => $request->method(),
            'request_data' => $request->all()
        ]);

        // 企業を検索し、存在しない場合は新規作成
        $company = Company::firstOrNew(['corporate_number' => $corporate_number]);

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
            $company->fill($validatedData);
            $company->save();
            
            Log::info('Company updated/created successfully', ['corporate_number' => $corporate_number]);
            return redirect()->route('companies.show', $company->corporate_number)
                ->with('success', '企業情報が更新されました。');
        } catch (\Exception $e) {
            Log::error('Failed to update/create company', ['error' => $e->getMessage(), 'corporate_number' => $corporate_number]);
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
    
        try {
            $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin";
            $response = Http::withHeaders([
                'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
            ])->get($apiUrl, [
                'name' => $query,
                'limit' => 15,
            ]);
    
            $apiData = $response->json();
    
            if (!isset($apiData['hojin-infos']) || empty($apiData['hojin-infos'])) {
                return response()->json([]);
            }
    
            $companies = collect($apiData['hojin-infos'])->map(function ($apiCompanyData) {
                return [
                    'corporate_number' => $apiCompanyData['corporate_number'],
                    'company_name' => $apiCompanyData['name'],
                    'location' => $apiCompanyData['location'] ?? null,
                ];
            })->values();
    
            return response()->json($companies);
    
        } catch (\Exception $e) {
            Log::error('API search error: ' . $e->getMessage());
            return response()->json(['error' => '検索中にエラーが発生しました。'], 500);
        }
    }

    private function calculateDecidingFactorsData($latestEnrollmentRecords)
    {
        $factorCounts = [];
        $totalPosts = $latestEnrollmentRecords->count();
    
        foreach ($latestEnrollmentRecords as $enrollmentRecord) {
            $decidingFactor = $enrollmentRecord->decidingFactor;
            if ($decidingFactor) {
                for ($i = 1; $i <= 3; $i++) {
                    $factorName = $decidingFactor->{"factor_$i"};
                    if ($factorName) {
                        if (!isset($factorCounts[$factorName])) {
                            $factorCounts[$factorName] = [0, 0, 0];
                        }
                        $factorCounts[$factorName][$i - 1]++;
                    }
                }
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
    
        return $factorData;
    }

    private function aggregateCompanyCultureData($enrollmentRecords)
    {
        $cultureItems = CompanyCulture::getCultureItems();
        $aggregatedData = [];

        foreach ($cultureItems as $index => $item) {
            $values = $enrollmentRecords->flatMap(function ($record) use ($index) {
                return $record->companyCultures->pluck("culture_{$index}");
            });

            $averageScore = $values->avg();
            $aggregatedData[] = [
                'name' => $item['name'],
                'a' => $item['a'],
                'b' => $item['b'],
                'average_score' => $averageScore,
            ];
        }

        return $aggregatedData;
    }

    private function getPersonalityTypeData($records)
    {
        $typeCounts = [];
        $totalCount = 0;

        foreach ($records as $record) {
            $type = $record->personalityTypes->first()->type ?? null;
            if ($type) {
                $typeCounts[$type] = ($typeCounts[$type] ?? 0) + 1;
                $totalCount++;
            }
        }

        $data = [];
        foreach ($typeCounts as $type => $count) {
            $data[] = [
                'type' => $type,
                'count' => $count,
                'percentage' => round(($count / $totalCount) * 100, 1)
            ];
        }

        return $data;
    }
}
