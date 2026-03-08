@extends('layouts.app')

@section('title', $travelNote->title)
@section('meta_description', 'Catatan perjalanan: ' . Str::limit($travelNote->experience, 150))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">

    {{-- Navigasi Breadcrumb --}}
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="{{ route('travel-notes.index') }}" class="hover:text-brand-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <span class="text-slate-600 font-medium line-clamp-1">{{ $travelNote->title }}</span>
    </nav>

    {{-- Hero / Foto --}}
    @if($travelNote->photo)
        <div class="w-full h-72 sm:h-96 rounded-2xl overflow-hidden shadow-lg mb-8">
            <img src="{{ asset('storage/' . $travelNote->photo) }}"
                 alt="{{ $travelNote->title }}"
                 class="w-full h-full object-cover">
        </div>
    @else
        <div class="w-full h-40 rounded-2xl overflow-hidden mb-8 bg-gradient-to-br from-brand-100 via-violet-100 to-sky-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-brand-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
            </svg>
        </div>
    @endif

    {{-- Kartu Utama --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">

        <div class="px-8 py-7">

            {{-- Judul + Meta --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-extrabold text-slate-800 leading-tight mb-2">
                        {{ $travelNote->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/>
                            </svg>
                            {{ $travelNote->location }}, {{ $travelNote->country }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            {{ $travelNote->date->translatedFormat('j F Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $travelNote->user->name }}
                        </span>
                    </div>
                </div>

                {{-- Badge Suasana Hati --}}
                @php
                    $moodLabel = [
                        'happy'       => 'Senang',
                        'relaxed'     => 'Santai',
                        'excited'     => 'Bersemangat',
                        'adventurous' => 'Petualang',
                        'other'       => 'Lainnya',
                    ];
                @endphp
                <span class="inline-flex items-center mood-badge-{{ $travelNote->mood }} text-sm font-semibold px-4 py-1.5 rounded-full capitalize self-start">
                    {{ $moodLabel[$travelNote->mood] ?? ucfirst($travelNote->mood) }}
                </span>
            </div>

            {{-- Garis Pemisah --}}
            <hr class="border-slate-100 mb-6">

            {{-- Cerita Perjalanan --}}
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                {{ $travelNote->experience }}
            </div>

            {{-- Tombol Aksi Pemilik --}}
            @auth
                @if(Auth::id() === $travelNote->user_id)
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('travel-notes.edit', $travelNote) }}"
                           class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Ubah Catatan
                        </a>
                        <form method="POST" action="{{ route('travel-notes.destroy', $travelNote) }}"
                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus catatan ini? Tindakan ini tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                                </svg>
                                Hapus Catatan
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- ── Bagian Komentar ─────────────────────────────────────────── --}}
    <section id="komentar">
        <h2 class="text-xl font-bold text-slate-800 mb-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Komentar
            <span class="text-base font-normal text-slate-400">({{ $travelNote->comments->count() }})</span>
        </h2>

        {{-- Formulir Tambah Komentar --}}
        @auth
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
                <h3 class="text-sm font-semibold text-slate-700 mb-4">Tinggalkan komentar</h3>
                <form method="POST" action="{{ route('comments.store', $travelNote) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="author" class="block text-xs font-semibold text-slate-500 mb-1">Nama kamu</label>
                        <input type="text" id="author" name="author" value="{{ old('author', Auth::user()->name) }}"
                               class="w-full rounded-xl border @error('author') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                        @error('author')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="comment_text" class="block text-xs font-semibold text-slate-500 mb-1">Komentar</label>
                        <textarea id="comment_text" name="comment_text" rows="3"
                                  placeholder="Bagikan pendapatmu tentang perjalanan ini..."
                                  class="w-full rounded-xl border @error('comment_text') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition resize-y">{{ old('comment_text') }}</textarea>
                        @error('comment_text')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                        Kirim Komentar
                    </button>
                </form>
            </div>
        @else
            <div class="bg-brand-50 border border-brand-100 rounded-2xl p-5 mb-6 text-center">
                <p class="text-sm text-slate-600">
                    <a href="{{ route('login') }}" class="text-brand-600 font-semibold hover:underline">Masuk</a>
                    untuk meninggalkan komentar.
                </p>
            </div>
        @endauth

        {{-- Daftar Komentar --}}
        @if($travelNote->comments->isEmpty())
            <div class="text-center py-10 text-slate-400">
                <p class="text-sm">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($travelNote->comments as $comment)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 py-5 flex gap-4">

                        {{-- Avatar --}}
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-brand-400 to-violet-500 flex items-center justify-center text-white font-bold text-sm uppercase">
                            {{ mb_substr($comment->author, 0, 1) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <span class="font-semibold text-slate-800 text-sm">{{ $comment->author }}</span>
                                <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $comment->comment_text }}</p>

                            {{-- Hapus komentar (hanya pemilik catatan) --}}
                            @auth
                                @if(Auth::id() === $travelNote->user_id)
                                    <form method="POST"
                                          action="{{ route('comments.destroy', [$travelNote, $comment]) }}"
                                          class="mt-2"
                                          onsubmit="return confirm('Hapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

</div>
@endsection
