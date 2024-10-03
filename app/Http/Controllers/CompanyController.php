<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\Post;
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
    
            $apiCompanyData = $apiData['hojin-infos'][0];
    
            // データベースから追加情報を取得
            $dbCompanyData = Company::where('corporate_number', $corporate_number)->first();
    
            // APIデータとデータベースデータを結合
            $company = [
                'corporate_number' => $apiCompanyData['corporate_number'],
                'company_name' => $apiCompanyData['name'],
                'location' => $apiCompanyData['location'],
                'company_url' => $apiCompanyData['company_url'] ?? null,
                'employee_number' => $apiCompanyData['employee_number'] ?? null,
                'date_of_establishment' => $apiCompanyData['date_of_establishment'] ?? null,
                'capital_stock' => $apiCompanyData['capital_stock'] ?? null,
                'representative_name' => $apiCompanyData['representative_name'] ?? null,
                'business_summary' => $apiCompanyData['business_summary'] ?? null,
                // データベースから取得する追加情報
                'company_mission' => $dbCompanyData->company_mission ?? null,
                'company_vision' => $dbCompanyData->company_vision ?? null,
                'company_values' => $dbCompanyData->company_values ?? null,
                'industry' => $dbCompanyData->industry ? $dbCompanyData->industry->name : null,
                'listing_status' => $dbCompanyData->listing_status ?? null,
            ];
    
            // 他の必要なデータ（posts, decidingFactorsData, companyCultureFactors）は
            // 既存のコードを使用して取得
            $posts = Post::where('corporate_number', $corporate_number)->get();
            $decidingFactorsData = $this->calculateDecidingFactorsData($posts);

            // 会社文化要因を計算
            $companyCultureFactors = $this->calculateCompanyCultureFactors($posts);
    
    
            return view('companies.show', compact('company', 'posts', 'decidingFactorsData', 'companyCultureFactors'));
    
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

    private function calculateCompanyCultureFactors($posts)
    {
        $cultureItems = [
            ['name' => '人間関係', 'a' => 'フォーマル', 'b' => 'カジュアル'],
            ['name' => '組織体系', 'a' => 'クローズ･階層的', 'b' => 'オープン･フラット'],
            ['name' => '判断基準', 'a' => 'ロジカル', 'b' => 'パッション'],
            ['name' => '事業の軸', 'a' => '収益･成長性', 'b' => 'ビジョン･理念'],
            ['name' => '組織特性', 'a' => '安定･保守', 'b' => '変革･挑戦'],
            ['name' => '評価基準', 'a' => 'プロセス重視', 'b' => '結果重視'],
            ['name' => '意思決定', 'a' => 'トップダウン', 'b' => 'ボトムアップ'],
            ['name' => '仕事の進め方', 'a' => '個人プレー', 'b' => 'チームプレー'],
            ['name' => '雰囲気', 'a' => 'モクモク･真面目', 'b' => 'ワイワイ･元気'],
            ['name' => 'ワークライフ', 'a' => 'バランス重視', 'b' => 'ワーク重視'],
        ];
    
        $factorData = [];
    
        foreach ($cultureItems as $index => $item) {
            $scores = $posts->pluck("culture_{$index}")->filter()->values();
            $averageScore = $scores->avg() ?? 3; // デフォルト値を3（中間）に設定
    
            $factorData[] = [
                'name' => $item['name'],
                'a' => $item['a'],
                'b' => $item['b'],
                'average_score' => round($averageScore, 1),
            ];
        }
    
        return collect($factorData);
    }
}