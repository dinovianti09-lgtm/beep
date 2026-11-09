
@extends('layouts.guru')

@section('title', 'Profil Guru - Sistem Akademik')
@section('page-title', 'Profil Guru')
@section('page-subtitle', 'Informasi akun guru')

@push('styles')
<style>
.profil-guru-page {
    --pg-border: #D8E3EE;
    --pg-text: #26374A;
    --pg-muted: #647991;
    --pg-card: #FFFFFF;
    --pg-field-bg: #F7F9FC;
    --pg-field-border: #E0E7EF;
    color: var(--pg-text);
}

/* HEADER UTAMA */
.profil-guru-page .pg-page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px 24px;
    border: 1px solid #C8DCEE;
    border-radius: 16px;
    background: linear-gradient(120deg, #E3F0FA 0%, #F3F8FD 100%);
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.profil-guru-page .pg-page-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    border: 1px solid #C8DCEE;
    border-radius: 13px;
    background: #FFFFFF;
    color: #416D99;
}

.profil-guru-page .pg-page-header h1 {
    color: #294D70;
    font-size: 21px;
    font-weight: 800;
}

.profil-guru-page .pg-page-header p {
    color: #607A94;
}

/* CARD */
.profil-guru-page .pg-card {
    overflow: hidden;
    border: 1px solid var(--pg-border);
    border-radius: 16px;
    background: var(--pg-card);
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.profil-guru-page .pg-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #E5ECF3;
}

.profil-guru-page .pg-heading {
    color: var(--pg-text);
}

.profil-guru-page .pg-muted {
    color: var(--pg-muted);
}

.profil-guru-page .pg-field {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 48px;
    padding: 12px 15px;
    border: 1px solid var(--pg-field-border);
    border-radius: 11px;
    background: var(--pg-field-bg);
    overflow-wrap: anywhere;
}

.profil-guru-page .pg-field svg {
    flex-shrink: 0;
    color: #477DAF;
}

/* INPUT PASSWORD */
.profil-guru-page .pg-input {
    width: 100%;
    min-height: 48px;
    padding: 12px 48px 12px 15px;
    border: 1px solid #CBD5E1;
    border-radius: 11px;
    background: #FFFFFF;
    color: #26374A;
    outline: none;
    transition: .2s ease;
}

.profil-guru-page .pg-input:focus {
    border-color: #3478BD;
    box-shadow: 0 0 0 3px rgba(52,120,189,.12);
}

.profil-guru-page .pg-input::placeholder {
    color: #94A3B8;
}

.profil-guru-page .pg-password-toggle {
    color: #3478BD;
}

.profil-guru-page .pg-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 44px;
    padding: 11px 18px;
    border-radius: 11px;
    background: #397DBB;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 800;
    transition: .2s ease;
}

.profil-guru-page .pg-submit:hover {
    background: #286AA8;
    transform: translateY(-1px);
}

/* DARK MODE */
.dark .profil-guru-page,
html.dark .profil-guru-page,
body.dark .profil-guru-page {
    --pg-border: #34465F;
    --pg-text: #F1F6FC;
    --pg-muted: #AFC0D4;
    --pg-card: #192438;
    --pg-field-bg: #202F44;
    --pg-field-border: #40516A;
    color: #E2EAF4;
}

