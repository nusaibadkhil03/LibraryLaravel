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
         Schema::create('curricula', function (Blueprint $table) {
        $table->id();

        // نوع المحتوى (جداول / خطة / تقويم)
        $table->enum('type', ['schedule', 'plan', 'calendar']);

        // مسار الصورة
        $table->string('image');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricula');
    }
};
