<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Buku Perjalanan') — Catatan Perjalanan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Konfigurasi Dasar Axios
        axios.defaults.baseURL = '/api';
        const token = localStorage.getItem('jwt_token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        }

        // Interceptor untuk menangani error 401 (Unauthenticated)
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('user_data');
                    if (!window.location.pathname.includes('/login') && !window.location.pathname.includes('/register')) {
                        window.location.href = '/login';
                    }
                }
                return Promise.reject(error);
            }
        );
    </script>
    <style>
        .mood-badge-happy        { background:#fef9c3; color:#854d0e; }
        .mood-badge-relaxed      { background:#dcfce7; color:#166534; }
        .mood-badge-excited      { background:#fee2e2; color:#991b1b; }
        .mood-badge-adventurous  { background:#ede9fe; color:#5b21b6; }
        .mood-badge-other        { background:#f3f4f6; color:#374151; }
    </style>
</head>
<body class="min-h-full bg-slate-50 text-slate-800 flex flex-col">

    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2 text-brand-600 font-extrabold text-xl tracking-tight">
                    Buku Perjalanan
                </a>

                <div id="auth-nav" class="flex items-center gap-4">
                    <!-- Konten Navigasi akan diisi via JS -->
                </div>
            </div>
        </div>
    </nav>

    <div id="alert-container" class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4 hidden">
        <div id="alert-message" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium shadow-sm"></div>
    </div>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Buku Perjalanan (API Powered)</p>
        </div>
    </footer>

    <script>
        function updateNav() {
            const authNav = document.getElementById('auth-nav');
            const token = localStorage.getItem('jwt_token');
            const userStr = localStorage.getItem('user_data');
            const user = userStr ? JSON.parse(userStr) : null;

            if (token && user) {
                authNav.innerHTML = `
                    <span class="hidden sm:inline text-sm text-slate-500">Halo, <span class="font-semibold text-slate-700">${user.name}</span></span>
                    <a href="/travel-notes/create" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">Catatan Baru</a>
                    <button onclick="logout()" class="text-sm text-slate-500 hover:text-red-600 font-medium px-2 py-1">Keluar</button>
                `;
            } else {
                authNav.innerHTML = `
                    <a href="/login" class="text-sm font-medium text-slate-600 hover:text-blue-600">Masuk</a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">Daftar</a>
                `;
            }
        }

        function showAlert(message, type = 'success') {
            const container = document.getElementById('alert-container');
            const msgEl = document.getElementById('alert-message');
            
            container.classList.remove('hidden');
            msgEl.textContent = message;
            
            if (type === 'success') {
                msgEl.className = "flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm font-medium shadow-sm";
            } else {
                msgEl.className = "flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium shadow-sm";
            }

            setTimeout(() => container.classList.add('hidden'), 4000);
        }

        async function logout() {
            try {
                await axios.post('/auth/logout');
            } catch (e) {} finally {
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user_data');
                window.location.href = '/login';
            }
        }

        updateNav();
    </script>
</body>
</html>
