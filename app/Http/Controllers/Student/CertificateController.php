<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function generate(Course $course)
    {
        // Cek apakah sertifikat sudah pernah dibuat
        $certificate = Certificate::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $course->id,
            ],
            [
                'certificate_code' => 'CERT-' . strtoupper(Str::random(10)),
            ]
        );

        $pdf = Pdf::loadView('student.certificate.pdf', compact('course', 'certificate'));
        
        return $pdf->download("Sertifikat-{$course->slug}.pdf");
    }
}
