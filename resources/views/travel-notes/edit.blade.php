@extends('layouts.app')

@section('title', 'Ubah Catatan')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="/travel-notes" class="hover:text-blue-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <a id="breadcrumb-note" href="" class="hover:text-blue-600 transition-colors line-clamp-1 max-w-[180px]">Catatan</a>
        <span>/</span>
        <span class="text-slate-600 font-medium">Ubah</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-8 py-6 text-white font-extrabold text-2xl">
            Ubah Catatan Perjalanan
            <p class="text-amber-100 text-sm mt-1 font-normal tracking-normal">Perbarui detail perjalananmu</p>
        </div>

        <form id="edit-note-form" class="px-8 py-8 space-y-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                <div id="error-title" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                    <div id="error-location" class="hidden text-xs text-red-600 mt-1"></div>
                </div>
                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-1.5">Negara <span class="text-red-500">*</span></label>
                    <input type="text" id="country" name="country" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
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
                <textarea id="experience" name="experience" rows="5" required
                          class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm resize-y"></textarea>
                <div id="error-experience" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div>
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1.5">Foto</label>
                <div id="current-photo" class="hidden mb-3 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <img id="photo-img" src="" class="w-16 h-12 object-cover rounded-lg">
                    <span class="text-xs text-slate-500">Unggah foto baru untuk menggantinya</span>
                </div>
                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm">
                <div id="error-photo" class="hidden text-xs text-red-600 mt-1"></div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" id="btn-submit"
                        class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Perbarui Catatan
                </button>
                <a id="cancel-link" href=""
                   class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const noteId = "{{ $id }}";
    if (!localStorage.getItem('jwt_token')) window.location.href = '/login';

    async function loadData() {
        try {
            const res = await axios.get(`/travel-notes/${noteId}`);
            const note = res.data;
            const currentUser = JSON.parse(localStorage.getItem('user_data'));
            
            if (currentUser.id !== note.user_id) {
                showAlert('Akses ditolak.', 'error');
                window.location.href = '/travel-notes';
                return;
            }

            document.getElementById('breadcrumb-note').href = `/travel-notes/${noteId}`;
            document.getElementById('breadcrumb-note').textContent = note.title;
            document.getElementById('cancel-link').href = `/travel-notes/${noteId}`;
            
            document.getElementById('title').value = note.title;
            document.getElementById('location').value = note.location;
            document.getElementById('country').value = note.country;
            document.getElementById('date').value = note.date.split('T')[0];
            document.getElementById('mood').value = note.mood;
            document.getElementById('experience').value = note.experience;

            if (note.photo) {
                document.getElementById('current-photo').classList.remove('hidden');
                document.getElementById('photo-img').src = `/storage/${note.photo}`;
            }

        } catch (err) {
            showAlert('Gagal memuat data.', 'error');
        }
    }

    document.getElementById('edit-note-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-submit');
        const formData = new FormData(e.target);
        // axios put + multipart doesn't work well with PHP, use POST + spoof method
        formData.append('_method', 'PUT');

        btn.disabled = true;
        btn.textContent = 'Memperbarui...';

        try {
            const res = await axios.post(`/travel-notes/${noteId}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            showAlert(res.data.message);
            window.location.href = `/travel-notes/${noteId}`;
        } catch (err) {
            if (err.response?.status === 422) {
                const validationErrors = err.response.data;
                Object.keys(validationErrors).forEach(key => {
                    const el = document.getElementById(`error-${key}`);
                    if (el) { el.classList.remove('hidden'); el.textContent = validationErrors[key][0]; }
                });
            } else {
                showAlert('Gagal memperbarui catatan.', 'error');
            }
        } finally {
            btn.disabled = false;
            btn.textContent = 'Perbarui Catatan';
        }
    });

    loadData();
</script>
@endsection
