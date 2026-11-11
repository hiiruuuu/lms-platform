<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\Student\LearningController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Instruktur
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/courses', [InstructorCourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [InstructorCourseController::class, 'store'])->name('courses.store');
});

// Rute untuk Siswa / Belajar
Route::middleware(['auth', 'role:student'])->prefix('learning')->name('learning.')->group(function () {
    Route::get('/course/{course:slug}/{lesson?}', [LearningController::class, 'show'])->name('show');
    Route::post('/lesson/{lesson}/complete', [LearningController::class, 'completeLesson'])->name('lesson.complete');
});