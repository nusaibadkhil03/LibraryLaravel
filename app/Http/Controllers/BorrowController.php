<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\LibraryBook;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function store($bookId)
    {
        $book = LibraryBook::findOrFail($bookId);

        if ($book->available_copies <= 1) {
            return back()->with('error', 'لا يمكن استعارة هذا الكتاب لأن المتبقي نسخة واحدة فقط.');
        }

        Borrow::create([
            'user_id' => auth()->id(),
            'library_book_id' => $book->id,
            'status' => 'pending',
            'notes' => 'تنبيه: في حالة التأخر عن تاريخ الإرجاع سيتم تطبيق غرامة مالية.',
        ]);

        return back()->with('success', 'تم إرسال طلب الاستعارة بنجاح، بانتظار موافقة الأدمن.');
    }
}