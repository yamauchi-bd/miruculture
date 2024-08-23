<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CareerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('careers', CareerController::class);
});

Route::get('/careers/show', [CareerController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('careers.show');

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');

//ユーザー登録確認メール
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

//メアド変更確認メール
Route::get('/email/change/{token}', [ProfileController::class, 'confirmEmailChange'])
    ->middleware(['auth'])
    ->name('email.change.confirm');

require __DIR__ . '/auth.php';