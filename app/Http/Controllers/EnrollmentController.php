<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function joinClass()
    {
        return view('enrollment.join-class');
    }

    public function processJoin(Request $request)
    {
        $request->validate([
            'class_code' => 'required|exists:classrooms,class_code',
            'roll_number' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email',
            'address' => 'nullable|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
        ]);

        $classroom = Classroom::where('class_code', $request->class_code)
                             ->where('is_active', true)
                             ->first();

        if (!$classroom) {
            return back()->withErrors(['class_code' => 'Invalid or inactive class code.']);
        }

        // Check if user is already enrolled
        if (Student::where('user_id', Auth::id())
                  ->where('classroom_id', $classroom->id)
                  ->exists()) {
            return back()->withErrors(['class_code' => 'You are already enrolled in this class.']);
        }

        // Create student record
        Student::create([
            'user_id' => Auth::id(),
            'classroom_id' => $classroom->id,
            'roll_number' => $request->roll_number,
            'phone' => $request->phone,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'guardian_email' => $request->guardian_email,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);

        return redirect()->route('student.dashboard')
                        ->with('success', "Successfully joined {$classroom->name}!");
    }
}