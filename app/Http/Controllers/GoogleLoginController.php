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

            $user = User::firstOrCreate(['email' => $email]);

            Auth::login($user);

            return redirect()->route('careers.create');
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}

