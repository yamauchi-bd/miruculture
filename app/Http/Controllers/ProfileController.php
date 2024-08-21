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

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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
