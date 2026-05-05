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
    Schema::create('educational_channels', function (Blueprint $table) {
        $table->id();

        $table->string('title');
        $table->foreignId('department_id')->constrained()->cascadeOnDelete();

        $table->string('channel_url');
        $table->string('platform')->nullable();

        $table->text('description')->nullable();

        $table->enum('status', ['published', 'hidden'])->default('published');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_channels');
    }
};
