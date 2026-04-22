<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 🔴 مهم جدًا
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()?->role === 'admin') {
            return $next($request);
        }

        abort(403, 'غير مصرح لك بالدخول إلى لوحة الأدمن');
    }
}