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
        Schema::create('study_schedules', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->foreignId('department_id')->constrained()->cascadeOnDelete();

    $table->string('academic_year')->nullable();
    $table->enum('semester', ['first', 'second', 'full_year'])->nullable();

    $table->text('description')->nullable();
    $table->string('file_path');

    $table->enum('status', ['published', 'hidden', 'archived'])->default('published');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_schedules');
    }
};
