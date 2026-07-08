<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->nullable()->after('email');

            $table->enum('role', [
                'student',
                'employee',
                'employer',
                'freelancer',
                'investor',
                'mentor',
                'admin'
            ])->after('password');

            $table->decimal('membership_fee', 10, 2)
                ->nullable()
                ->after('role');

            $table->enum('payment_status', [
                'pending',
                'paid'
            ])->nullable()->after('membership_fee');

            $table->enum('verification_status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending')->after('payment_status');

            $table->enum('status', [
                'active',
                'inactive',
                'banned'
            ])->default('active')->after('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'role',
                'membership_fee',
                'payment_status',
                'verification_status',
                'status',
            ]);
        });
    }
};