/* Header utama */
.dark .profil-guru-page .pg-page-header,
html.dark .profil-guru-page .pg-page-header,
body.dark .profil-guru-page .pg-page-header {
    background: linear-gradient(120deg, #1D3149 0%, #223A55 100%) !important;
    border-color: #405B78 !important;
}

.dark .profil-guru-page .pg-page-header h1,
html.dark .profil-guru-page .pg-page-header h1,
body.dark .profil-guru-page .pg-page-header h1 {
    color: #F1F6FC !important;
}

.dark .profil-guru-page .pg-page-header p,
html.dark .profil-guru-page .pg-page-header p,
body.dark .profil-guru-page .pg-page-header p {
    color: #C0D2E5 !important;
}

.dark .profil-guru-page .pg-page-icon,
html.dark .profil-guru-page .pg-page-icon,
body.dark .profil-guru-page .pg-page-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

/* Card */
.dark .profil-guru-page .pg-card,
html.dark .profil-guru-page .pg-card,
body.dark .profil-guru-page .pg-card {
    background: #192438 !important;
    border-color: #34465F !important;
}

.dark .profil-guru-page .pg-card-header,
html.dark .profil-guru-page .pg-card-header,
body.dark .profil-guru-page .pg-card-header {
    border-color: #34465F !important;
}

.dark .profil-guru-page .pg-heading,
html.dark .profil-guru-page .pg-heading,
body.dark .profil-guru-page .pg-heading {
    color: #F1F6FC !important;
}

.dark .profil-guru-page .pg-muted,
html.dark .profil-guru-page .pg-muted,
body.dark .profil-guru-page .pg-muted {
    color: #AFC0D4 !important;
}

/* Field informasi */
.dark .profil-guru-page .pg-field,
html.dark .profil-guru-page .pg-field,
body.dark .profil-guru-page .pg-field {
    background: #202F44 !important;
    border-color: #40516A !important;
}

.dark .profil-guru-page .pg-field span,
html.dark .profil-guru-page .pg-field span,
body.dark .profil-guru-page .pg-field span {
    color: #E2EAF4 !important;
}

.dark .profil-guru-page .pg-field svg,
html.dark .profil-guru-page .pg-field svg,
body.dark .profil-guru-page .pg-field svg {
    color: #A9C9E9 !important;
}

/* Header kartu profil */
.dark .profil-guru-page .pg-profile-header,
html.dark .profil-guru-page .pg-profile-header,
body.dark .profil-guru-page .pg-profile-header {
    background: #263E59 !important;
    border-color: #405B78 !important;
}

.dark .profil-guru-page .pg-profile-avatar,
html.dark .profil-guru-page .pg-profile-avatar,
body.dark .profil-guru-page .pg-profile-avatar {
    background: #192438 !important;
    border-color: #405B78 !important;
}

.dark .profil-guru-page .pg-profile-avatar svg,
html.dark .profil-guru-page .pg-profile-avatar svg,
body.dark .profil-guru-page .pg-profile-avatar svg {
    color: #C8E0F8 !important;
}

/* Input */
.dark .profil-guru-page .pg-input,
html.dark .profil-guru-page .pg-input,
body.dark .profil-guru-page .pg-input {
    background: #202F44 !important;
    border-color: #40516A !important;
    color: #F1F6FC !important;
}

.dark .profil-guru-page .pg-input::placeholder,
html.dark .profil-guru-page .pg-input::placeholder,
body.dark .profil-guru-page .pg-input::placeholder {
    color: #91A5BC !important;
}

.dark .profil-guru-page .pg-input:focus,
html.dark .profil-guru-page .pg-input:focus,
body.dark .profil-guru-page .pg-input:focus {
    border-color: #78A9DB !important;
    box-shadow: 0 0 0 3px rgba(120,169,219,.16);
}

.dark .profil-guru-page .pg-password-toggle,
html.dark .profil-guru-page .pg-password-toggle,
body.dark .profil-guru-page .pg-password-toggle {
    color: #B9D8F7 !important;
}

/* RESPONSIVE */
@media(max-width:640px) {
    .profil-guru-page {
        padding: 16px !important;
    }

    .profil-guru-page .pg-page-header {
        padding: 17px;
        gap: 12px;
    }

    .profil-guru-page .pg-page-icon {
        width: 44px;
        height: 44px;
    }

    .profil-guru-page .pg-page-header h1 {
        font-size: 18px;
    }

    .profil-guru-page .pg-card-header {
        padding: 17px;
    }

    .profil-guru-page .pg-submit {
        width: 100%;
    }
}
</style>
@endpush

@section('content')

@php
    $user = auth()->user();
    $guru = \App\Models\Guru::where('user_id', $user->id)->first();
@endphp

<div class="profil-guru-page space-y-6 p-4 sm:p-6 lg:p-8">

    {{-- HEADER UTAMA --}}
    <div class="pg-page-header">
        <div class="pg-page-icon">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>

        <div class="min-w-0">
            <h1>Profil Guru</h1>
            <p class="mt-1 text-sm">
                Informasi akun guru yang sedang digunakan.
            </p>
        </div>
    </div>

    {{-- PROFILE CARD --}}
    <div class="pg-card">

        {{-- PROFILE HEADER --}}
        <div class="pg-profile-header border-b border-[#D5E5F3] bg-[#EAF3FB] px-5 py-6 sm:px-6">
            <div class="flex items-center gap-4">
                <div class="pg-profile-avatar flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-[#D5E5F3] bg-white">
                    <svg class="h-9 w-9 text-[#477DAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <h3 class="break-words text-xl font-extrabold text-slate-800 dark:text-white">
                        {{ $guru->nama_guru ?? $user->username }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                        Guru Sistem Akademik
                    </p>
                </div>
            </div>
        </div>

        {{-- PROFILE INFORMATION --}}
        <div class="p-5 sm:p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- NAMA GURU --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Nama Guru
                    </label>
                    <div class="pg-field">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $guru->nama_guru ?? '-' }}
                        </span>
                    </div>
                </div>

                {{-- NIP --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        NIP
                    </label>
                    <div class="pg-field">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $guru->nip ?? '-' }}
                        </span>
                    </div>
                </div>

                {{-- USERNAME --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Username
                    </label>
                    <div class="pg-field">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $user->username }}
                        </span>
                    </div>
                </div>

                {{-- MAPEL --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Mata Pelajaran
                    </label>
                    <div class="pg-field">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $guru->mapel_diampu ?? '-' }}
                        </span>
                    </div>
                </div>

                {{-- ROLE --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Role
                    </label>
                    <div class="pg-field">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.291 9 11.622C17.176 19.291 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            Guru
                        </span>
                    </div>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Status Akun
                    </label>
                    <div class="pg-field">
                        <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-green-500"></span>
                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            Aktif
                        </span>
                    </div>
                </div>

            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800/50 dark:bg-green-900/20">
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-green-800 dark:text-green-300">
                                Berhasil
                            </p>
                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- INFORMATION --}}
            <div class="mt-6 rounded-xl border border-[#D5E5F3] bg-[#EAF3FB] p-4 dark:border-[#405B78] dark:bg-[#263E59]">
                <div class="flex items-start gap-3">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#477DAF] dark:text-[#C8E0F8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-slate-800 dark:text-white">
                            Informasi
                        </p>
                        <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300">
                            Halaman ini menampilkan informasi akun Guru yang sedang digunakan
                            untuk mengakses Sistem Akademik Mini.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- CHANGE PASSWORD CARD --}}
    <div class="pg-card">

        {{-- HEADER --}}
        <div class="pg-card-header">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#D5E5F3] bg-[#EAF3FB] text-[#477DAF] dark:border-[#405B78] dark:bg-[#263E59] dark:text-[#C8E0F8]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="pg-heading text-lg font-extrabold">
                        Ganti Password
                    </h3>
                    <p class="pg-muted mt-1 text-sm">
                        Perbarui password akun Guru kamu.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800/50 dark:bg-red-900/20">
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                        </svg>
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-red-800 dark:text-red-300">
                                Password belum berhasil diubah
                            </p>
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-700 dark:text-red-400">
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- PASSWORD FORM --}}
            <form action="{{ route('guru.profil.password') }}" method="POST" class="space-y-5">
                @csrf

                {{-- CURRENT PASSWORD --}}
                <div>
                    <label for="current_password" class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Password Saat Ini
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            required
                            autocomplete="current-password"
                            class="pg-input"
                            placeholder="Masukkan password saat ini">

                        <button
                            type="button"
                            onclick="togglePassword('current_password', this)"
                            class="pg-password-toggle absolute right-3 top-1/2 -translate-y-1/2 transition hover:opacity-70"
                            aria-label="Tampilkan password">
                            <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3 3l18 18M10.584 10.587A2 2 0 0013.414 13.4M9.88 4.24A9.77 9.77 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.78 9.78 0 01-3.102 4.51M6.228 6.228A9.78 9.78 0 002.458 12C3.732 16.057 7.523 19 12 19c1.61 0 3.13-.397 4.45-1.102"/>
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NEW PASSWORD --}}
                <div>
                    <label for="password" class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="pg-input"
                            placeholder="Masukkan password baru">

                        <button
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="pg-password-toggle absolute right-3 top-1/2 -translate-y-1/2 transition hover:opacity-70"
                            aria-label="Tampilkan password">
                            <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3 3l18 18M10.584 10.587A2 2 0 0013.414 13.4M9.88 4.24A9.77 9.77 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.78 9.78 0 01-3.102 4.51M6.228 6.228A9.78 9.78 0 002.458 12C3.732 16.057 7.523 19 12 19c1.61 0 3.13-.397 4.45-1.102"/>
                            </svg>
                        </button>
                    </div>
                    <p class="pg-muted mt-2 text-xs">
                        Minimal 8 karakter, terdiri dari huruf besar, huruf kecil, dan angka.
                    </p>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="pg-input"
                            placeholder="Ulangi password baru">

                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', this)"
                            class="pg-password-toggle absolute right-3 top-1/2 -translate-y-1/2 transition hover:opacity-70"
                            aria-label="Tampilkan password">
                            <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3 3l18 18M10.584 10.587A2 2 0 0013.414 13.4M9.88 4.24A9.77 9.77 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.78 9.78 0 01-3.102 4.51M6.228 6.228A9.78 9.78 0 002.458 12C3.732 16.057 7.523 19 12 19c1.61 0 3.13-.397 4.45-1.102"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end pt-2">
                    <button type="submit" class="pg-submit">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Password Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- SHOW / HIDE PASSWORD --}}
<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const eyeOpen = button.querySelector('.eye-open');
    const eyeClosed = button.querySelector('.eye-closed');

    if (!input || !eyeOpen || !eyeClosed) {
        return;
    }

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
