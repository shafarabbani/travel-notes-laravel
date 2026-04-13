@extends('layouts.app')

@section('title', 'Detail Catatan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="/travel-notes" class="hover:text-blue-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <span id="breadcrumb-title" class="text-slate-600 font-medium line-clamp-1">Memuat...</span>
    </nav>

    <div id="note-photo-container" class="w-full h-72 sm:h-96 rounded-2xl overflow-hidden shadow-lg mb-8 hidden">
        <img id="note-photo" src="" class="w-full h-full object-cover">
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="px-8 py-7">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h1 id="note-title" class="text-3xl font-extrabold text-slate-800 leading-tight mb-2">Memuat...</h1>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">
                        <span id="note-location" class="flex items-center gap-1"></span>
                        <span id="note-date" class="flex items-center gap-1"></span>
                        <span id="note-author" class="flex items-center gap-1"></span>
                    </div>
                </div>
                <span id="note-mood" class="inline-flex items-center text-sm font-semibold px-4 py-1.5 rounded-full capitalize self-start"></span>
            </div>

            <hr class="border-slate-100 mb-6">

            <div id="note-experience" class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line"></div>

            <div id="owner-actions" class="hidden flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                <a id="edit-link" href="" class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                    Ubah Catatan
                </a>
                <button onclick="deleteNote()" class="inline-flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                    Hapus Catatan
                </button>
            </div>
        </div>
    </div>

    <section id="komentar-section">
        <h2 class="text-xl font-bold text-slate-800 mb-5 flex items-center gap-2">
            Komentar <span id="comment-count" class="text-base font-normal text-slate-400"></span>
        </h2>

        <div id="comment-form-container" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6 hidden">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Tinggalkan komentar</h3>
            <form id="comment-form" class="space-y-4">
                <div>
                    <label for="comment_author" class="block text-xs font-semibold text-slate-500 mb-1">Nama kamu</label>
                    <input type="text" id="comment_author" name="author" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label for="comment_text" class="block text-xs font-semibold text-slate-500 mb-1">Komentar</label>
                    <textarea id="comment_text" name="comment_text" rows="3" required placeholder="Bagikan pendapatmu..."
                              class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm resize-y"></textarea>
                </div>
                <button type="submit" id="btn-comment" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    Kirim Komentar
                </button>
            </form>
        </div>

        <div id="login-invite" class="bg-blue-50 border border-blue-100 rounded-2xl p-5 mb-6 text-center hidden">
            <p class="text-sm text-slate-600"><a href="/login" class="text-blue-600 font-semibold hover:underline">Masuk</a> untuk meninggalkan komentar.</p>
        </div>

        <div id="comments-list" class="space-y-4"></div>
    </section>
</div>

<script>
    const noteId = "{{ $id }}";
    const moodLabels = {'happy':'Senang','relaxed':'Santai','excited':'Bersemangat','adventurous':'Petualang','other':'Lainnya'};
    const currentUser = JSON.parse(localStorage.getItem('user_data') || 'null');

    async function loadDetail() {
        try {
            const res = await axios.get(`/travel-notes/${noteId}`);
            const note = res.data;

            document.getElementById('breadcrumb-title').textContent = note.title;
            document.getElementById('note-title').textContent = note.title;
            document.getElementById('note-location').textContent = `${note.location}, ${note.country}`;
            document.getElementById('note-date').textContent = new Date(note.date).toLocaleDateString('id-ID', { year:'numeric', month:'long', day:'numeric' });
            document.getElementById('note-author').textContent = note.user.name;
            document.getElementById('note-experience').textContent = note.experience;
            document.getElementById('note-mood').textContent = moodLabels[note.mood] || note.mood;
            document.getElementById('note-mood').classList.add(`mood-badge-${note.mood}`);
            
            if (note.photo) {
                document.getElementById('note-photo-container').classList.remove('hidden');
                document.getElementById('note-photo').src = `/storage/${note.photo}`;
            }

            if (currentUser && currentUser.id === note.user_id) {
                document.getElementById('owner-actions').classList.remove('hidden');
                document.getElementById('edit-link').href = `/travel-notes/${noteId}/edit`;
                document.getElementById('comment_author').value = currentUser.name;
            }

            if (currentUser) {
                document.getElementById('comment-form-container').classList.remove('hidden');
                if (!document.getElementById('comment_author').value) document.getElementById('comment_author').value = currentUser.name;
            } else {
                document.getElementById('login-invite').classList.remove('hidden');
            }

            renderComments(note.comments);

        } catch (err) {
            console.error(err);
            showAlert('Gagal memuat detail catatan.', 'error');
        }
    }

    function renderComments(comments) {
        const list = document.getElementById('comments-list');
        document.getElementById('comment-count').textContent = `(${comments.length})`;
        
        if (comments.length === 0) {
            list.innerHTML = `<div class="text-center py-10 text-slate-400 text-sm">Belum ada komentar.</div>`;
            return;
        }

        list.innerHTML = comments.map(c => `
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 py-5 flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-400 flex items-center justify-center text-white font-bold text-sm uppercase">
                    ${c.author.charAt(0)}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2 mb-1">
                        <span class="font-semibold text-slate-800 text-sm">${c.author}</span>
                        <span class="text-xs text-slate-400">${new Date(c.created_at).toLocaleDateString()}</span>
                    </div>
                    <p class="text-sm text-slate-600">${c.comment_text}</p>
                </div>
            </div>
        `).join('');
    }

    async function deleteNote() {
        if (!confirm('Yakin ingin menghapus catatan ini?')) return;
        try {
            await axios.delete(`/travel-notes/${noteId}`);
            showAlert('Catatan berhasil dihapus.');
            window.location.href = '/travel-notes';
        } catch (err) {
            showAlert('Gagal menghapus catatan.', 'error');
        }
    }

    document.getElementById('comment-form')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-comment');
        const data = {
            author: document.getElementById('comment_author').value,
            comment_text: document.getElementById('comment_text').value
        };

        btn.disabled = true;
        btn.textContent = 'Mengirim...';

        try {
            const res = await axios.post(`/travel-notes/${noteId}/comments`, data);
            showAlert(res.data.message);
            document.getElementById('comment_text').value = '';
            location.reload(); // Sederhana: refresh untuk lihat komentar baru
        } catch (err) {
            showAlert('Gagal mengirim komentar.', 'error');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Kirim Komentar';
        }
    });

    loadDetail();
</script>
@endsection
