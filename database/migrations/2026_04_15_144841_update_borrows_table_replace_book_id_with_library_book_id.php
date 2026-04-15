<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropColumn('book_id');

            $table->foreignId('library_book_id')
                ->after('user_id')
                ->constrained('library_books')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropForeign(['library_book_id']);
            $table->dropColumn('library_book_id');

            $table->foreignId('book_id')
                ->after('user_id')
                ->constrained('books')
                ->cascadeOnDelete();
        });
    }
};