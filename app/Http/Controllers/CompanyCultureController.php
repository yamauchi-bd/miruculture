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
        $existingCulture = $enrollmentRecord->companyCultures()->first();
        $isUpdate = $existingCulture !== null;

        $formData = [];
        if ($isUpdate) {
            foreach (range(0, 7) as $index) {
                $formData["culture_$index"] = $existingCulture["culture_$index"];
                $formData["culture_detail_$index"] = $existingCulture["culture_detail_$index"];
            }
        }

        return view('posts.create_company_cultures', compact('enrollmentRecord', 'cultureItems', 'isUpdate', 'formData'));
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

        // 合計文字数のバリデーション
        $totalCharCount = array_reduce(range(0, 7), function ($carry, $index) use ($validatedData) {
            return $carry + mb_strlen($validatedData["culture_detail_$index"] ?? '');
        }, 0);

        if ($totalCharCount < 200) {
            return back()->withErrors(['total_char_count' => '自由記述の合計文字数は200文字以上である必要があります。'])->withInput();
        }

        $existingCulture = $enrollmentRecord->companyCultures()->latest()->first();

        if ($existingCulture) {
            $isItemChanged = $this->isItemChanged($existingCulture, $validatedData);

            if ($isItemChanged) {
                // 項目が変更された場合は新規保存
                $enrollmentRecord->companyCultures()->create($validatedData);
                $message = '社風•雰囲気が新しく登録されました。';
            } else {
                // 詳細のみが変更された場合は上書き保存
                $existingCulture->update($validatedData);
                $message = '社風•雰囲気が更新されました。';
            }
        } else {
            // 初めての登録の場合
            $enrollmentRecord->companyCultures()->create($validatedData);
            $message = '社風•雰囲気が登録されました。';
        }

        return redirect()->route('companies.show', ['corporate_number' => $enrollmentRecord->corporate_number])
            ->with('success', $message);
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
            'culture_detail' => 'required|string|min:200',
        ]);

        $enrollmentRecord->companyCulture()->update($validatedData);

        return redirect()->route('enrollment_records.show', $enrollmentRecord)
            ->with('success', '社風•雰囲気が更新されました。');
    }

    private function isItemChanged($existingCulture, $newData)
    {
        for ($i = 0; $i <= 7; $i++) {
            if ($existingCulture["culture_$i"] != $newData["culture_$i"]) {
                return true;
            }
        }
        return false;
    }
}
