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
            $table->string('bank_name')->nullable()->after('status');
            $table->string('bank_account_number')->nullable()->after('bank_name');
            $table->string('bank_account_name')->nullable()->after('bank_account_number');
            $table->string('gcash_number')->nullable()->after('bank_account_name');
            $table->string('gcash_account')->nullable()->after('gcash_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_account_name');
            $table->dropColumn('gcash_number');
            $table->dropColumn('gcash_account');
        });
    }
};
