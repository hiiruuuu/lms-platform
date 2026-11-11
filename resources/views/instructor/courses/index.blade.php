<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Instruktur - LMS Platform</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-6xl mx-auto p-6">
        <header class="flex justify-between items-center mb-8 border-b pb-4">
            <h1 class="text-2xl font-bold text-blue-600">🎓 Dashboard Instruktur</h1>
            <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">Instruktur</span>
        </header>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Tambah Kursus -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Buat Kursus Baru</h2>
                <form action="{{ route('instructor.courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Judul Kursus</label>
                        <input type="text" name="title" required class="w-full border-gray-300 rounded-lg border px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4" required class="w-full border-gray-300 rounded-lg border px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">Simpan Kursus</button>
                </form>
            </div>

            <!-- Daftar Kursus Milik Instruktur -->
            <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Kursus Anda</h2>
                @forelse($courses as $course)
                    <div class="border border-gray-200 rounded-lg p-4 mb-4 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">{{ $course->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-1">{{ $course->description }}</p>
                            <span class="inline-block mt-2 text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded uppercase font-semibold">{{ $course->status }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Belum ada kursus yang dibuat.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>