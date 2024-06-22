<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;

class DashboardsController extends Controller
{
    public function index()
    {
        $user_count = User::count();
        $quiz_count = Quiz::count();
        return view('dashboard', compact('user_count', 'quiz_count'));
    }
}
