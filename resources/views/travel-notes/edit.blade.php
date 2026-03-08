@extends('layouts.app')

@section('title', 'Ubah — ' . $travelNote->title)
@section('meta_description', 'Ubah catatan perjalananmu.')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">

    {{-- Navigasi Breadcrumb --}}
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="{{ route('travel-notes.index') }}" class="hover:text-brand-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <a href="{{ route('travel-notes.show', $travelNote) }}" class="hover:text-brand-600 transition-colors line-clamp-1 max-w-[180px]">{{ $travelNote->title }}</a>
        <span>/</span>
        <span class="text-slate-600 font-medium">Ubah</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Header Kartu --}}
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-8 py-6">
            <h1 class="text-2xl font-extrabold text-white">Ubah Catatan Perjalanan</h1>
            <p class="text-amber-100 text-sm mt-1">Perbarui detail perjalananmu</p>
        </div>

        {{-- Formulir --}}
        <form method="POST" action="{{ route('travel-notes.update', $travelNote) }}" enctype="multipart/form-data" class="px-8 py-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $travelNote->title) }}"
                       class="w-full rounded-xl border @error('title') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi + Negara --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location', $travelNote->location) }}"
                           class="w-full rounded-xl border @error('location') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                    @error('location')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-1.5">Negara <span class="text-red-500">*</span></label>
                    <input type="text" id="country" name="country" value="{{ old('country', $travelNote->country) }}"
                           class="w-full rounded-xl border @error('country') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                    @error('country')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tanggal + Suasana Hati --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="date" name="date" value="{{ old('date', $travelNote->date->format('Y-m-d')) }}"
                           class="w-full rounded-xl border @error('date') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                    @error('date')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="mood" class="block text-sm font-semibold text-slate-700 mb-1.5">Suasana Hati <span class="text-red-500">*</span></label>
                    <select id="mood" name="mood"
                            class="w-full rounded-xl border @error('mood') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                        @php
                            $moodOptions = [
                                'happy'       => 'Senang',
                                'relaxed'     => 'Santai',
                                'excited'     => 'Bersemangat',
                                'adventurous' => 'Petualang',
                                'other'       => 'Lainnya',
                            ];
                        @endphp
                        @foreach($moodOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('mood', $travelNote->mood) === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('mood')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Pengalaman --}}
            <div>
                <label for="experience" class="block text-sm font-semibold text-slate-700 mb-1.5">Cerita Perjalanan <span class="text-red-500">*</span></label>
                <textarea id="experience" name="experience" rows="5"
                          class="w-full rounded-xl border @error('experience') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-y">{{ old('experience', $travelNote->experience) }}</textarea>
                @error('experience')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Foto</label>
                @if($travelNote->photo)
                    <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <img src="{{ asset('storage/' . $travelNote->photo) }}" alt="Foto saat ini"
                             class="w-16 h-12 object-cover rounded-lg border border-slate-200">
                        <span class="text-xs text-slate-500">Foto saat ini — unggah foto baru untuk menggantinya</span>
                    </div>
                @endif
                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full rounded-xl border @error('photo') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition">
                @error('photo')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition-colors duration-150 shadow-md text-sm">
                    Perbarui Catatan
                </button>
                <a href="{{ route('travel-notes.show', $travelNote) }}"
                   class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl transition-colors duration-150 text-sm">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
