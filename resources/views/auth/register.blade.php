@extends('layouts.app')

@section('title', 'Buat Akun')
@section('meta_description', 'Bergabung dengan Buku Perjalanan — buat akun gratis dan mulai dokumentasikan perjalananmu.')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-violet-600 to-brand-700 px-8 py-8 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 rounded-2xl mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-white">Buat akun baru</h1>
                <p class="text-violet-200 text-sm mt-1">Mulai buku harianmu hari ini</p>
            </div>

            {{-- Formulir --}}
            <form method="POST" action="{{ route('register') }}" class="px-8 py-8 space-y-5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           autocomplete="name" autofocus required
                           placeholder="Nama lengkapmu"
                           class="w-full rounded-xl border @error('name') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           autocomplete="email" required
                           placeholder="contoh@email.com"
                           class="w-full rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata Sandi --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Kata Sandi <span class="font-normal text-slate-400">(min. 8 karakter)</span>
                    </label>
                    <input type="password" id="password" name="password"
                           autocomplete="new-password" required
                           class="w-full rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Kata Sandi --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           autocomplete="new-password" required
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                </div>

                {{-- Tombol Daftar --}}
                <button type="submit"
                        class="w-full bg-violet-600 hover:bg-violet-700 active:bg-violet-800 text-white font-bold py-3 rounded-xl transition-colors duration-150 shadow-md hover:shadow-lg text-sm tracking-wide">
                    Buat Akun
                </button>

                <p class="text-center text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-brand-600 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </form>
        </div>

    </div>
</div>
@endsection
