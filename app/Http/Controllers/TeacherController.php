<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        
        $stats = [
            'total_classes' => $teacher->classes()->count(),
            'total_students' => $teacher->classes()->withCount('students')->get()->sum('students_count'),
            'active_classes' => $teacher->classes()->where('is_active', true)->count(),
        ];
        
        $recentClasses = $teacher->classes()
            ->with(['subject', 'students'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('teacher.dashboard', compact('teacher', 'stats', 'recentClasses'));
    }

    public function classes()
    {
        $teacher = Auth::user();
        $classes = $teacher->classes()
            ->with(['subject', 'students'])
            ->latest()
            ->paginate(10);
        
        return view('teacher.classes.index', compact('classes'));
    }

    public function createClass()
    {
        $subjects = Subject::where('is_active', true)->orderBy('name')->get();
        $gradeLevels = ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 
                       'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10',
                       'Grade 11', 'Grade 12'];
        
        return view('teacher.classes.create', compact('subjects', 'gradeLevels'));
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'grade_level' => 'required|string',
            'max_students' => 'required|integer|min:1|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ]);

        Auth::user()->classes()->create([
            'name' => $request->name,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'grade_level' => $request->grade_level,
            'max_students' => $request->max_students,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'days_of_week' => $request->days_of_week,
        ]);

        return redirect()->route('teacher.classes.index')
            ->with('success', 'Class created successfully!');
    }

    public function students()
    {
        $teacher = Auth::user();
        $students = Student::whereHas('classes', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->with(['user', 'classes' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        }])->paginate(15);
        
        return view('teacher.students.index', compact('students'));
    }
}