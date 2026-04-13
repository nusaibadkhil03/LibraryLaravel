<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function profile()
    {
        return view('student.profile');
    }
}