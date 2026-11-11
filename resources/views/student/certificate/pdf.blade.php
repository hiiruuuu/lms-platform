<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kelulusan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; text-align: center; color: #333; }
        .certificate-box { border: 20px solid #2563eb; padding: 40px; width: 800px; margin: auto; }
        h1 { font-size: 40px; color: #1e3a8a; margin-bottom: 10px; }
        h3 { font-size: 24px; color: #475569; }
        p { font-size: 16px; line-height: 1.5; }
        .code { font-size: 14px; color: #64748b; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="certificate-box">
        <h1>Sertifikat Kelulusan</h1>
        <h3>Diberikan Kepada:</h3>
        <h2><strong>{{ Auth::user()->name }}</strong></h2>
        <p>Atas keberhasilannya menyelesaikan kursus:</p>
        <h2>{{ $course->title }}</h2>
        <p class="code">Kode Sertifikat: {{ $certificate->certificate_code }}</p>
    </div>
</body>
</html>