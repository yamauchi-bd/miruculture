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
        $existingFactor = $enrollmentRecord->decidingFactor;
        $isUpdate = $existingFactor !== null;

        $formData = [];
        if ($isUpdate) {
            for ($i = 1; $i <= 3; $i++) {
                $formData["factor_$i"] = $existingFactor["factor_$i"];
                $formData["detail_$i"] = $existingFactor["detail_$i"];
                $formData["satisfaction_$i"] = $existingFactor["satisfaction_$i"];
            }
        }

        return view('posts.create_deciding_factors', compact('enrollmentRecord', 'factors', 'isUpdate', 'formData'));
    }

    public function store(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $this->validateDecidingFactor($request);

        $existingFactor = $enrollmentRecord->decidingFactor;
        if ($existingFactor) {
            // 既存の決め手がある場合
            $updated = false;
            for ($i = 1; $i <= 3; $i++) {
                if (isset($validatedData["factor_$i"])) {
                    $existingFactor["factor_$i"] = $validatedData["factor_$i"];
                    $existingFactor["detail_$i"] = $validatedData["detail_$i"];
                    $existingFactor["satisfaction_$i"] = $validatedData["satisfaction_$i"];
                    $updated = true;
                }
            }
            $existingFactor->save();
            $message = $updated ? 'この企業の入社の決め手が更新されました。' : '変更はありませんでした。';
        } else {
            // 新規作成の場合
            $enrollmentRecord->decidingFactor()->create($validatedData);
            $message = 'この企業の入社の決め手が新しく登録されました。';
        }

        return redirect()->route('company_cultures.create', $enrollmentRecord)
            ->with('success', $message . '続いて社風•雰囲気を入力してください。');
    }

    private function validateDecidingFactor(Request $request)
    {
        $rules = [
            'factor_1' => 'required|string|in:' . implode(',', array_keys(DecidingFactor::getFactors())),
            'detail_1' => 'nullable|string',
            'satisfaction_1' => 'required|integer|min:1|max:5',
        ];

        for ($i = 2; $i <= 3; $i++) {
            $rules["factor_$i"] = 'nullable|string|in:' . implode(',', array_keys(DecidingFactor::getFactors()));
            $rules["detail_$i"] = 'nullable|string';
            $rules["satisfaction_$i"] = 'required_with:factor_' . $i . '|nullable|integer|min:1|max:5';
        }

        return $request->validate($rules);
    }
}
