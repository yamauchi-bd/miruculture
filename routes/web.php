<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EnrollmentRecordController;
use App\Http\Controllers\PersonalityTypeController;
use App\Http\Controllers\DecidingFactorController;
use App\Http\Controllers\CompanyCultureController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// 基本ルート
Route::get('/', [WelcomeController::class, 'index'])->name('home');

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
    
    // 在籍情報関連
    Route::resource('enrollment_records', EnrollmentRecordController::class);

    // 16タイプ関連
    Route::get('/personality-types/create/{enrollmentRecord}', [PersonalityTypeController::class, 'create'])->name('personality_types.create');
    Route::post('/personality-types/{enrollmentRecord}', [PersonalityTypeController::class, 'store'])->name('personality_types.store');
    
    // 入社の決め手関連
    Route::get('/deciding-factors/create/{enrollmentRecord}', [DecidingFactorController::class, 'create'])->name('deciding_factors.create');
    Route::post('/deciding-factors/{enrollmentRecord}', [DecidingFactorController::class, 'store'])->name('deciding_factors.store');

    // 社風•雰囲気関連
    Route::get('/company-cultures/create/{enrollmentRecord}', [CompanyCultureController::class, 'create'])->name('company_cultures.create');
    Route::post('/company-cultures/{enrollmentRecord}', [CompanyCultureController::class, 'store'])->name('company_cultures.store');

    // 投稿関連
    Route::get('/posts/create/step1', [PostController::class, 'createStep1'])->name('posts.create.step1');
    Route::post('/posts/create/step1', [PostController::class, 'storeStep1'])->name('posts.store.step1');
    Route::get('/posts/create/step2', [PostController::class, 'createStep2'])->name('posts.create.step2');
    Route::post('/posts/create/step2', [PostController::class, 'storeStep2'])->name('posts.store.step2');
    Route::get('/posts/create/step3', [PostController::class, 'createStep3'])->name('posts.create.step3');
    Route::post('/posts/create/step3', [PostController::class, 'store'])->name('posts.store');
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
// Auth::routes(['verify' => true]);

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

// 4桁コード認証用のルート
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/register/verify', [RegisteredUserController::class, 'showVerificationForm'])->name('register.verify');
    Route::post('/register/verify', [RegisteredUserController::class, 'verify']);
    Route::post('/register/resend-code', [RegisteredUserController::class, 'resendCode'])->name('register.resend-code');
});

// 企業情報関連
// Route::get('/companies', function () {
//     return view('companies.index');
// });

Route::get('/companies/search', [CompanyController::class, 'search'])->name('companies.search');
Route::put('/companies/{corporate_number}', [CompanyController::class, 'update'])->name('companies.update');
Route::get('/companies/{corporate_number}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{corporate_number}/edit', [CompanyController::class, 'edit'])->name('companies.edit');

Route::get('/legal', [InformationController::class, 'legal'])->name('legal');

// 代わりに必要な認証ルートのみを定義
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 企業検索API
Route::get('/api/company-search', function (Request $request) {
    $query = $request->input('query');
    $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin?name=" . urlencode($query);

    $response = Http::withHeaders([
        'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
    ])->get($apiUrl);

    $data = $response->json();
    Log::info('API Response:', ['data' => $data]);  // 配列としてログに出力

    return $data;
});

require __DIR__ . '/auth.php';

