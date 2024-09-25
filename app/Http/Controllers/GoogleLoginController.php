<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        if ($request->has('redirect_to')) {
            $redirectTo = $request->query('redirect_to');
            // URLが登録ページの場合、そのクエリパラメータを取得
            if (str_contains($redirectTo, '/register') && str_contains($redirectTo, 'redirect_to=')) {
                $parsedUrl = parse_url($redirectTo);
                parse_str($parsedUrl['query'] ?? '', $queryParams);
                $redirectTo = urldecode($queryParams['redirect_to'] ?? route('home'));
            }
            session(['google_redirect_to' => $redirectTo]);
        }
    
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
    
            // セッションからリダイレクト先のURLを取得
            $redirectTo = session('google_redirect_to', route('home'));

            // セッションからリダイレクト先のURLを削除
            session()->forget('google_redirect_to');

            return redirect($redirectTo);
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // 認証がキャンセルされた場合の処理
            return redirect()->route('login')->with('error', 'Google認証がキャンセルされました。');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('login')->with('error', '認証中にエラーが発生しました。');
        }
    }
}