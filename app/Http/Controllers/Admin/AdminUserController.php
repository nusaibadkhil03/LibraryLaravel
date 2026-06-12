<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $admins = User::where('role', 'admin')
            ->latest()
            ->get();

        $searchResults = collect();

        if ($request->filled('search')) {
            $searchResults = User::where('role', '!=', 'admin')
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%')
                      ->orWhere('student_number', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->get();
        }

        $activities = AdminActivity::with('admin')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.admins.index', compact(
            'admins',
            'searchResults',
            'activities'
        ));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,student,staff',
            'student_number' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'student_number' => $request->student_number,
            'phone' => $request->phone,
            'email_verified_at' => now(),
        ]);

        AdminActivity::create([
            'admin_id' => Auth::id(),
            'action' => 'إضافة مستخدم',
            'description' => 'تم إنشاء حساب جديد للمستخدم: ' . $user->name,
            'type' => 'user_create',
        ]);

        return redirect()
            ->route('admin.admins.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح');
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

        $oldRole = $user->role;

        if ($oldRole === $role) {
            return back()->with('success', 'المستخدم لديه هذه الصلاحية بالفعل');
        }

        $user->update([
            'role' => $role,
        ]);

        AdminActivity::create([
            'admin_id' => Auth::id(),
            'action' => 'تغيير صلاحية مستخدم',
            'description' => 'تم تغيير صلاحية ' . $user->name . ' من ' . $oldRole . ' إلى ' . $role,
            'type' => 'user_role',
        ]);

        return back()->with('success', 'تم تحديث صلاحية المستخدم بنجاح');
    }
}