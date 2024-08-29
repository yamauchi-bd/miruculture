<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\JobCategory;
use Illuminate\Http\Request;
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

    public function create()
    {
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        return view('posts.create', compact('jobCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'nullable|string|max:13',
            'employment_type' => 'required|in:正社員,契約社員,その他',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
            'deciding_factor_1' => 'required|string',
            'factor_1_detail' => 'required|string',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            'factor_1_satisfaction_reason' => 'required|string',
            'deciding_factor_2' => 'nullable|string',
            'factor_2_detail' => 'nullable|string',
            'factor_2_satisfaction' => 'nullable|integer|min:1|max:5',
            'factor_2_satisfaction_reason' => 'nullable|string',
            'deciding_factor_3' => 'nullable|string',
            'factor_3_detail' => 'nullable|string',
            'factor_3_satisfaction' => 'nullable|integer|min:1|max:5',
            'factor_3_satisfaction_reason' => 'nullable|string',
        ]);

        // ここでバリデーション済みのデータを使用してPostモデルを作成し保存
        $post = new Post($validatedData);
        $post->user_id = Auth::id(); // ログインユーザーのIDを設定
        $post->save();

        // 保存後のリダイレクト
        return redirect()->route('posts.show', $post)->with('success', '投稿が正常に作成されました。');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        return view('posts.edit', compact('post', 'jobCategories'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'nullable|string|max:13',
            'employment_type' => 'required|in:正社員,契約社員,その他',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_subcategories,id',
            'deciding_factor_1' => 'required|string',
            'factor_1_detail' => 'required|string',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            'factor_1_satisfaction_reason' => 'required|string',
            'deciding_factor_2' => 'nullable|string',
            'factor_2_detail' => 'nullable|required_with:deciding_factor_2|string',
            'factor_2_satisfaction' => 'nullable|required_with:deciding_factor_2|integer|min:1|max:5',
            'factor_2_satisfaction_reason' => 'nullable|required_with:deciding_factor_2|string',
            'deciding_factor_3' => 'nullable|string',
            'factor_3_detail' => 'nullable|required_with:deciding_factor_3|string',
            'factor_3_satisfaction' => 'nullable|required_with:deciding_factor_3|integer|min:1|max:5',
            'factor_3_satisfaction_reason' => 'nullable|required_with:deciding_factor_3|string',
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
            'employment_type' => 'required|in:正社員,契約社員,その他',
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
}
