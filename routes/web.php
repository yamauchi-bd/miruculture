<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// 基本ルート
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// 認証済みユーザー用ルート
Route::middleware(['auth', 'verified'])->group(function () {
    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // キャリア関連
    Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');
    Route::get('/careers/create', [CareerController::class, 'create'])->name('careers.create');
    Route::get('/careers/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
    Route::put('/careers/{career}', [CareerController::class, 'update'])->name('careers.update');
    
    // 投稿関連
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/validate-section1', [PostController::class, 'validateSection1'])->name('posts.validate.section1');
});

// 投稿関連（一部は認証不要）
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Google認証
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

// メール認証関連
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '確認リンクを送信しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/change/{token}', [ProfileController::class, 'confirmEmailChange'])
    ->middleware(['auth'])
    ->name('email.change.confirm');

//メールアドレス4桁コード認証
Route::post('/register/request', [RegisterController::class, 'request'])->name('register.request');
Route::get('/register/verify', [RegisterController::class, 'showVerificationForm'])->name('register.verify');
Route::post('/register/verify', [RegisterController::class, 'verify']);
Route::post('/register/resend-code', [RegisterController::class, 'resendCode'])->name('register.resend-code');

// 企業情報関連
// Route::get('/companies', function () {
//     return view('companies.index');
// });

Route::get('/companies/search', [CompanyController::class, 'search'])->name('companies.search');
Route::get('/companies/{corporate_number}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{corporate_number}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{corporate_number}', [CompanyController::class, 'update'])->name('companies.update');

Route::get('/rule', [InformationController::class, 'rule'])->name('rule');
Route::get('/policy', [InformationController::class, 'policy'])->name('policy');

require __DIR__ . '/auth.php';