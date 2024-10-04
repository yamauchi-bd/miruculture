<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Company;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('jobCategory')->paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function create(Request $request)
    {
        Log::info('Create method called with corporate_number: ' . $request->corporate_number);

        $company = null;
        if ($request->has('corporate_number')) {
            $company = Company::where('corporate_number', $request->corporate_number)->first();
            if ($company) {
                Log::info('Company found: ' . $company->company_name);
            } else {
                Log::warning('Company not found for corporate_number: ' . $request->corporate_number);
            }
        }

        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();

        return view('posts.create', compact('jobCategories', 'company'));
    }

    public function createStep1(Request $request)
    {
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        $formData = session('post_data', []);
        $corporate_number = $request->query('corporate_number', $formData['corporate_number'] ?? null);
        $company_name = $formData['company_name'] ?? null;

        if ($corporate_number && !$company_name) {
            try {
                $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin/" . $corporate_number;
                $response = Http::withHeaders([
                    'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
                ])->get($apiUrl);

                $apiData = $response->json();

                if (isset($apiData['hojin-infos'][0]['name'])) {
                    $company_name = $apiData['hojin-infos'][0]['name'];
                } else {
                    Log::warning('Company not found in API response for corporate number: ' . $corporate_number);
                }
            } catch (\Exception $e) {
                Log::error('Error fetching company data: ' . $e->getMessage());
            }
        }

        $formData = array_merge($formData, [
            'corporate_number' => $corporate_number,
            'company_name' => $company_name,
        ]);

        return view('posts.create_step1', compact('jobCategories', 'formData'));
    }

    public function storeStep1(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'nullable|string|max:13',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|required_if:status,退職済み|integer|min:1900|max:' . date('Y'),
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
        ]);

        $postData = session('post_data', []);
        $postData = array_merge($postData, $validatedData);
        $request->session()->put('post_data', $postData);

        return redirect()->route('posts.create.step2');
    }

    public function createStep2(Request $request)
    {
        if (!$request->session()->has('post_data')) {
            return redirect()->route('posts.create.step1');
        }

        $formData = session('post_data', []);
        return view('posts.create_step2', compact('formData'));
    }

    public function storeStep2(Request $request)
    {
        $rules = [
            'deciding_factor_1' => 'required|string',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            'factor_1_detail' => 'required|string|min:100',
        ];

        for ($i = 2; $i <= 3; $i++) {
            if ($request->has("deciding_factor_$i")) {
                $rules["deciding_factor_$i"] = 'required|string';
                $rules["factor_{$i}_satisfaction"] = 'required|integer|min:1|max:5';
                $rules["factor_{$i}_detail"] = 'required|string|min:100';
            }
        }

        $validatedData = $request->validate($rules);

        $postData = session('post_data', []);
        $postData = array_merge($postData, $validatedData);
        $request->session()->put('post_data', $postData);

        return redirect()->route('posts.create.step3');
    }

    public function createStep3(Request $request)
    {
        if (!$request->session()->has('post_data')) {
            return redirect()->route('posts.create.step1');
        }

        $formData = session('post_data', []);
        return view('posts.create_step3', compact('formData'));
    }

    public function store(Request $request)
    {
        $postData = session('post_data', []);

        $step3Data = $request->validate([
            'culture_0' => 'required|integer|min:1|max:5',
            'culture_1' => 'required|integer|min:1|max:5',
            'culture_2' => 'required|integer|min:1|max:5',
            'culture_3' => 'required|integer|min:1|max:5',
            'culture_4' => 'required|integer|min:1|max:5',
            'culture_5' => 'required|integer|min:1|max:5',
            'culture_6' => 'required|integer|min:1|max:5',
            'culture_7' => 'required|integer|min:1|max:5',
            'culture_detail_0' => 'nullable|string',
            'culture_detail_1' => 'nullable|string',
            'culture_detail_2' => 'nullable|string',
            'culture_detail_3' => 'nullable|string',
            'culture_detail_4' => 'nullable|string',
            'culture_detail_5' => 'nullable|string',
            'culture_detail_6' => 'nullable|string',
            'culture_detail_7' => 'nullable|string',
        ]);

        $totalDetailLength = array_sum(array_map('strlen', array_filter($step3Data, function ($key) {
            return strpos($key, 'culture_detail_') === 0;
        }, ARRAY_FILTER_USE_KEY)));

        if ($totalDetailLength < 300) {
            return back()->withErrors(['culture_detail' => '合計文字数は300文字以上である必要があります。'])
                         ->withInput();
        }

        $postData = array_merge($postData, $step3Data);

        $post = new Post($postData);
        $post->user_id = Auth::id();
        $post->save();

        $request->session()->forget('post_data');

        return redirect()->route('companies.show', ['corporate_number' => $post->corporate_number])
            ->with('success', '投稿が正常に作成されました。');
    }

    public function show(Post $post)
    {
        return response()->json([
            'company_name' => $post->company->company_name,
            'deciding_factors' => $post->decidingFactors->map(function ($factor) {
                return [
                    'factor' => $factor->factor,
                    'detail' => $factor->detail,
                    'satisfaction' => $factor->satisfaction,
                    'satisfaction_reason' => $factor->satisfaction_reason,
                ];
            }),
        ]);
    }

    public function edit(Post $post)
    {
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        return view('posts.edit', compact('post', 'jobCategories'));
    }

    public function update(Request $request, Post $post)
    {
        $currentYear = date('Y');
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'nullable|string|max:13',
            // 'employment_type' => 'required|in:正社員,契約社員,その他',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_year' => "required|integer|min:1900|max:$currentYear",
            'end_year' => "nullable|integer|min:1900|max:$currentYear",
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
            'deciding_factor_1' => 'required|string',
            'factor_1_detail' => 'required|string|min:100',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            // 'factor_1_satisfaction_reason' => 'required|string|min:50',
            'deciding_factor_2' => 'nullable|string',
            'factor_2_detail' => 'nullable|required_with:deciding_factor_2|string|min:100',
            'factor_2_satisfaction' => 'nullable|required_with:deciding_factor_2|integer|min:1|max:5',
            // 'factor_2_satisfaction_reason' => 'nullable|required_with:deciding_factor_2|string|min:50',
            'deciding_factor_3' => 'nullable|string',
            'factor_3_detail' => 'nullable|required_with:deciding_factor_3|string|min:100',
            'factor_3_satisfaction' => 'nullable|required_with:deciding_factor_3|integer|min:1|max:5',
            // 'factor_3_satisfaction_reason' => 'nullable|required_with:deciding_factor_3|string|min:50',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '投稿が更新されました。');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿が削除されました。');
    }

    public function validateSection1(Request $request)
    {
        Log::info('Received data:', $request->all());

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed:', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Log::info('Validation passed');
        return response()->json(['success' => true]);
    }

    public function validateSection3(Request $request)
    {
        Log::info('Received data for section 3:', $request->all());

        $validator = Validator::make($request->all(), [
            'culture_0' => 'required|integer|min:1|max:5',
            'culture_1' => 'required|integer|min:1|max:5',
            'culture_2' => 'required|integer|min:1|max:5',
            'culture_3' => 'required|integer|min:1|max:5',
            'culture_4' => 'required|integer|min:1|max:5',
            'culture_5' => 'required|integer|min:1|max:5',
            'culture_6' => 'required|integer|min:1|max:5',
            'culture_7' => 'required|integer|min:1|max:5',
            'culture_detail_0' => 'nullable|string',
            'culture_detail_1' => 'nullable|string',
            'culture_detail_2' => 'nullable|string',
            'culture_detail_3' => 'nullable|string',
            'culture_detail_4' => 'nullable|string',
            'culture_detail_5' => 'nullable|string',
            'culture_detail_6' => 'nullable|string',
            'culture_detail_7' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for section 3:', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $totalDetailLength = array_sum(array_map('strlen', array_filter($request->all(), function ($key) {
            return strpos($key, 'culture_detail_') === 0;
        }, ARRAY_FILTER_USE_KEY)));

        if ($totalDetailLength < 300) {
            return response()->json(['errors' => ['culture_detail' => ['合計文字数は300文字以上である必要があります。']]], 422);
        }

        Log::info('Validation passed for section 3');
        return response()->json(['success' => true]);
    }
}