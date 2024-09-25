<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        if ($request->has('redirect_to')) {
            $redirectTo = $request->query('redirect_to');
            // URLが登録ページの場合、そのクエリパラメータを取得
            if (str_contains($redirectTo, '/register') && str_contains($redirectTo, 'redirect_to=')) {
                $parsedUrl = parse_url($redirectTo);
                parse_str($parsedUrl['query'] ?? '', $queryParams);
                $redirectTo = urldecode($queryParams['redirect_to'] ?? route('home'));
            }
            session(['login_redirect_to' => $redirectTo]);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirectTo = session('login_redirect_to', route('home', absolute: false));
        session()->forget('login_redirect_to');

        return redirect()->intended($redirectTo);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}