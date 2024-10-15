<?php

namespace App\Http\Controllers;

use App\Models\EnrollmentRecord;
use App\Models\Company;
use App\Models\JobCategory;
use App\Models\PersonalityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class EnrollmentRecordController extends Controller
{
    public function index()
    {
        $enrollmentRecords = EnrollmentRecord::with('jobCategory')->paginate(15);
        return view('enrollment_records.index', compact('enrollmentRecords'));
    }

    public function create(Request $request)
    {
        $company = null;
        if ($request->has('corporate_number')) {
            $company = Company::where('corporate_number', $request->corporate_number)->first();
        }

        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();

        return view('posts.create_enrollment_record', compact('jobCategories', 'company'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'required|string|size:13',
            'entry_type' => 'required|string',
            'status' => 'required|string',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
        ]);


        $user = Auth::user();

        // 同じユーザーと企業番号の組み合わせで既存の記録を検索
        $existingRecord = EnrollmentRecord::where('user_id', $user->id)
                                          ->where('corporate_number', $validatedData['corporate_number'])
                                          ->latest()
                                          ->first();

        if ($existingRecord) {
            // 既存の記録と新しいデータを比較
            $differences = array_diff_assoc($validatedData, $existingRecord->toArray());
            
            // start_yearは別途比較
            if ($existingRecord->start_year != $validatedData['start_year']) {
                $differences['year_changed'] = true;
            }

            // 重要なフィールドに変更がある場合のみ新しい記録を作成
            if (!empty($differences)) {
                $enrollmentRecord = $user->enrollmentRecords()->create($validatedData);
                $message = '新しい在籍情報が登録されました。';
            } else {
                $enrollmentRecord = $existingRecord;
                $message = '在籍情報に変更はありませんでした。';
            }
        } else {
            // 既存の記録がない場合は新規作成
            $enrollmentRecord = $user->enrollmentRecords()->create($validatedData);
            $message = '在籍情報が登録されました。';
        }

        return redirect()->route('personality_types.create', $enrollmentRecord)
            ->with('success', $message . '続いて16タイプ性格診断(MBTI)を入力してください。');
    }

    public function show(EnrollmentRecord $enrollmentRecord)
    {
        return view('enrollment_records.show', compact('enrollmentRecord'));
    }

    public function edit(EnrollmentRecord $enrollmentRecord)
    {
        $jobCategories = JobCategory::whereNull('parent_id')->with('children')->get();
        return view('enrollment_records.edit', compact('enrollmentRecord', 'jobCategories'));
    }

    public function update(Request $request, EnrollmentRecord $enrollmentRecord)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'corporate_number' => 'required|string|size:13',
            'entry_type' => 'required|string',
            'status' => 'required|string',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'current_job_category_id' => 'required|exists:job_categories,id',
            'current_job_subcategory_id' => 'required|exists:job_categories,id',
        ]);

        $enrollmentRecord->update($validatedData);

        // 性格タイプの更新
        if ($request->has('personality_type')) {
            $enrollmentRecord->personalityType()->updateOrCreate(
                ['enrollment_record_id' => $enrollmentRecord->id],
                ['type' => $request->personality_type]
            );
        }

        // 決定要因の更新
        $enrollmentRecord->decidingFactor()->delete();
        for ($i = 1; $i <= 3; $i++) {
            if ($request->has("deciding_factor_$i")) {
                $enrollmentRecord->decidingFactor()->create([
                    "factor_$i" => $request->input("deciding_factor_$i"),
                    "detail_$i" => $request->input("factor_{$i}_detail"),
                    "satisfaction_$i" => $request->input("factor_{$i}_satisfaction"),
                ]);
            }
        }

        // 会社文化の更新
        $cultureDatas = [];
        for ($i = 0; $i < 8; $i++) {
            $cultureDatas["culture_$i"] = $request->input("culture_$i");
            $cultureDatas["culture_detail_$i"] = $request->input("culture_detail_$i");
        }
        $enrollmentRecord->companyCulture()->updateOrCreate(
            ['enrollment_record_id' => $enrollmentRecord->id],
            $cultureDatas
        );

        return redirect()->route('enrollment_records.show', $enrollmentRecord)
            ->with('success', '在籍情報が正常に更新されました。');
    }

    public function destroy(EnrollmentRecord $enrollmentRecord)
    {
        $enrollmentRecord->delete();
        return redirect()->route('enrollment_records.index')
            ->with('success', '在籍情報が正常に削除されました。');
    }

}
