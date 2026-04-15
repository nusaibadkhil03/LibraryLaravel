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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();

            // المستخدم اللي استعار
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // الكتاب
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete();

            // تاريخ الاستعارة
            $table->date('borrow_date');

            // تاريخ الإرجاع المتوقع
            $table->date('due_date');

            // تاريخ الإرجاع الفعلي
            $table->date('return_date')->nullable();

            // الحالة
            $table->enum('status', [
                'pending',     // طلب
                'approved',    // تمت الموافقة
                'borrowed',    // مستعار
                'returned',    // تم الإرجاع
                'rejected',    // مرفوض
                'overdue'      // متأخر
            ])->default('pending');

            // الأدمن اللي وافق
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // ملاحظات
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};