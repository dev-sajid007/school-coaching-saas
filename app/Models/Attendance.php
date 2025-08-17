<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'classroom_id', 'date', 'present', 'remarks', 'marked_by'
    ];

    protected $dates = ['date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function marker()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}