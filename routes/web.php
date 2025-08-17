<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    
    // Class Management Routes
    Route::get('/teacher/classes', [TeacherController::class, 'classes'])->name('teacher.classes.index');
    Route::get('/teacher/classes/create', [TeacherController::class, 'createClass'])->name('teacher.classes.create');
    Route::post('/teacher/classes', [TeacherController::class, 'storeClass'])->name('teacher.classes.store');
    
    // Student Management Routes
    Route::get('/teacher/students', [TeacherController::class, 'students'])->name('teacher.students.index');
});


require __DIR__.'/auth.php';
