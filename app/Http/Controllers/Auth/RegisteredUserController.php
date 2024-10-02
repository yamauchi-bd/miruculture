<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCode;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $redirectTo = $request->query('redirect_to');
        if ($redirectTo) {
            $request->session()->put('redirect_after_verify', $redirectTo);
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
        ]);

        // 4桁の認証コードを生成
        $verificationCode = sprintf('%04d', mt_rand(0, 9999));

        // ユーザーを作成（email_verified_atはnullのまま）
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

        // 認証コードをメールで送信
        Mail::to($user->email)->send(new VerificationCode($verificationCode));

        // セッションに登録メールアドレスを保存
        $request->session()->put('registration_email', $user->email);
        
        // 認証コード入力ページにリダイレクト
        return redirect()->route('register.verify');
    }

    public function showVerificationForm()
    {
        $email = session('registration_email');
        if (!$email) {
            return redirect()->route('register')->with('error', '登録プロセスを最初からやり直してください。');
        }
        return view('auth.verify', ['email' => $email]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:4',
        ]);

        $user = User::where('email', session('registration_email'))
                    ->where('verification_code', $request->verification_code)
                    ->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => '無効な認証コードです。']);
        }

        // ユーザーを認証済みにする
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        // ユーザーを認証
        Auth::login($user);

        // セッションから遷移先URLを取得し、セッションをクリア
        $redirectTo = $request->session()->pull('redirect_after_verify', route('home'));
        $request->session()->forget('registration_email');

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