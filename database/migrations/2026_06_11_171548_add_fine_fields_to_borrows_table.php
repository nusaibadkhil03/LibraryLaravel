<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrows', function (Blueprint $table) {

            // تاريخ الإرجاع الفعلي
            $table->date('actual_return_date')->nullable();

            // هل يوجد تأخير؟
            $table->boolean('is_late')->default(false);

            // قيمة الغرامة
            $table->decimal('fine_amount', 8, 2)->default(0);

            // هل تم دفع الغرامة؟
            $table->boolean('fine_paid')->default(false);

            // ملاحظات عند الإرجاع
            $table->text('return_notes')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {

            $table->dropColumn([
                'actual_return_date',
                'is_late',
                'fine_amount',
                'fine_paid',
                'return_notes',
            ]);

        });
    }
};