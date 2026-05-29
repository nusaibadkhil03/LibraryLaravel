<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('student_number', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->get();

        $activities = AdminActivity::with('admin')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.admins.index', compact('users', 'activities'));
    }

    public function updateRole($id, $role)
    {
        if (! in_array($role, ['admin', 'student'])) {
            abort(404);
        }

        $user = User::findOrFail($id);

        if ($user->id === Auth::id() && $role === 'student') {
            return back()->with('error', 'لا يمكنك إزالة صلاحية الأدمن من حسابك الحالي');
        }

        $user->update([
            'role' => $role,
        ]);

        AdminActivity::create([
            'admin_id' => Auth::id(),
            'action' => 'تغيير صلاحية مستخدم',
            'description' => 'تم تغيير صلاحية ' . $user->name . ' إلى ' . $role,
            'type' => 'user_role',
        ]);

        return back()->with('success', 'تم تحديث صلاحية المستخدم بنجاح');
    }
}