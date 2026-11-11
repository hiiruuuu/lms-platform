<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Menampilkan daftar kursus milik instruktur yang sedang login
    public function index()
    {
        $courses = Course::where('instructor_id', Auth::id())->with('modules')->get();
        return view('instructor.courses.index', compact('courses'));
    }

    // Menyimpan kursus baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Course::create([
            'instructor_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Kursus berhasil dibuat!');
    }
}
