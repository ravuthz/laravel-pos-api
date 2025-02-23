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
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('salary', 12, 3)->nullable();
            $table->string('address')->nullable();
            $table->string('username')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();

            $table->string('type_code')->nullable();
            $table->string('position_code')->nullable();

            $table->addAuditColumns(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropColumn('salary');
            $table->dropColumn('address');
            $table->dropColumn('username');
            $table->dropColumn('position');
            $table->dropColumn('shop_name');
            $table->dropColumn('bank_name');
            $table->dropColumn('account_holder');
            $table->dropColumn('account_number');

            $table->dropAuditColumns(['created_at', 'updated_at']);
        });
    }
};
