@extends('layouts.siswa')

@section('title', 'Profil Siswa - Sistem Akademik')

@section('page-title', 'Profil Siswa')

@section('page-subtitle', 'Kelola informasi akun dan keamanan')

@section('content')

@php
    $siswa = \App\Models\Siswa::where('user_id', auth()->id())->first();
@endphp

<div class="space-y-6">

    {{-- HEADER PROFIL --}}
    <div class="bg-[#E3F0FA] dark:bg-slate-800 rounded-2xl border border-[#C3D9EC] dark:border-slate-700 shadow-sm p-6 transition-smooth">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            {{-- AVATAR ICON SISWA --}}
            <div class="w-20 h-20 rounded-2xl bg-[#89AAD7] border border-white/60 flex items-center justify-center text-white shrink-0">

                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M5 21a7 7 0 0114 0" />
                </svg>

            </div>

            <div class="min-w-0">

                <h2 class="text-xl font-extrabold text-[#355779] dark:text-white">
                    {{ $siswa->nama_siswa ?? ucfirst(auth()->user()->username) }}
                </h2>

                <p class="text-sm text-[#527397] dark:text-slate-300 mt-1">
                    Akun Siswa
                </p>

                <div class="flex flex-wrap items-center gap-2 mt-3">

                    {{-- BADGE SISWA --}}
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/70 dark:bg-blue-500/10 text-[#4779A8] dark:text-blue-400 text-xs font-semibold">

                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7" />
                        </svg>

                        Siswa
                    </span>

                    {{-- BADGE AKTIF --}}
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-semibold">

                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                        Aktif
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- INFORMASI AKUN --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-[#DCE8F3] dark:border-slate-800 shadow-sm overflow-hidden transition-smooth">

        {{-- HEADER INFORMASI --}}
        <div class="px-6 py-5 border-b border-[#C3D9EC] bg-[#E3F0FA] dark:bg-slate-800 dark:border-slate-700">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-white/80 dark:bg-blue-500/10 flex items-center justify-center">

                    <svg class="w-5 h-5 text-[#4779A8] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>

                </div>

                <div>
                    <h3 class="font-bold text-[#355779] dark:text-white">
                        Informasi Akun
                    </h3>

                    <p class="text-xs text-[#607D9B] dark:text-slate-400 mt-0.5">
                        Informasi akun siswa yang sedang digunakan
                    </p>
                </div>

            </div>

        </div>


        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- NAMA --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        Nama Siswa
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F8FAFC] dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700">

                        <svg class="w-5 h-5 text-[#89AAD7] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7" />
                        </svg>

                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            {{ $siswa->nama_siswa ?? '-' }}
                        </span>

                    </div>
                </div>


                {{-- NIS --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        NIS
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F8FAFC] dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700">

                        <svg class="w-5 h-5 text-[#89AAD7] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            {{ $siswa->nis ?? '-' }}
                        </span>

                    </div>
                </div>


                {{-- KELAS --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        Kelas
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F8FAFC] dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700">

                        <svg class="w-5 h-5 text-[#89AAD7] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 19.5A2.5 2.5 0 016.5 17H20M4 4.5A2.5 2.5 0 016.5 7H20M6.5 7v10M20 17V7" />
                        </svg>

                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            {{ $siswa->kelas ?? '-' }}
                        </span>

                    </div>
                </div>


                {{-- USERNAME --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        Username
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F8FAFC] dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700">

                        <svg class="w-5 h-5 text-[#89AAD7] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A9 9 0 1118.879 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            {{ auth()->user()->username }}
                        </span>

                    </div>
                </div>


                {{-- ROLE --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        Role
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F8FAFC] dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700">

                        <svg class="w-5 h-5 text-[#89AAD7] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z" />
                        </svg>

                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Siswa
                        </span>

                    </div>
                </div>


                {{-- STATUS --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                        Status Akun
                    </label>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20">

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                        <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                            Aktif
                        </span>

                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- KEAMANAN AKUN --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-[#DCE8F3] dark:border-slate-800 shadow-sm overflow-hidden transition-smooth">

        {{-- HEADER KEAMANAN --}}
        <div class="px-6 py-5 border-b border-[#C3D9EC] bg-[#E3F0FA] dark:bg-slate-800 dark:border-slate-700">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-white/80 dark:bg-blue-500/10 flex items-center justify-center">

                    <svg class="w-5 h-5 text-[#4779A8] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                    </svg>

                </div>

                <div>
                    <h3 class="font-bold text-[#355779] dark:text-white">
                        Keamanan Akun
                    </h3>

                    <p class="text-xs text-[#607D9B] dark:text-slate-400 mt-0.5">
                        Ubah password akun siswa
                    </p>
                </div>

            </div>

        </div>


        <div class="p-6">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-5 flex items-start gap-3 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20">

                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    <p class="text-sm font-medium text-emerald-700 dark:text-emerald-300">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- ERRORS --}}
            @if($errors->any())

                <div class="mb-5 p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">

                    <div class="flex items-start gap-3">

                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z" />
                        </svg>

                        <div class="space-y-1">

                            @foreach($errors->all() as $error)

                                <p class="text-sm text-red-700 dark:text-red-300">
                                    {{ $error }}
                                </p>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif


            {{-- FORM PASSWORD --}}
            <form
                action="{{ route('siswa.profil.password') }}"
                method="POST"
                class="space-y-5"
            >

                @csrf


                {{-- PASSWORD LAMA --}}
                <div>

                    <label
                        for="current_password"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2"
                    >
                        Password Saat Ini
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            required
                            autocomplete="current-password"
                            class="w-full px-4 py-3 pr-12 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#A4BFDF] focus:border-[#89AAD7] transition-smooth"
                            placeholder="Masukkan password saat ini"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('current_password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#4779A8] dark:hover:text-slate-200"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18M10.58 10.58a2 2 0 002.84 2.84M9.88 5.09A9.95 9.95 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.043 5.195M6.71 6.71C4.92 8.02 3.55 9.77 2.458 12 3.732 16.057 7.523 19 12 19c1.07 0 2.1-.17 3.07-.49" />
                            </svg>

                        </button>

                    </div>

                </div>


                {{-- PASSWORD BARU --}}
                <div>

                    <label
                        for="password"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2"
                    >
                        Password Baru
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-3 pr-12 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#A4BFDF] focus:border-[#89AAD7] transition-smooth"
                            placeholder="Masukkan password baru"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#4779A8] dark:hover:text-slate-200"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18M10.58 10.58a2 2 0 002.84 2.84M9.88 5.09A9.95 9.95 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.043 5.195M6.71 6.71C4.92 8.02 3.55 9.77 2.458 12 3.732 16.057 7.523 19 12 19c1.07 0 2.1-.17 3.07-.49" />
                            </svg>

                        </button>

                    </div>

                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        Gunakan minimal 8 karakter dengan huruf besar, huruf kecil, dan angka.
                    </p>

                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div>

                    <label
                        for="password_confirmation"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2"
                    >
                        Konfirmasi Password Baru
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-3 pr-12 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#A4BFDF] focus:border-[#89AAD7] transition-smooth"
                            placeholder="Ulangi password baru"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#4779A8] dark:hover:text-slate-200"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18M10.58 10.58a2 2 0 002.84 2.84M9.88 5.09A9.95 9.95 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.043 5.195M6.71 6.71C4.92 8.02 3.55 9.77 2.458 12 3.732 16.057 7.523 19 12 19c1.07 0 2.1-.17 3.07-.49" />
                            </svg>

                        </button>

                    </div>

                </div>


                {{-- BUTTON SIMPAN --}}
                <div class="pt-2 flex justify-end">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#7299C7] hover:bg-[#5F89B9] text-white font-semibold text-sm shadow-sm transition-smooth focus:outline-none focus:ring-2 focus:ring-[#A4BFDF] focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                    >

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>

                        Simpan Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PASSWORD SCRIPT --}}
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const eyeOpen = button.querySelector('.eye-open');
        const eyeClosed = button.querySelector('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
            button.setAttribute('aria-label', 'Sembunyikan password');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
            button.setAttribute('aria-label', 'Tampilkan password');
        }
    }
</script>

@endsection