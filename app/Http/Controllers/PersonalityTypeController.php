<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalityType;
use App\Models\EnrollmentRecord;

class PersonalityTypeController extends Controller
{
    public function create(EnrollmentRecord $enrollmentRecord)
    {
        $sixteenTypes = PersonalityType::getSixteenTypes();
        $latestType = $enrollmentRecord->personalityTypes()->latest()->first();
        $isUpdate = $latestType !== null;

        $formData = [];
        if ($isUpdate) {
            $formData['type'] = $latestType->type;
        }

        return view('posts.create_personality_types', compact('enrollmentRecord', 'sixteenTypes', 'isUpdate', 'formData'));
    }

    public function store(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(PersonalityType::getSixteenTypes())),
        ]);

        $latestType = $enrollmentRecord->personalityTypes()->latest()->first();

        if (!$latestType || $latestType->type !== $validatedData['type']) {
            // 新しい性格タイプを作成
            $enrollmentRecord->personalityTypes()->create($validatedData);
            $message = '新しい16タイプ性格診断(MBTI)が登録されました。';
        } else {
            $message = '16タイプ性格診断(MBTI)に変更はありませんでした。';
        }

        // 次のステップ（決定要因の入力）にリダイレクト
        return redirect()->route('deciding_factors.create', $enrollmentRecord)
            ->with('success', $message . '続いて入社の決め手を入力してください。');
    }
}
