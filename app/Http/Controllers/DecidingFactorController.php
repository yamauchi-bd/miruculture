<?php

namespace App\Http\Controllers;

use App\Models\DecidingFactor;
use App\Models\EnrollmentRecord;
use Illuminate\Http\Request;

class DecidingFactorController extends Controller
{
    public function create(EnrollmentRecord $enrollmentRecord)
    {
        $factors = DecidingFactor::getFactors();
        return view('posts.create_deciding_factors', compact('enrollmentRecord', 'factors'));
    }

    public function store(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'factor_1' => 'required|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_1' => 'required|string|min:100',
            'satisfaction_1' => 'required|integer|min:1|max:5',
            'factor_2' => 'nullable|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_2' => 'required_with:factor_2|nullable|string|min:100',
            'satisfaction_2' => 'required_with:factor_2|nullable|integer|min:1|max:5',
            'factor_3' => 'nullable|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_3' => 'required_with:factor_3|nullable|string|min:100',
            'satisfaction_3' => 'required_with:factor_3|nullable|integer|min:1|max:5',
        ]);

        $enrollmentRecord->decidingFactor()->create($validatedData);

        // 次のステップ（企業文化の入力）にリダイレクト
        return redirect()->route('company_cultures.create', $enrollmentRecord)
            ->with('success', '入社の決め手が登録されました。続いて社風•雰囲気を入力してください。');
    }

    public function edit(EnrollmentRecord $enrollmentRecord)
    {
        $decidingFactor = $enrollmentRecord->decidingFactor;
        $factors = DecidingFactor::getFactors();
        return view('deciding_factors.edit', compact('enrollmentRecord', 'decidingFactor', 'factors'));
    }

    public function update(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'factor_1' => 'required|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_1' => 'required|string|min:100',
            'satisfaction_1' => 'required|integer|min:1|max:5',
            'factor_2' => 'nullable|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_2' => 'required_with:factor_2|nullable|string|min:100',
            'satisfaction_2' => 'required_with:factor_2|nullable|integer|min:1|max:5',
            'factor_3' => 'nullable|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_3' => 'required_with:factor_3|nullable|string|min:100',
            'satisfaction_3' => 'required_with:factor_3|nullable|integer|min:1|max:5',
        ]);

        $enrollmentRecord->decidingFactor()->update($validatedData);

        return redirect()->route('enrollment_records.show', $enrollmentRecord)
            ->with('success', '入社の決め手が更新されました。');
    }
}
