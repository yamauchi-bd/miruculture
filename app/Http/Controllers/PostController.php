<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'corporate_number' => 'required|string|size:13',
            'employment_type' => 'required|in:正社員,契約社員,その他',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'job_category_id' => 'required|exists:job_categories,id',
            'factor_1' => 'required|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_1_detail' => 'required|string',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            'factor_1_satisfaction_reason' => 'required|string',
            'factor_2' => 'nullable|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_2_detail' => 'required_with:factor_2|nullable|string',
            'factor_2_satisfaction' => 'required_with:factor_2|nullable|integer|min:1|max:5',
            'factor_2_satisfaction_reason' => 'required_with:factor_2|nullable|string',
            'factor_3' => 'nullable|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_3_detail' => 'required_with:factor_3|nullable|string',
            'factor_3_satisfaction' => 'required_with:factor_3|nullable|integer|min:1|max:5',
            'factor_3_satisfaction_reason' => 'required_with:factor_3|nullable|string',
        ]);

        $user = Auth::user();
        $post = $user->posts()->create($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '投稿が作成されました。');
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
        // バリデーションルールは store メソッドと同じ
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'required|string|size:13',
            'employment_type' => 'required|in:正社員,契約社員,その他',
            'entry_type' => 'required|in:新卒入社,中途入社',
            'status' => 'required|in:在籍中,退職済み',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'job_category_id' => 'required|exists:job_categories,id',
            'factor_1' => 'required|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_1_detail' => 'required|string',
            'factor_1_satisfaction' => 'required|integer|min:1|max:5',
            'factor_1_satisfaction_reason' => 'required|string',
            'factor_2' => 'nullable|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_2_detail' => 'required_with:factor_2|nullable|string',
            'factor_2_satisfaction' => 'required_with:factor_2|nullable|integer|min:1|max:5',
            'factor_2_satisfaction_reason' => 'required_with:factor_2|nullable|string',
            'factor_3' => 'nullable|in:企業ビジョン,事業内容,仲間,成長環境,働き方,給与,その他',
            'factor_3_detail' => 'required_with:factor_3|nullable|string',
            'factor_3_satisfaction' => 'required_with:factor_3|nullable|integer|min:1|max:5',
            'factor_3_satisfaction_reason' => 'required_with:factor_3|nullable|string',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '投稿が更新されました。');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿が削除されました。');
    }
}
