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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->string('thumbnail')->nullable();
            $table->jsonb('meta')->nullable()->comment('page meta { title, keywords, description }');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->text('excerpt')->nullable()->comment('short description');
            $table->text('description')->nullable('full description');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->addAuditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
