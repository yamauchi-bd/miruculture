<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $company = Company::findOrFail($corporateNumber);
        $posts = Post::where('corporate_number', $corporateNumber)->get(); // 正しいカラム名を使用
    
        return view('companies.show', compact('company', 'posts')); // $postsをビューに渡す
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
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
        $companies = Company::search($query)
            ->select('corporate_number', 'company_name', 'location')
            ->limit(10)
            ->get();
    
        return response()->json($companies);
    }
}
