<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
            $email = $socialiteUser->email;
            $google_id = $socialiteUser->id;
    
            $user = User::updateOrCreate(
                ['email' => $email],
                ['google_id' => $google_id]
            );
    
            Auth::login($user);
    
            return redirect()->route('home');
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // 認証がキャンセルされた場合の処理
            return redirect()->route('login')->with('error', 'Google認証がキャンセルされました。');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('login')->with('error', '認証中にエラーが発生しました。');
        }
    }
}

