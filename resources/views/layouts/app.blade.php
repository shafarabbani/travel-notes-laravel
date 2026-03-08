<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', 'Buku harian perjalananmu — catat setiap petualangan, suasana hati, dan kenangan.')">
    <title>@yield('title', 'TravelNotes') — TravelNotes</title>

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                    },
                },
            },
        }
    </script>
    {{-- Google Font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .mood-badge-happy        { background:#fef9c3; color:#854d0e; }
        .mood-badge-relaxed      { background:#dcfce7; color:#166534; }
        .mood-badge-excited      { background:#fee2e2; color:#991b1b; }
        .mood-badge-adventurous  { background:#ede9fe; color:#5b21b6; }
        .mood-badge-other        { background:#f3f4f6; color:#374151; }
    </style>
    @stack('styles')
</head>
<body class="min-h-full bg-slate-50 text-slate-800 flex flex-col">

    {{-- ── Navbar ────────────────────────────────── --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Brand --}}
                <a href="{{ route('travel-notes.index') }}" class="flex items-center gap-2 text-brand-600 font-extrabold text-xl tracking-tight">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0"/><path d="M12 2v4m0 12v4M2 12h4m12 0h4"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    TravelNotes
                </a>

                {{-- Nav Links --}}
                <div class="flex items-center gap-4">
                    @auth
                        <span class="hidden sm:inline text-sm text-slate-500">
                            Halo, <span class="font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                        </span>
                        <a href="{{ route('travel-notes.create') }}"
                           class="inline-flex items-center gap-1.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-150 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Catatan Baru
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="text-sm text-slate-500 hover:text-red-600 font-medium transition-colors duration-150 px-2 py-1 rounded hover:bg-red-50">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors duration-150">Masuk</a>
                        <a href="{{ route('register') }}"
                           class="inline-flex bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-150 shadow-sm">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ── Pesan Flash ─────────────────────────── --}}
    @if(session('success'))
        <div id="flash-success"
             class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm font-medium shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- ── Konten Utama ────────────────────────────── --}}
    <main class="flex-1">
        @yield('content')
    </main>

    <script>
        // Sembunyikan pesan flash otomatis setelah 4 detik
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
