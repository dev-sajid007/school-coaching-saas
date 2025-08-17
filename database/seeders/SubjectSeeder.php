<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Basic and advanced mathematics', 'color_code' => '#3B82F6'],
            ['name' => 'English', 'code' => 'ENG', 'description' => 'English language and literature', 'color_code' => '#10B981'],
            ['name' => 'Science', 'code' => 'SCI', 'description' => 'General science and physics', 'color_code' => '#8B5CF6'],
            ['name' => 'Computer Science', 'code' => 'CS', 'description' => 'Programming and computer skills', 'color_code' => '#F59E0B'],
            ['name' => 'History', 'code' => 'HIST', 'description' => 'World and local history', 'color_code' => '#EF4444'],
            ['name' => 'Biology', 'code' => 'BIO', 'description' => 'Life sciences and biology', 'color_code' => '#06B6D4'],
            ['name' => 'Chemistry', 'code' => 'CHEM', 'description' => 'Chemical sciences', 'color_code' => '#84CC16'],
            ['name' => 'Physics', 'code' => 'PHY', 'description' => 'Physical sciences', 'color_code' => '#F97316'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}