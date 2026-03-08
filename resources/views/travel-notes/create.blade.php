@extends('layouts.app')

@section('title', 'Tambah Catatan Perjalanan')
@section('meta_description', 'Catat perjalanan baru dengan pengalaman, suasana hati, dan foto.')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">

    {{-- Navigasi Breadcrumb --}}
    <nav class="text-sm text-slate-400 mb-6 flex items-center gap-2">
        <a href="{{ route('travel-notes.index') }}" class="hover:text-brand-600 transition-colors">Catatan Perjalanan</a>
        <span>/</span>
        <span class="text-slate-600 font-medium">Catatan Baru</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Header Kartu --}}
        <div class="bg-gradient-to-r from-brand-600 to-violet-600 px-8 py-6">
            <h1 class="text-2xl font-extrabold text-white">Tambah Catatan Perjalanan</h1>
            <p class="text-brand-200 text-sm mt-1">Dokumentasikan perjalananmu secara lengkap</p>
        </div>

        {{-- Formulir --}}
        <form method="POST" action="{{ route('travel-notes.store') }}" enctype="multipart/form-data" class="px-8 py-8 space-y-6">
            @csrf

            {{-- Judul --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       placeholder="contoh: Matahari Terbit di Gunung Bromo"
                       class="w-full rounded-xl border @error('title') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi + Negara --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                           placeholder="contoh: Probolinggo"
                           class="w-full rounded-xl border @error('location') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('location')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-1.5">Negara <span class="text-red-500">*</span></label>
                    <input type="text" id="country" name="country" value="{{ old('country') }}"
                           placeholder="contoh: Indonesia"
                           class="w-full rounded-xl border @error('country') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('country')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tanggal + Suasana Hati --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}"
                           class="w-full rounded-xl border @error('date') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('date')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="mood" class="block text-sm font-semibold text-slate-700 mb-1.5">Suasana Hati <span class="text-red-500">*</span></label>
                    <select id="mood" name="mood"
                            class="w-full rounded-xl border @error('mood') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                        <option value="" disabled {{ old('mood') ? '' : 'selected' }}>Pilih suasana hati...</option>
                        <option value="happy"       {{ old('mood') === 'happy'       ? 'selected' : '' }}>Senang</option>
                        <option value="relaxed"     {{ old('mood') === 'relaxed'     ? 'selected' : '' }}>Santai</option>
                        <option value="excited"     {{ old('mood') === 'excited'     ? 'selected' : '' }}>Bersemangat</option>
                        <option value="adventurous" {{ old('mood') === 'adventurous' ? 'selected' : '' }}>Petualang</option>
                        <option value="other"       {{ old('mood') === 'other'       ? 'selected' : '' }}>Lainnya</option>
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
                          placeholder="Ceritakan pengalamanmu selama perjalanan ini..."
                          class="w-full rounded-xl border @error('experience') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition resize-y">{{ old('experience') }}</textarea>
                @error('experience')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto --}}
            <div>
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1.5">Foto <span class="text-slate-400 font-normal">(opsional, maks. 2MB)</span></label>
                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full rounded-xl border @error('photo') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition">
                @error('photo')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 rounded-xl transition-colors duration-150 shadow-md text-sm">
                    Simpan Catatan
                </button>
                <a href="{{ route('travel-notes.index') }}"
                   class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl transition-colors duration-150 text-sm">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
