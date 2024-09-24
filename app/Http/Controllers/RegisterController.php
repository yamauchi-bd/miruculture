<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCode;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function request(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
        ]);

        // 確認コードの生成
        $verificationCode = sprintf('%04d', mt_rand(0, 9999));

        // ユーザーの仮登録
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
            'email_verified_at' => null,
        ]);

        // 確認メールの送信
        Mail::to($user->email)->send(new VerificationCode($verificationCode));

        // セッションにメールアドレスとリダイレクト先URLを保存
        session(['registration_email' => $user->email, 'redirect_to' => $request->input('redirect_to')]);

        return redirect()->route('register.verify')
            ->with('message', '認証コードを記載したメールを送信しました。');
    }

    public function showVerificationForm()
    {
        $email = session('registration_email');
        if (!$email) {
            return redirect()->route('register')->with('error', '登録プロセスを最初からやり直してください。');
        }
        return view('auth.verify', ['email' => $email]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ここでユーザーを認証したり、追加の処理を行うことができます

        return redirect()->route('home')->with('success', '登録が完了しました！');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:4|regex:/^[0-9]{4}$/',
        ]);

        $user = User::where('verification_code', $request->verification_code)
            ->whereNull('email_verified_at')
            ->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => '無効な認証コードです。']);
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        // ユーザーを認証
        Auth::login($user);

        // セッションからリダイレクト先のURLを取得
        $redirectTo = session('redirect_to', route('home'));

        // セッションからリダイレクト先のURLを削除
        session()->forget('redirect_to');

        return redirect($redirectTo)->with('success', '登録が完了しました！');
    }

    public function resendCode(Request $request)
    {
        $user = User::where('email', $request->session()->get('registration_email'))
            ->whereNull('email_verified_at')
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'ユーザーが見つかりません。']);
        }

        // 新しい確認コードの生成（4桁の数字）
        $newVerificationCode = sprintf('%04d', mt_rand(0, 9999));
        $user->verification_code = $newVerificationCode;
        $user->save();

        // 新しい確認コードのメール送信
        Mail::to($user->email)->send(new VerificationCode($newVerificationCode));

        return back()->with('message', '新しい確認コードを送信しました。');
    }
}