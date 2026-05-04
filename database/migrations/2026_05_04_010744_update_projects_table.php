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
    Schema::table('projects', function (Blueprint $table) {
        $table->string('students_names')->nullable()->after('title');
        $table->string('supervisor_name')->nullable()->after('students_names');
        $table->enum('semester', ['fall', 'spring', 'summer'])->nullable()->after('academic_year');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
