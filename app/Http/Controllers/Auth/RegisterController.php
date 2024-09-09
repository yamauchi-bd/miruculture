<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function request(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
        ]);

        $verificationCode = sprintf('%04d', mt_rand(0, 9999));

        // セッションに一時的にユーザー情報を保存
        $request->session()->put('registration_data', [
            'email' => $request->email,
            'password' => $request->password,
            'verification_code' => $verificationCode,
        ]);

    // メール送信処理
    try {
        Mail::to($request->email)->send(new VerificationCode($verificationCode));
    } catch (\Exception $e) {
        // メール送信に失敗した場合のエラーハンドリング
        return back()->withErrors(['email' => 'メールの送信に失敗しました。']);
    }

    return redirect()->route('register.verify')->with('message', '認証コードを記載したメールを送信しました。');
    }

    public function showVerificationForm()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:4',
        ]);

        $registrationData = $request->session()->get('registration_data');

        if (!$registrationData || $request->verification_code !== $registrationData['verification_code']) {
            return back()->withErrors(['verification_code' => '認証コードが正しくありません。']);
        }

        // ユーザーを作成
        $user = User::create([
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']),
        ]);

        // セッションからデータを削除
        $request->session()->forget('registration_data');

        // ログイン処理
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function resendCode(Request $request)
    {
        $registrationData = $request->session()->get('registration_data');

        if (!$registrationData) {
            return back()->withErrors(['email' => '登録情報が見つかりません。最初からやり直してください。']);
        }

        $verificationCode = $this->generateVerificationCode();
        $registrationData['verification_code'] = $verificationCode;
        $request->session()->put('registration_data', $registrationData);

        Mail::to($registrationData['email'])->send(new VerificationCode($verificationCode));

        return back()->with('message', '新しい認証コードを送信しました。');
    }

    private function generateVerificationCode()
    {
        return sprintf('%04d', mt_rand(0, 9999));
    }
}