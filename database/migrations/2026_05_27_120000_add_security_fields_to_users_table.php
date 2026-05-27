<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('two_factor_enabled')->default(true)->after('remember_token');
            $table->string('login_otp_code')->nullable()->after('two_factor_enabled');
            $table->timestamp('login_otp_expires_at')->nullable()->after('login_otp_code');
            $table->unsignedTinyInteger('login_otp_attempts')->default(0)->after('login_otp_expires_at');
            $table->timestamp('last_login_at')->nullable()->after('login_otp_attempts');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
            $table->string('account_status')->default('aktif')->after('last_login_ip');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'two_factor_enabled', 'login_otp_code', 'login_otp_expires_at',
                'login_otp_attempts', 'last_login_at', 'last_login_ip', 'account_status',
            ]);
        });
    }
};
