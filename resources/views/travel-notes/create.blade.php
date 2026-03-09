@extends('layouts.app')

@section('title', 'Tambah Catatan Perjalanan')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="/travel-notes" class="hover:text-blue-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <span class="text-slate-600 font-medium">Catatan Baru</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-violet-600 px-8 py-6">
            <h1 class="text-2xl font-extrabold text-white">Tambah Catatan Perjalanan</h1>
            <p class="text-blue-200 text-sm mt-1">Dokumentasikan perjalananmu secara lengkap</p>
        </div>

        <form id="create-note-form" class="px-8 py-8 space-y-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" required placeholder="contoh: Matahari Terbit di Gunung Bromo"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <div id="error-title" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" required placeholder="contoh: Probolinggo"
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <div id="error-location" class="hidden text-xs text-red-600 mt-1"></div>
                </div>
                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-1.5">Negara <span class="text-red-500">*</span></label>
                    <input type="text" id="country" name="country" required placeholder="contoh: Indonesia"
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <div id="error-country" class="hidden text-xs text-red-600 mt-1"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="date" name="date" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                    <div id="error-date" class="hidden text-xs text-red-600 mt-1"></div>
                </div>
                <div>
                    <label for="mood" class="block text-sm font-semibold text-slate-700 mb-1.5">Suasana Hati <span class="text-red-500">*</span></label>
                    <select id="mood" name="mood" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                        <option value="" disabled selected>Pilih suasana hati...</option>
                        <option value="happy">Senang</option>
                        <option value="relaxed">Santai</option>
                        <option value="excited">Bersemangat</option>
                        <option value="adventurous">Petualang</option>
                        <option value="other">Lainnya</option>
                    </select>
                    <div id="error-mood" class="hidden text-xs text-red-600 mt-1"></div>
                </div>
            </div>

            <div>
                <label for="experience" class="block text-sm font-semibold text-slate-700 mb-1.5">Cerita Perjalanan <span class="text-red-500">*</span></label>
                <textarea id="experience" name="experience" rows="5" required placeholder="Ceritakan pengalamanmu..."
                          class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm resize-y"></textarea>
                <div id="error-experience" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div>
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1.5">Foto <span class="text-slate-400 font-normal">(opsional)</span></label>
                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm file:mr-3 file:bg-blue-50 file:text-blue-700 file:border-0 file:py-1 file:px-3 file:rounded-lg">
                <div id="error-photo" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" id="btn-submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Simpan Catatan
                </button>
                <a href="/travel-notes"
                   class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    if (!localStorage.getItem('jwt_token')) {
        window.location.href = '/login';
    }

    document.getElementById('create-note-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-submit');
        const formData = new FormData(e.target);
        const errorIds = ['title', 'location', 'country', 'date', 'mood', 'experience', 'photo'];
        errorIds.forEach(id => document.getElementById(`error-${id}`).classList.add('hidden'));

        btn.disabled = true;
        btn.textContent = 'Menyimpan...';

        try {
            const res = await axios.post('/travel-notes', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            showAlert(res.data.message);
            window.location.href = '/travel-notes';
        } catch (err) {
            if (err.response?.status === 422) {
                const validationErrors = err.response.data;
                Object.keys(validationErrors).forEach(key => {
                    const el = document.getElementById(`error-${key}`);
                    if (el) { el.classList.remove('hidden'); el.textContent = validationErrors[key][0]; }
                });
            } else {
                showAlert('Gagal menyimpan catatan.', 'error');
            }
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan Catatan';
        }
    });
</script>
@endsection
