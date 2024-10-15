<?php

namespace App\Http\Controllers;

use App\Models\CompanyCulture;
use App\Models\EnrollmentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyCultureController extends Controller
{
    public function create(EnrollmentRecord $enrollmentRecord)
    {
        $cultureItems = CompanyCulture::getCultureItems();
        return view('posts.create_company_cultures', compact('enrollmentRecord', 'cultureItems'));
    }

    public function store(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
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

        $enrollmentRecord->companyCultures()->create($validatedData);

        return redirect()->route('home')
            ->with('success', '社風•雰囲気が登録されました。在籍情報の登録が完了しました。');
    }

    public function edit(EnrollmentRecord $enrollmentRecord)
    {
        $companyCulture = $enrollmentRecord->companyCulture;
        $cultureItems = CompanyCulture::getCultureItems();
        return view('company_cultures.edit', compact('enrollmentRecord', 'companyCulture', 'cultureItems'));
    }

    public function update(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'culture_0' => 'required|integer|min:1|max:5',
            'culture_1' => 'required|integer|min:1|max:5',
            'culture_2' => 'required|integer|min:1|max:5',
            'culture_3' => 'required|integer|min:1|max:5',
            'culture_4' => 'required|integer|min:1|max:5',
            'culture_5' => 'required|integer|min:1|max:5',
            'culture_6' => 'required|integer|min:1|max:5',
            'culture_7' => 'required|integer|min:1|max:5',
            'culture_detail' => 'required|string|min:300',
        ]);

        $enrollmentRecord->companyCulture()->update($validatedData);

        return redirect()->route('enrollment_records.show', $enrollmentRecord)
            ->with('success', '社風•雰囲気が更新されました。');
    }
}
