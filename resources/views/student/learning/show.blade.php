<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Ruang Belajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Daftar Materi -->
        <div class="w-80 bg-white border-r flex flex-col">
            <div class="p-4 border-b bg-gray-50">
                <h2 class="font-bold text-lg text-gray-800">{{ $course->title }}</h2>
                <p class="text-xs text-gray-500">Materi Pembelajaran</p>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-4">
                @foreach($course->modules as $module)
                    <div>
                        <h3 class="font-semibold text-sm text-gray-600 mb-2">{{ $module->title }}</h3>
                        <div class="space-y-1">
                            @foreach($module->lessons as $les)
                                <a href="{{ route('learning.show', [$course->slug, $les->id]) }}" 
                                   class="block text-sm p-2 rounded-lg transition {{ isset($lesson) && $lesson->id == $les->id ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                   📖 {{ $les->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Konten Utama Materi -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white border-b px-8 py-4 flex justify-between items-center shadow-sm">
                <h1 class="text-xl font-bold text-gray-800">{{ $lesson->title ?? 'Pilih Materi' }}</h1>
                <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 hover:text-blue-600">← Kembali ke Beranda</a>
            </header>

            <main class="p-8 max-w-4xl">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(isset($lesson))
                    <div class="bg-white rounded-xl shadow-sm border p-6 space-y-6">
                        @if($lesson->video_url)
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-lg overflow-hidden">
                                <iframe src="{{ $lesson->video_url }}" class="w-full h-96" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif

                        <div class="prose max-w-none text-gray-700">
                            {!! $lesson->content ?? 'Belum ada deskripsi teks untuk materi ini.' !!}
                        </div>

                        <div class="pt-4 border-t flex justify-end">
                            <form action="{{ route('learning.lesson.complete', $lesson->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-lg transition shadow">
                                    Tandai Selesai & Lanjut ✅
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Silakan pilih materi di sebelah kiri untuk mulai belajar.</p>
                @endif
            </main>
        </div>
    </div>
</body>
</html>