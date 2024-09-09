<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Gender;
use App\Models\Prefecture;
use App\Models\CareerStatus;
use App\Models\Industry;
use App\Models\JobCategory;
use App\Models\JobYear;
use App\Models\AnnualIncome;
use App\Models\JobMotivation;
use App\Models\CollegeType;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $career = $user->career; // ユーザーに関連付けられたキャリア情報を取得
    
        return view('profile.edit', [
            'user' => $user,
            'career' => $career,
            'genders' => Gender::all(),
            'prefectures' => Prefecture::all(),
            'careerStatuses' => CareerStatus::all(),
            'industries' => Industry::all(),
            'jobCategories' => JobCategory::whereNull('parent_id')->with('children')->get(),
            'jobYears' => JobYear::all(),
            'annualIncomes' => AnnualIncome::all(),
            'jobChangeMotivations' => JobMotivation::change()->get(),
            'sideJobMotivations' => JobMotivation::side()->get(),
            'collegeTypes' => CollegeType::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $newEmail = $request->input('email');

        if ($newEmail !== $user->email) {
            $user->new_email = $newEmail;
            $user->email_change_token = Str::random(60);
            $user->save();

            // 確認メールを送信
            $user->sendEmailChangeNotification();

            return Redirect::route('profile.edit')->with('status', 'verification-link-sent');
        }

        // その他のプロフィール更新処理

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function confirmEmailChange(Request $request, $token)
    {
        $user = User::where('email_change_token', $token)->firstOrFail();

        $user->email = $user->new_email;
        $user->new_email = null;
        $user->email_change_token = null;
        $user->email_verified_at = now();
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'email-changed');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
