<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class AdminBorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'libraryBook'])->latest()->get();

        return view('admin.borrow.index', compact('borrows'));
    }

    public function approve($id)
    {
        $borrow = Borrow::with('libraryBook')->findOrFail($id);
        $book = $borrow->libraryBook;

        if ($book->available_copies <= 1) {
            return back()->with('error', 'لا يمكن قبول الطلب لأن المتبقي نسخة واحدة فقط.');
        }

        $borrow->update([
            'status' => 'borrowed',
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(5)->toDateString(),
            'approved_by' => auth()->id(),
        ]);

        $book->decrement('available_copies');

        return back()->with('success', 'تم قبول طلب الاستعارة وتحديث عدد النسخ.');
    }

    public function reject($id)
    {
        $borrow = Borrow::findOrFail($id);

        $borrow->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'تم رفض طلب الاستعارة.');
    }

    public function returnBook($id)
    {
        $borrow = Borrow::with('libraryBook')->findOrFail($id);

        if ($borrow->status != 'borrowed') {
            return back()->with('error', 'لا يمكن إرجاع هذا الطلب.');
        }

        $borrow->update([
            'status' => 'returned',
            'return_date' => now()->toDateString(),
        ]);

        $borrow->libraryBook->increment('available_copies');

        return back()->with('success', 'تم إرجاع الكتاب وتحديث عدد النسخ.');
    }
}