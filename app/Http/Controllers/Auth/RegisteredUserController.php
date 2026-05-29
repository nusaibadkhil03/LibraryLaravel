<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('auth.register', compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'student_number' => [
                'required',
                'string',
                'max:50',
                'unique:users,student_number',
            ],

            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
            'phone' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'اسم الطالب مطلوب.',
            'student_number.required' => 'رقم القيد مطلوب.',
            'student_number.unique' => 'رقم القيد مستخدم مسبقًا.',
            'department_id.required' => 'يرجى اختيار القسم.',
            'department_id.exists' => 'القسم المختار غير صحيح.',
            'email.required' => 'البريد الجامعي مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقًا.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}