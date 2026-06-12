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
    Schema::table('library_books', function (Blueprint $table) {
        $table->string('department_name')->nullable()->after('department_id');
        $table->text('description')->nullable()->after('category_name');
    });
}

public function down(): void
{
    Schema::table('library_books', function (Blueprint $table) {
        $table->dropColumn(['department_name', 'description']);
    });
}
};
