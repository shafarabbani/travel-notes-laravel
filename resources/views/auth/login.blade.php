@extends('layouts.app')

@section('title', 'Masuk')
@section('meta_description', 'Masuk ke akun Buku Perjalananmu untuk mengelola catatan perjalanan.')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        {{-- Kartu --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-brand-600 to-brand-800 px-8 py-8 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 rounded-2xl mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-white">Selamat datang kembali</h1>
                <p class="text-brand-200 text-sm mt-1">Masuk ke Buku Perjalananmu</p>
            </div>

            {{-- Formulir --}}
            <form method="POST" action="{{ route('login') }}" class="px-8 py-8 space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           autocomplete="email" autofocus required
                           placeholder="contoh@email.com"
                           class="w-full rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata Sandi --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                           autocomplete="current-password" required
                           class="w-full rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ingat Saya --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember"
                           class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
                </div>

                {{-- Tombol Masuk --}}
                <button type="submit"
                        class="w-full bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold py-3 rounded-xl transition-colors duration-150 shadow-md hover:shadow-lg text-sm tracking-wide">
                    Masuk
                </button>

                <p class="text-center text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-brand-600 font-semibold hover:underline">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
