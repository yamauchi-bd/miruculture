<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // パスワードをnullableに変更
            $table->string('password')->nullable()->change();

            // 新しいカラムを追加（既に存在しない場合のみ）
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'verification_code')) {
                $table->string('verification_code')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'new_email')) {
                $table->string('new_email')->nullable()->after('email_verified_at');
            }
            if (!Schema::hasColumn('users', 'email_change_token')) {
                $table->string('email_change_token')->nullable()->after('new_email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // パスワードを元に戻す
            $table->string('password')->nullable(false)->change();

            // 追加したカラムを削除
            $table->dropColumn(['google_id', 'verification_code', 'new_email', 'email_change_token']);
        });
    }
};