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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('parent_code')->nullable();
            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->string('code')->nullable();
            $table->string('value')->nullable();
            $table->jsonb('meta')->nullable()->comment('page meta { title, keywords, description }');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('excerpt')->nullable()->comment('short description');
            $table->string('description')->nullable('full description');
            $table->jsonb('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
