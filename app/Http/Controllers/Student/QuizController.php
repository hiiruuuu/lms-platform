<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function submit(Request $request, Quiz $quiz)
    {
        $answers = $request->input('answers', []);
        $questions = $quiz->questions;
        $score = 0;
        $total = count($questions);

        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct_answer) {
                $score++;
            }
        }

        $finalScore = ($total > 0) ? ($score / $total) * 100 : 0;

        return back()->with('success', "Kuis selesai! Skor Anda: {$finalScore} / 100");
    }
}
