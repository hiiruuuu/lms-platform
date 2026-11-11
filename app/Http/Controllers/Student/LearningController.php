<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseProgress;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    // Menampilkan halaman belajar untuk suatu kursus
    public function show(Course $course, Lesson $lesson = null)
    {
        // Pastikan siswa terdaftar (enroll) di kursus ini
        $isEnrolled = $course->enrollments()->where('user_id', Auth::id())->exists();
        if (!$isEnrolled) {
            return redirect()->route('courses.index')->with('error', 'Anda belum terdaftar di kursus ini.');
        }

        $course->load('modules.lessons');

        // Jika lesson tidak dipilih, ambil lesson pertama dari kursus
        if (!$lesson && $course->modules->isNotEmpty() && $course->modules->first()->lessons->isNotEmpty()) {
            $lesson = $course->modules->first()->lessons->first();
        }

        return view('student.learning.show', compact('course', 'lesson'));
    }

    // Menandai materi/lesson selesai
    public function completeLesson(Lesson $lesson)
    {
        CourseProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $lesson->id,
            ],
            [
                'is_completed' => true
            ]
        );

        return redirect()->back()->with('success', 'Progres materi disimpan!');
    }
}