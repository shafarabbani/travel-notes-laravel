<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Perjalanan — Simpan Kenangan Petualanganmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); }
        .hero-gradient { background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-transparent">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                </div>
                <span class="text-xl font-extrabold tracking-tight">Buku Perjalanan</span>
            </div>
            
            <div class="hidden md:flex items-center gap-8 font-medium text-slate-600">
                <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
                <a href="#cerita" class="hover:text-blue-600 transition">Cerita</a>
                <a href="#faq" class="hover:text-blue-600 transition">FAQ</a>
            </div>

            <div id="auth-actions" class="flex items-center gap-4">
                <!-- Diisi via JS -->
                <div class="w-24 h-8 bg-slate-200 animate-pulse rounded-lg"></div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-46 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative z-10 space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    Jurnal Perjalanan Digital #1
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight text-slate-900">
                    Abadikan Setiap <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Detik Berharga</span> Perjalananmu.
                </h1>
                <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                    Lebih dari sekadar buku harian. Simpan foto, lokasi, suasana hati, dan cerita petualanganmu di mana pun kamu berada. Semudah satu sentuhan.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="/register" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:shadow-blue-300 transition-all transform hover:-translate-y-1">
                        Mulai Gratis Sekarang
                    </a>
                    <a href="#fitur" class="px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-2xl border border-slate-200 transition-all flex items-center gap-2">
                        Lihat Fitur <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex -space-x-3">
                        <img src="https://i.pravatar.cc/150?u=1" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="U1">
                        <img src="https://i.pravatar.cc/150?u=2" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="U2">
                        <img src="https://i.pravatar.cc/150?u=3" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="U3">
                    </div>
                    <div class="text-sm">
                        <p class="font-bold text-slate-800">10,000+ Penjelajah</p>
                        <p class="text-slate-500">Telah bergabung bersama kami.</p>
                    </div>
                </div>
            </div>

            <div class="relative lg:block">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>
                <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&q=80&w=1200" 
                     class="relative z-10 w-full h-auto rounded-[2.5rem] shadow-2xl border-4 border-white transform rotate-2 hover:rotate-0 transition-all duration-700" 
                     alt="Travel App Interface">
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-24 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center space-y-4 mb-16">
                <h2 class="text-blue-600 font-bold uppercase tracking-widest text-sm">Kemudahan Menghampirimu</h2>
                <h3 class="text-4xl font-extrabold text-slate-900">Fitur Cerdas untuk Jurnal Perjalanan</h3>
                <p class="text-slate-500 max-w-2xl mx-auto">Kami merancang setiap detail untuk memastikan pengalaman mendokumentasikan memori berjalan mulus.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-slate-100 group">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="camera" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Abadikan Foto</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Simpan foto kenangan langsung di setiap catatan perjalananmu dengan satu klik.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-slate-100 group">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="map" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Tanda Lokasi</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Catat ke mana pun langkahmu pergi dari lokasi domestik hingga mancanegara.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-slate-100 group">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="heart" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Mood Tracker</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Ekspresikan perasaanmu — senang, santai, atau bersemangat di setiap petualangan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cerita Section -->
    <section id="cerita" class="py-24 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=800" 
                         class="rounded-[2.5rem] shadow-2xl relative z-10 border-8 border-white" alt="Cerita Petualangan">
                </div>
                <div class="flex-1 space-y-8">
                    <div class="w-12 h-1 bg-blue-600 rounded-full"></div>
                    <h3 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight">Cerita yang Tak Akan Pernah Terlupakan.</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Setiap perjalanan memiliki kisahnya sendiri. Dengan Buku Perjalanan, Anda dapat menyusun kronologi petualangan Anda secara indah, lengkap dengan detail emosional yang sering terlupakan seiring berjalannya waktu.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </div>
                            <span class="text-slate-700 font-semibold">Sinkronisasi Cloud</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </div>
                            <span class="text-slate-700 font-semibold">Berbagi Cerita</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </div>
                            <span class="text-slate-700 font-semibold">Akses Selamanya</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </div>
                            <span class="text-slate-700 font-semibold">Enkripsi Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-extrabold text-slate-900">Pertanyaan Populer</h3>
                <p class="text-slate-500 mt-4">Punya pertanyaan? Kami punya jawabannya.</p>
            </div>
            <div class="grid gap-4">
                <details class="group border border-slate-100 rounded-2xl bg-slate-50 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer transition-all hover:border-blue-200">
                    <summary class="flex items-center justify-between gap-4 font-bold text-slate-900">
                        <span>Apakah aplikasi ini benar-benar gratis?</span>
                        <i data-lucide="plus" class="w-5 h-5 text-slate-400 group-open:rotate-45 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-slate-500 text-sm leading-relaxed">Ya! Fitur dasar untuk mencatat perjalanan, menyimpan lokasi, dan menambahkan foto tersedia secara gratis untuk semua penjelajah.</p>
                </details>

                <details class="group border border-slate-100 rounded-2xl bg-slate-50 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer transition-all hover:border-blue-200">
                    <summary class="flex items-center justify-between gap-4 font-bold text-slate-900">
                        <span>Berapa banyak foto yang bisa saya simpan?</span>
                        <i data-lucide="plus" class="w-5 h-5 text-slate-400 group-open:rotate-45 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-slate-500 text-sm leading-relaxed">Anda dapat menyimpan foto di setiap catatan perjalanan Anda tanpa batasan kuota untuk saat ini. Nikmati penyimpanan kenangan tak terbatas!</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 relative overflow-hidden bg-slate-900 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center justify-between gap-12 text-center md:text-left">
            <div>
                <h3 class="text-4xl font-extrabold mb-2">Angka yang Berbicara</h3>
                <p class="text-slate-400">Bergabunglah dengan komunitas global kami.</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-24">
                <div>
                    <span class="text-4xl font-black text-blue-400">150+</span>
                    <p class="text-sm text-slate-400 mt-1 uppercase tracking-widest font-bold">Negara</p>
                </div>
                <div>
                    <span class="text-4xl font-black text-blue-400">50K+</span>
                    <p class="text-sm text-slate-400 mt-1 uppercase tracking-widest font-bold">Catatan</p>
                </div>
                <div>
                    <span class="text-4xl font-black text-blue-400">24/7</span>
                    <p class="text-sm text-slate-400 mt-1 uppercase tracking-widest font-bold">Akses</p>
                </div>
                <div>
                    <span class="text-4xl font-black text-blue-400">4.9/5</span>
                    <p class="text-sm text-slate-400 mt-1 uppercase tracking-widest font-bold">Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[3rem] p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl shadow-blue-200">
            <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            <div class="relative z-10 space-y-8">
                <h3 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">Siap Untuk Mendokumentasikan <br> Perjalanan Selanjutnya?</h3>
                <p class="text-blue-100 text-lg max-w-xl mx-auto">Daftar sekarang dan klaim buku harian digital pertamamu secara gratis, selamanya.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="px-10 py-5 bg-white text-blue-600 font-extrabold rounded-2xl shadow-xl hover:scale-105 transition transform">
                        Daftar Gratis Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center space-y-6">
            <div class="flex items-center justify-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                </div>
                <span class="text-lg font-extrabold">Buku Perjalanan</span>
            </div>
            <p class="text-slate-400 text-sm">Hak Cipta © {{ date('Y') }} Buku Perjalanan. Semua kenangan dilindungi secara digital.</p>
            <div class="flex justify-center gap-6 text-slate-400">
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="twitter" class="w-5 h-5"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glass', 'shadow-sm', 'border-slate-200');
                nav.classList.remove('h-20');
                nav.classList.add('h-16');
            } else {
                nav.classList.remove('glass', 'shadow-sm', 'border-slate-200');
                nav.classList.remove('h-16');
                nav.classList.add('h-20');
            }
        });

        // Dynamic Auth Navigation
        function updateAuthNav() {
            const container = document.getElementById('auth-actions');
            const token = localStorage.getItem('jwt_token');
            const userStr = localStorage.getItem('user_data');

            if (token && userStr) {
                const user = JSON.parse(userStr);
                container.innerHTML = `
                    <a href="/travel-notes" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition">
                        Buka Dashboard
                    </a>
                    <button onclick="logoutLanding()" class="text-sm font-bold text-slate-500 hover:text-red-500 transition">Keluar</button>
                `;
            } else {
                container.innerHTML = `
                    <a href="/login" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Masuk</a>
                    <a href="/register" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition">Daftar</a>
                `;
            }
        }

        function logoutLanding() {
            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user_data');
            window.location.reload();
        }

        // Call on load
        updateAuthNav();
    </script>
</body>
</html>
