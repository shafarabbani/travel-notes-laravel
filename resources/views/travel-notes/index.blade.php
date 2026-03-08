@extends('layouts.app')

@section('title', 'Semua Catatan Perjalanan')
@section('meta_description', 'Jelajahi semua catatan perjalanan — temukan berbagai kisah petualangan dari seluruh dunia.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Judul Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Catatan Perjalanan</h1>
            <p class="text-slate-500 mt-1 text-sm">
                {{ $travelNotes->total() }} {{ $travelNotes->total() == 1 ? 'perjalanan' : 'perjalanan' }} tercatat
            </p>
        </div>
        @auth
            <a href="{{ route('travel-notes.create') }}"
               class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-sm transition-colors duration-150 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Catatan
            </a>
        @endauth
    </div>

    @if($travelNotes->isEmpty())
        {{-- Kondisi Kosong --}}
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-20 h-20 rounded-full bg-brand-50 flex items-center justify-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-slate-700">Belum ada catatan perjalanan</h2>
            <p class="text-slate-400 mt-2 text-sm max-w-xs">
                Jadilah yang pertama berbagi perjalanan! Masuk dan tambahkan catatan perjalananmu.
            </p>
            @auth
                <a href="{{ route('travel-notes.create') }}"
                   class="mt-6 inline-flex bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    Tambah Catatan Pertama
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="mt-6 inline-flex bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    Masuk untuk Menambahkan
                </a>
            @endauth
        </div>
    @else
        {{-- Grid Kartu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($travelNotes as $note)
                <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1">

                    {{-- Foto --}}
                    <a href="{{ route('travel-notes.show', $note) }}" class="block overflow-hidden h-48 bg-gradient-to-br from-brand-100 to-violet-100 relative">
                        @if($note->photo)
                            <img src="{{ asset('storage/' . $note->photo) }}"
                                 alt="{{ $note->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-brand-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                </svg>
                            </div>
                        @endif
                        {{-- Badge Suasana Hati --}}
                        <span class="absolute top-3 right-3 mood-badge-{{ $note->mood }} text-xs font-semibold px-2.5 py-1 rounded-full capitalize shadow-sm">
                            @php
                                $moodLabel = [
                                    'happy'       => 'Senang',
                                    'relaxed'     => 'Santai',
                                    'excited'     => 'Bersemangat',
                                    'adventurous' => 'Petualang',
                                    'other'       => 'Lainnya',
                                ];
                            @endphp
                            {{ $moodLabel[$note->mood] ?? ucfirst($note->mood) }}
                        </span>
                    </a>

                    {{-- Isi Kartu --}}
                    <div class="flex flex-col flex-1 p-5">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <a href="{{ route('travel-notes.show', $note) }}"
                               class="font-bold text-slate-800 leading-snug hover:text-brand-600 transition-colors line-clamp-2 flex-1">
                                {{ $note->title }}
                            </a>
                        </div>

                        <p class="text-xs text-slate-400 flex items-center gap-1 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/>
                            </svg>
                            {{ $note->location }}, {{ $note->country }}
                        </p>

                        <p class="text-xs text-slate-400 flex items-center gap-1 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            {{ $note->date->translatedFormat('j F Y') }}
                        </p>

                        <p class="text-sm text-slate-500 line-clamp-3 flex-1 mb-4">
                            {{ $note->experience }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-slate-100">
                            <span class="text-xs text-slate-400">
                                oleh <span class="font-medium text-slate-600">{{ $note->user->name }}</span>
                            </span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    {{ $note->comments_count ?? $note->comments->count() }}
                                </span>
                                @auth
                                    @if(Auth::id() === $note->user_id)
                                        <a href="{{ route('travel-notes.edit', $note) }}"
                                           class="text-xs text-brand-500 hover:text-brand-700 font-medium transition-colors">Ubah</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Paginasi --}}
        @if($travelNotes->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $travelNotes->links() }}
            </div>
        @endif
    @endif

</div>
@endsection
