@extends('layouts.app')

@section('title', 'Buat Akun')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-br from-violet-600 to-blue-700 px-8 py-8 text-center text-white">
                <h1 class="text-2xl font-extrabold">Buat akun baru</h1>
                <p class="text-violet-200 text-sm mt-1">Mulai buku harianmu hari ini</p>
            </div>

            <form id="register-form" class="px-8 py-8 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" required placeholder="Nama lengkapmu"
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                    <div id="error-name" class="hidden text-xs text-red-600 font-medium"></div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" id="email" required placeholder="contoh@email.com"
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                    <div id="error-email" class="hidden text-xs text-red-600 font-medium"></div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                    <div id="error-password" class="hidden text-xs text-red-600 font-medium"></div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                </div>

                <div id="general-error" class="hidden text-xs text-red-600 font-medium"></div>

                <button type="submit" id="btn-register"
                        class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Buat Akun
                </button>

                <p class="text-center text-sm text-slate-500">
                    Sudah punya akun? <a href="/login" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value
        };

        const btn = document.getElementById('btn-register');
        const errors = ['name', 'email', 'password'];
        errors.forEach(id => document.getElementById(`error-${id}`).classList.add('hidden'));
        document.getElementById('general-error').classList.add('hidden');

        btn.disabled = true;
        btn.textContent = 'Mendaftar...';

        try {
            const res = await axios.post('/auth/register', data);
            localStorage.setItem('jwt_token', res.data.access_token);
            localStorage.setItem('user_data', JSON.stringify(res.data.user));
            window.location.href = '/travel-notes';
        } catch (err) {
            if (err.response?.status === 400) {
                const validationErrors = err.response.data;
                Object.keys(validationErrors).forEach(key => {
                    const el = document.getElementById(`error-${key}`);
                    if (el) { el.classList.remove('hidden'); el.textContent = validationErrors[key][0]; }
                });
            } else {
                document.getElementById('general-error').classList.remove('hidden');
                document.getElementById('general-error').textContent = 'Terjadi kesalahan sistem.';
            }
        } finally {
            btn.disabled = false;
            btn.textContent = 'Buat Akun';
        }
    });
</script>
@endsection
