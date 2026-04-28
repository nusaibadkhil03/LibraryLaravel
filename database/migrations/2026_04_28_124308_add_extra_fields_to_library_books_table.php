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
        $table->string('publisher')->nullable();
        $table->year('publication_year')->nullable();
        $table->string('publication_place')->nullable();
        $table->string('book_number')->nullable();
    });
}

public function down(): void
{
    Schema::table('library_books', function (Blueprint $table) {
        $table->dropColumn([
            'publisher',
            'publication_year',
            'publication_place',
            'book_number'
        ]);
    });
}
};
