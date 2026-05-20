<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE curricula 
            MODIFY type ENUM(
                'schedule',
                'plan',
                'calendar',
                'exam'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE curricula 
            MODIFY type ENUM(
                'schedule',
                'plan',
                'calendar'
            ) NOT NULL
        ");
    }
};