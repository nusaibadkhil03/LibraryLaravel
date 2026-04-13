<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); 
});

Route::get('/login', function () {
    return view('auth.login'); // تأكدي أن اسم الملف في views هو login.blade.php
})->name('login');

Route::get('/signup', function () {
    return view('auth.signup');
});


Route::get('/departments/{dept}', function ($dept) {

    $departments = [
        'cs' => ['name' => 'الحاسب الالي', 'icon' => '💻'],
        'accounting' => ['name' => 'المحاسبة', 'icon' => '💰'],
        'law' => ['name' => 'القانون', 'icon' => '⚖️'],
        'business' => ['name' => 'إدارة الأعمال', 'icon' => '📊'],
        'petroleum' => ['name' => 'هندسة النفط', 'icon' => '🛢️'],
        'arch' => ['name' => 'الهندسة المعمارية', 'icon' => '🏛️'],
    ];

    if (!isset($departments[$dept])) {
        abort(404);
    }

    return view('departments.show', [
        'dept' => $dept,
        'data' => $departments[$dept]
    ]);
});

Route::get('/borrow', function () {
    return view('borrow');
});

Route::get('/curriculum', function () {
    return view('curriculum');
})->name('curriculum');