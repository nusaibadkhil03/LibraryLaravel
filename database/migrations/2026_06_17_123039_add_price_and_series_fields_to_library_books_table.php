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
        $table->decimal('price', 10, 2)->nullable()->after('total_copies');

        $table->boolean('is_series')->default(false)->after('price');
        $table->string('series_name')->nullable()->after('is_series');
        $table->integer('series_parts_count')->nullable()->after('series_name');
        $table->integer('part_number')->nullable()->after('series_parts_count');

        $table->text('loss_policy')->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('library_books', function (Blueprint $table) {
        $table->dropColumn([
            'price',
            'is_series',
            'series_name',
            'series_parts_count',
            'part_number',
            'loss_policy'
        ]);
    });
}
};
