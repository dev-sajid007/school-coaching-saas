<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'classroom_id', 'exam_date', 'total_marks', 'pass_marks', 'subject', 'status'
    ];

    protected $dates = ['exam_date'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}