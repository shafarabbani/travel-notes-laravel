@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 px-8 py-10 text-center relative">
                <a href="/" class="absolute left-6 top-6 p-2 bg-white/10 hover:bg-white/20 text-white rounded-full backdrop-blur-md transition group">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <h1 class="text-2xl font-extrabold text-white">Selamat datang kembali</h1>
                <p class="text-blue-200 text-sm mt-1">Masuk ke Buku Perjalananmu</p>
            </div>

            <form id="login-form" class="px-8 py-8 space-y-5">
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" id="email" required placeholder="contoh@email.com"
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                </div>

                <div id="login-error" class="hidden text-xs text-red-600 font-medium"></div>

                <button type="submit" id="btn-login"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Masuk
                </button>

                <p class="text-center text-sm text-slate-500">
                    Belum punya akun? <a href="/register" class="text-blue-600 font-semibold hover:underline">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const errorEl = document.getElementById('login-error');
        const btn = document.getElementById('btn-login');

        btn.disabled = true;
        btn.textContent = 'Memproses...';
        errorEl.classList.add('hidden');

        try {
            const res = await axios.post('/auth/login', { email, password });
            localStorage.setItem('jwt_token', res.data.access_token);
            localStorage.setItem('user_data', JSON.stringify(res.data.user));
            window.location.href = '/travel-notes';
        } catch (err) {
            errorEl.classList.remove('hidden');
            errorEl.textContent = err.response?.data?.error || 'Email atau kata sandi salah.';
        } finally {
            btn.disabled = false;
            btn.textContent = 'Masuk';
        }
    });
</script>
@endsection
