@extends('layouts.app')

@section('title', 'Semua Catatan Perjalanan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Catatan Perjalanan</h1>
            <p id="total-notes" class="text-slate-500 mt-1 text-sm">Memuat data...</p>
        </div>
        <div id="add-btn-container" class="hidden">
            <a href="/travel-notes/create" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-sm transition text-sm">
                Tambah Catatan
            </a>
        </div>
    </div>

    <div id="notes-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Render melalui JS -->
    </div>

    <div id="empty-state" class="hidden flex flex-col items-center justify-center py-24 text-center">
        <h2 class="text-xl font-bold text-slate-700">Belum ada catatan perjalanan</h2>
        <p class="text-slate-400 mt-2 text-sm max-w-xs">Jadilah yang pertama berbagi perjalanan!</p>
    </div>
</div>

<script>
    const moodLabels = {
        'happy': 'Senang',
        'relaxed': 'Santai',
        'excited': 'Bersemangat',
        'adventurous': 'Petualang',
        'other': 'Lainnya'
    };

    async function loadNotes() {
        try {
            const res = await axios.get('/travel-notes');
            const notes = res.data.data;
            const grid = document.getElementById('notes-grid');
            const empty = document.getElementById('empty-state');
            const total = document.getElementById('total-notes');
            
            total.textContent = `${res.data.total} perjalanan tercatat`;
            
            if (localStorage.getItem('jwt_token')) {
                document.getElementById('add-btn-container').classList.remove('hidden');
            }

            if (notes.length === 0) {
                empty.classList.remove('hidden');
                return;
            }

            grid.innerHTML = notes.map(note => `
                <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 overflow-hidden flex flex-col transition-all duration-300">
                    <a href="/travel-notes/${note.id}" class="block overflow-hidden h-48 bg-slate-100 relative">
                        ${note.photo 
                            ? `<img src="/storage/${note.photo}" class="w-full h-full object-cover">` 
                            : `<div class="w-full h-full flex items-center justify-center"><span class="text-slate-300">Tanpa Foto</span></div>`
                        }
                        <span class="absolute top-3 right-3 mood-badge-${note.mood} text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                            ${moodLabels[note.mood] || note.mood}
                        </span>
                    </a>
                    <div class="flex flex-col flex-1 p-5">
                        <a href="/travel-notes/${note.id}" class="font-bold text-slate-800 hover:text-blue-600 line-clamp-2">${note.title}</a>
                        <p class="text-xs text-slate-400 mt-1">${note.location}, ${note.country}</p>
                        <p class="text-sm text-slate-500 mt-3 line-clamp-3">${note.experience}</p>
                        <div class="mt-auto pt-3 border-t border-slate-100 flex justify-between items-center">
                            <span class="text-xs text-slate-400">oleh <span class="font-medium text-slate-600">${note.user.name}</span></span>
                            <a href="/travel-notes/${note.id}" class="text-xs text-blue-500 font-semibold hover:underline">Detail</a>
                        </div>
                    </div>
                </article>
            `).join('');

        } catch (err) {
            console.error(err);
        }
    }

    loadNotes();
</script>
@endsection
