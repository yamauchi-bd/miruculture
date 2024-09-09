<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Password::defaults(
            static fn() => Password::min(8) // 8文字以上であること
                ->max(255) // 255文字以下であること
                ->numbers() // 数字を1文字以上含むこと
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            $rule = Password::min(Config::get('auth.password_rules.min', 8));

            if (Config::get('auth.password_rules.letters', true)) {
                $rule->letters();
            }
            if (Config::get('auth.password_rules.numbers', true)) {
                $rule->numbers();
            }
            if (Config::get('auth.password_rules.mixed', false)) {
                $rule->mixedCase();
            }
            if (Config::get('auth.password_rules.symbols', false)) {
                $rule->symbols();
            }
            if (Config::get('auth.password_rules.uncompromised', true)) {
                $rule->uncompromised();
            }

            return $rule;
        });

        // カスタムメッセージをValidatorに追加
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            return true; // 実際のバリデーションはPassword::defaultsで行われるため、ここではtrueを返す
        });

        Validator::replacer('password', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':min', Config::get('auth.password_rules.min', 8), $message);
        });

        // パスワードルールのカスタムメッセージを設定
        Validator::extend('password_rules', function () {
            return true;
        });

        Validator::replacer('password_rules', function ($message, $attribute, $rule, $parameters) {
            $messages = [
                'letters' => 'パスワードは少なくとも1つの英字を含む必要があります。',
                'numbers' => 'パスワードは少なくとも1つの数字を含む必要があります。',
                'min' => 'パスワードは:min文字以上である必要があります。',
                'uncompromised' => 'このパスワードは漏洩している可能性があります。別のパスワードを選択してください。',
            ];

            return $messages[$rule] ?? $message;
        });
    }
}
