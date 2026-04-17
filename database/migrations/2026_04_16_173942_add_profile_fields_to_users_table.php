<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('profile_photo')->nullable()->after('address');
            $table->string('referral_code')->nullable()->unique()->after('profile_photo');
            $table->foreignId('referred_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['referred_by']); // 🔥 مهم
        $table->dropColumn(['phone', 'address', 'profile_photo', 'referral_code', 'referred_by']);
    });
}
};
