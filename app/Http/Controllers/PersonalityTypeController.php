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
        return view('posts.create_personality_types', compact('enrollmentRecord', 'sixteenTypes'));
    }

    public function store(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(PersonalityType::getSixteenTypes())),
        ]);

        $enrollmentRecord->personalityTypes()->create($validatedData);

        // 次のステップ（例：決定要因の入力）にリダイレクト
        return redirect()->route('deciding_factors.create', $enrollmentRecord)
            ->with('success', '16タイプ性格診断(MBTI)が登録されました。続いて入社の決め手を入力してください。');
    }
}
