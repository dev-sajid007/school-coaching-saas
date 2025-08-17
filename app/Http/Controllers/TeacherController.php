<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        
        // Basic dashboard data - expand as you build more features
        $stats = [
            'total_classes' => 0, // Will be populated when you add classes
            'total_students' => 0,
            'upcoming_sessions' => 0,
        ];
        
        return view('teacher.dashboard', compact('teacher', 'stats'));
    }
}