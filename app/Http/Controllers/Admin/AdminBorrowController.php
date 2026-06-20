<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class AdminBorrowController extends Controller
{
    public function index(Request $request)
{
    $query = Borrow::with(['user.department', 'libraryBook']);

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('student_name', 'like', '%' . $request->search . '%')
              ->orWhere('student_number', 'like', '%' . $request->search . '%')
              ->orWhereHas('user', function ($userQuery) use ($request) {
                  $userQuery->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('student_number', 'like', '%' . $request->search . '%')
                      ->orWhere('phone', 'like', '%' . $request->search . '%');
              })
              ->orWhereHas('libraryBook', function ($bookQuery) use ($request) {
                  $bookQuery->where('title', 'like', '%' . $request->search . '%');
              });
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('borrow_date') && strtotime($request->borrow_date)) {
        $query->whereDate('borrow_date', $request->borrow_date);
    }

    if ($request->filled('due_date') && strtotime($request->due_date)) {
        $query->whereDate('due_date', $request->due_date);
    }

    if ($request->sort === 'oldest') {
        $query->oldest();
    } elseif ($request->sort === 'student') {
        $query->orderBy('student_name');
    } elseif ($request->sort === 'borrow_date') {
        $query->orderByDesc('borrow_date');
    } elseif ($request->sort === 'due_date') {
        $query->orderByDesc('due_date');
    } else {
        $query->latest();
    }

    $borrows = $query->get();

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

    public function reject(Request $request, $id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:500',
    ]);

    $borrow = Borrow::findOrFail($id);

    $borrow->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
    ]);

    return back()->with('success', 'تم رفض طلب الاستعارة مع توضيح السبب.');
}

    public function returnBook(Request $request, $id)
{
    $borrow = Borrow::with('libraryBook')->findOrFail($id);

    if ($borrow->status != 'borrowed' && $borrow->status != 'approved') {
        return back()->with('error', 'لا يمكن إرجاع هذا الطلب.');
    }

    $request->validate([
        'actual_return_date' => 'required|date',
        'return_status' => 'required|in:returned,lost',
        'fine_amount' => 'nullable|numeric|min:0',
        'fine_paid' => 'nullable',
        'return_notes' => 'nullable|string|max:1000',

        'loss_compensation_type' => 'nullable|required_if:return_status,lost|in:replacement,pay_five_times,pay_series',
        'loss_compensation_amount' => 'nullable|numeric|min:0',
        'loss_notes' => 'nullable|string|max:1000',
    ]);

    $book = $borrow->libraryBook;

    $lossAmount = 0;

    if ($request->return_status === 'lost') {
        if ($request->loss_compensation_type === 'replacement') {
            $lossAmount = 0;
        } elseif ($request->loss_compensation_type === 'pay_five_times') {
            $lossAmount = ($book->price ?? 0) * 5;
        } elseif ($request->loss_compensation_type === 'pay_series') {
            $lossAmount = ($book->price ?? 0) * ($book->series_parts_count ?? 1);
        }
    }

    $borrow->update([
        'status' => 'returned',
        'return_status' => $request->return_status,
        'return_date' => now()->toDateString(),

        'actual_return_date' => $request->actual_return_date,
        'is_late' => $request->is_late ? true : false,
        'fine_amount' => $request->fine_amount ?? 0,
        'fine_paid' => $request->fine_paid ? true : false,
        'return_notes' => $request->return_notes,

        'loss_compensation_type' => $request->return_status === 'lost'
            ? $request->loss_compensation_type
            : null,

        'loss_compensation_amount' => $request->return_status === 'lost'
            ? $lossAmount
            : 0,

        'loss_notes' => $request->return_status === 'lost'
            ? $request->loss_notes
            : null,
    ]);

    if ($request->return_status === 'returned') {
        $book->increment('available_copies');
    }

    if (
        $request->return_status === 'lost' &&
        $request->loss_compensation_type === 'replacement'
    ) {
        $book->increment('available_copies');
    }

    return redirect()
        ->route('admin.borrows.index')
        ->with('success', 'تم تسجيل حالة الإرجاع بنجاح.');
}
public function returnForm($id)
{
    $borrow = Borrow::with(['user.department', 'libraryBook'])
        ->findOrFail($id);

    if ($borrow->status != 'borrowed' && $borrow->status != 'approved') {
        return redirect()
            ->route('admin.borrows.index')
            ->with('error', 'لا يمكن فتح صفحة الإرجاع لهذا الطلب.');
    }

    return view('admin.borrows.return', compact('borrow'));
}
}