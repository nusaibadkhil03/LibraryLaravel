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
        Schema::table('syllabuses', function (Blueprint $table) {
    $table->string('lecture_number')->nullable()->after('title');
    $table->string('doctor_name')->nullable()->after('lecture_number');

        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('syllabuses', function (Blueprint $table) {
        $table->dropColumn(['lecture_number', 'doctor_name']);
    });

    }
};
