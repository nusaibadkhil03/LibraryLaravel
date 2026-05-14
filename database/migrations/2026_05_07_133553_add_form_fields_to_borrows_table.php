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
    Schema::table('borrows', function (Blueprint $table) {
        $table->string('student_name')->nullable()->after('library_book_id');
        $table->string('student_number')->nullable()->after('student_name');
        $table->string('edition_number')->nullable()->after('student_number');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('borrows', function (Blueprint $table) {
        $table->dropColumn([
            'student_name',
            'student_number',
            'edition_number',
        ]);
    });
}
};
