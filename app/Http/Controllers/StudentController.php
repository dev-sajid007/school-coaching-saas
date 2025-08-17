<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Exam;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Student::where('user_id', Auth::id())
                         ->with(['classroom', 'attendance', 'results.exam'])
                         ->first();

        if (!$student) {
            return redirect()->route('enrollment.join')
                           ->with('info', 'Please join a class to access your dashboard.');
        }

        $stats = [
            'total_classes' => $student ? 1 : 0,
            'attendance_rate' => $this->calculateAttendanceRate($student),
            'upcoming_exams' => $this->getUpcomingExams($student),
            'latest_results' => $this->getLatestResults($student),
        ];

        return view('student.dashboard', compact('student', 'stats'));
    }

    private function calculateAttendanceRate($student)
    {
        if (!$student) return 0;
        
        $totalDays = $student->attendance()->count();
        $presentDays = $student->attendance()->where('present', true)->count();
        
        return $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;
    }

    private function getUpcomingExams($student)
    {
        if (!$student) return collect();
        
        return Exam::where('classroom_id', $student->classroom_id)
                  ->where('exam_date', '>=', now())
                  ->where('status', 'scheduled')
                  ->orderBy('exam_date')
                  ->take(3)
                  ->get();
    }

    private function getLatestResults($student)
    {
        if (!$student) return collect();
        
        return $student->results()
                      ->with('exam')
                      ->latest()
                      ->take(5)
                      ->get();
    }
}