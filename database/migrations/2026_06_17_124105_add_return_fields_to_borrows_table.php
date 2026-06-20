<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrows', function (Blueprint $table) {

            $table->string('return_status')
                  ->default('returned')
                  ->after('status');

            $table->string('loss_compensation_type')
                  ->nullable()
                  ->after('return_status');

            $table->decimal('loss_compensation_amount', 10, 2)
                  ->default(0)
                  ->after('loss_compensation_type');

            $table->text('loss_notes')
                  ->nullable()
                  ->after('loss_compensation_amount');

        });
    }

    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {

            $table->dropColumn([
                'return_status',
                'loss_compensation_type',
                'loss_compensation_amount',
                'loss_notes'
            ]);

        });
    }
};