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
       Schema::create('books', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->string('author')->nullable();
    $table->string('isbn')->nullable();
    $table->string('publisher')->nullable();
    $table->year('publication_year')->nullable();

    $table->foreignId('department_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

    $table->text('description')->nullable();
    $table->string('cover_image')->nullable();
    $table->string('file_path');

    $table->string('file_size')->nullable();
    $table->unsignedInteger('download_count')->default(0);

    $table->string('language')->nullable();
    $table->integer('pages')->nullable();

    $table->enum('status', ['published', 'hidden', 'archived'])->default('published');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
