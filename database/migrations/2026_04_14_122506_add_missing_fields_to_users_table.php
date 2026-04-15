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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'student', 'staff'])
                ->default('student')
                ->after('password');

            $table->string('student_number', 50)
                ->nullable()
                ->unique()
                ->after('role');

            $table->string('phone', 20)
                ->nullable()
                ->after('student_number');

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete()
                ->after('phone');

            $table->string('academic_year', 20)
                ->nullable()
                ->after('department_id');

            $table->enum('status', ['active', 'inactive', 'suspended'])
                ->default('active')
                ->after('academic_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropUnique(['student_number']);
            $table->dropColumn([
                'role',
                'student_number',
                'phone',
                'department_id',
                'academic_year',
                'status',
            ]);
        });
    }
};