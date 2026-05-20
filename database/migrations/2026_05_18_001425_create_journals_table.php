<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('publication_year')->nullable();
            $table->string('publisher')->nullable();
            $table->text('description')->nullable();

            $table->string('file_path');

            $table->enum('status', ['published', 'hidden'])
                  ->default('published');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};