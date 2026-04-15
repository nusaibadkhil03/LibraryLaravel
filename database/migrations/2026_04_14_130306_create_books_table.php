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
            $table->string('author');
            $table->string('isbn')->nullable()->unique();
            $table->string('publisher')->nullable();
            $table->year('publication_year')->nullable();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('file_path')->nullable();

            $table->string('language', 50)->nullable();
            $table->unsignedInteger('pages')->nullable();

            $table->string('shelf_location')->nullable();

            $table->unsignedInteger('total_copies')->default(1);
            $table->unsignedInteger('available_copies')->default(1);

            $table->enum('status', ['available', 'unavailable', 'archived'])
                ->default('available');

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