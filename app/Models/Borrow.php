<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LibraryBook;

class Borrow extends Model
{
    protected $fillable = [
    'user_id',
    'library_book_id',
    'status',
    'notes',
    'borrow_date',
    'due_date',
    'actual_return_date',
    'is_late',
    'fine_amount',
    'fine_paid',
    'return_notes',

    'return_status',
    'loss_compensation_type',
    'loss_compensation_amount',
    'loss_notes',
];

    // المستخدم الذي استعار
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // الكتاب الفعلي في المكتبة
    public function libraryBook()
    {
        return $this->belongsTo(LibraryBook::class, 'library_book_id');
    }

    // الأدمن أو الموظف الذي وافق
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}