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
    Schema::table('past_exams', function (Blueprint $table) {
        $table->string('title')->after('id');
        $table->foreignId('department_id')->after('title')->constrained()->cascadeOnDelete();
        $table->foreignId('category_id')->nullable()->after('department_id')->constrained()->nullOnDelete();

        $table->string('subject_name')->nullable()->after('category_id');
        $table->string('doctor_name')->nullable()->after('subject_name');

        $table->string('academic_year')->nullable()->after('doctor_name');
        $table->enum('semester', ['fall', 'spring', 'summer'])->nullable()->after('academic_year');
        $table->year('exam_year')->nullable()->after('semester');

        $table->text('description')->nullable()->after('exam_year');
        $table->string('file_path')->after('description');

        $table->enum('status', ['published', 'hidden', 'archived'])
              ->default('published')
              ->after('file_path');
    });
}

public function down(): void
{
    Schema::table('past_exams', function (Blueprint $table) {
        $table->dropForeign(['department_id']);
        $table->dropForeign(['category_id']);

        $table->dropColumn([
            'title',
            'department_id',
            'category_id',
            'subject_name',
            'doctor_name',
            'academic_year',
            'semester',
            'exam_year',
            'description',
            'file_path',
            'status',
        ]);
    });
}

    /**
     * Reverse the migrations.
     */
    
};
