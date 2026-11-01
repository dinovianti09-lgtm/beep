@extends('layouts.admin')

@section('title', 'Profil Admin - Sistem Akademik Mini')

@section('page-title', 'Profil Admin')

@section('page-subtitle', 'Informasi akun administrator.')

@section('content')

<style>
    .ap-page {
        color: #293F57;
    }

    .ap-hero {
        background: linear-gradient(115deg, #C3E0F4 0%, #E3F0FA 58%, #F8FAFC 100%);
        border: 1px solid #BDD6EE;
        border-radius: 17px;
    }

    .ap-card {
        background: #FFFFFF;
        border: 1px solid #D5E1ED;
        border-radius: 15px;
        overflow: hidden;
    }

    .ap-muted {
        color: #526982;
    }

    .ap-info-box {
        background: #EAF4FF;
        border: 1px solid #D5E5F5;
        color: #3478BD;
        border-radius: 12px;
    }

    .ap-success {
        background: #ECFDF5;
        border: 1px solid #BBF7D0;
        color: #047857;
        border-radius: 12px;
    }

    .ap-error {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
        border-radius: 12px;
    }

    .ap-info-item {
        background: #F8FAFC;
        border: 1px solid #D5E1ED;
        border-radius: 11px;
        padding: 15px;
    }

    .ap-input {
        width: 100%;
        border: 1px solid #D5E1ED;
        border-radius: 10px;
        background: #F8FAFC;
        color: #293F57;
        padding: 12px 45px 12px 15px;
        font-size: 13px;
        outline: none;
        transition: .2s ease;
    }

    .ap-input:focus {
        background: #FFFFFF;
        border-color: #3478BD;
        box-shadow: 0 0 0 3px rgba(52, 120, 189, .12);
    }

    .ap-input::placeholder {
        color: #94A3B8;
    }

    .ap-label {
        display: block;
        margin-bottom: 9px;
        color: #293F57;
        font-size: 13px;
        font-weight: 700;
    }

    .ap-password-toggle {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #8295AB;
        transition: .2s ease;
    }

    .ap-password-toggle:hover {
        color: #3478BD;
    }

    .ap-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #3478BD;
        color: #FFFFFF;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 800;
        transition: .2s ease;
    }

    .ap-submit-btn:hover {
        background: #285F96;
        transform: translateY(-1px);
    }

    .ap-section-icon {
        display: flex;
        width: 42px;
        height: 42px;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #EAF4FF;
        color: #3478BD;
    }

    /* DARK MODE */

    .dark .ap-page {
        color: #E4ECF6;
    }

    .dark .ap-hero {
        background: linear-gradient(115deg, #243E59 0%, #1C3049 58%, #17283D 100%);
        border-color: #354962;
    }

    .dark .ap-card {
        background: #192438;
        border-color: #354962;
    }

    .dark .ap-muted {
        color: #A7B8CC;
    }

    .dark .ap-info-box {
        background: #243E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .ap-success {
        background: #12372F;
        border-color: #23604D;
        color: #86EFAC;
    }

    .dark .ap-error {
        background: #3B2028;
        border-color: #693541;
        color: #FCA5A5;
    }

    .dark .ap-info-item {
        background: #1C3049;
        border-color: #354962;
    }

    .dark .ap-input {
        background: #1C3049;
        border-color: #3A5068;
        color: #E4ECF6;
    }

    .dark .ap-input:focus {
        background: #243E59;
        border-color: #6CA7DE;
        box-shadow: 0 0 0 3px rgba(108, 167, 222, .12);
    }

    .dark .ap-input::placeholder {
        color: #8295AB;
    }

    .dark .ap-label {
        color: #E4ECF6;
    }

    .dark .ap-password-toggle {
        color: #A7B8CC;
    }

    .dark .ap-password-toggle:hover {
        color: #A9D2F5;
    }

    .dark .ap-section-icon {
        background: #263E59;
        color: #A9D2F5;
    }
</style>


<div class="ap-page space-y-6 p-6 lg:p-8">

    {{-- HERO HEADER --}}
    <div class="ap-hero flex items-center gap-4 p-6 lg:p-7">

        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-white/60 bg-white/70 text-[#3478BD] shadow-sm dark:border-slate-500/20 dark:bg-slate-800/40 dark:text-blue-300">

            <svg xmlns="http://www.w3.org/2000/svg"
                width="27"
                height="27"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/>
                <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
            </svg>

        </div>

        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-[#3478BD] dark:text-blue-300">
                Pengaturan Akun
            </p>

            <h2 class="text-xl font-extrabold text-[#293F57] dark:text-white lg:text-2xl">
                Profil Admin
            </h2>

            <p class="mt-1 text-xs text-[#526982] dark:text-slate-300 sm:text-sm">
                Informasi akun administrator Sistem Akademik Mini.
            </p>
        </div>

    </div>


    {{-- NOTIFIKASI BERHASIL --}}
    @if(session('success'))

        <div class="ap-success flex items-center gap-3 p-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/70 font-bold dark:bg-black/10">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m5 12 4 4L19 6"/>
                </svg>
            </div>

            <div>
                <p class="text-sm font-extrabold">
                    Berhasil
                </p>

                <p class="mt-1 text-xs">
                    {{ session('success') }}
                </p>
            </div>

        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="ap-error p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/70 font-bold dark:bg-black/10">
                    !
                </div>

                <div class="space-y-1">

                    <p class="text-sm font-extrabold">
                        Password belum berhasil diubah.
                    </p>

                    @foreach($errors->all() as $error)

                        <p class="text-xs">
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            </div>

        </div>

    @endif


    {{-- PROFILE CARD --}}
    <div class="ap-card">

        {{-- CARD HEADER --}}
        <div class="border-b border-[#D5E1ED] px-6 py-5 dark:border-[#354962]">

            <div class="flex items-center gap-3">

                <div class="ap-section-icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>
                </div>

                <div>
                    <h3 class="text-base font-extrabold text-[#293F57] dark:text-white">
                        Informasi Akun
                    </h3>

                    <p class="mt-1 text-xs ap-muted">
                        Informasi administrator yang sedang login.
                    </p>
                </div>

            </div>

        </div>


        {{-- PROFILE IDENTITY --}}
        <div class="border-b border-[#D5E1ED] px-6 py-6 dark:border-[#354962]">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#3478BD] text-white shadow-md shadow-blue-900/10">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="31"
                        height="31"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>

                </div>

                <div>

                    <h4 class="text-xl font-extrabold text-[#293F57] dark:text-white">
                        {{ auth()->user()->username }}
                    </h4>

                    <p class="mt-1 text-sm ap-muted">
                        Administrator Sistem Akademik
                    </p>

                    <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-[#BBE7D0] bg-[#ECFDF5] px-3 py-1.5 text-xs font-bold text-[#218454] dark:border-[#23604D] dark:bg-[#12372F] dark:text-[#86EFAC]">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        Akun Aktif

                    </div>

                </div>

            </div>

        </div>


        {{-- ACCOUNT INFORMATION --}}
        <div class="p-6">

            <div class="mb-5">

                <h4 class="text-sm font-extrabold text-[#293F57] dark:text-white">
                    Detail Akun
                </h4>

                <p class="mt-1 text-xs ap-muted">
                    Informasi identitas dan hak akses administrator.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- USERNAME --}}
                <div class="ap-info-item">

                    <div class="mb-3 flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-[#3478BD] dark:text-blue-300">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>

                        <label class="text-xs font-bold ap-muted">
                            Username
                        </label>

                    </div>

                    <p class="break-all text-sm font-extrabold text-[#293F57] dark:text-white">
                        {{ auth()->user()->username }}
                    </p>

                </div>


                {{-- ROLE --}}
                <div class="ap-info-item">

                    <div class="mb-3 flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-[#3478BD] dark:text-blue-300">
                            <path d="m12 2 8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V6z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>

                        <label class="text-xs font-bold ap-muted">
                            Role
                        </label>

                    </div>

                    <p class="text-sm font-extrabold text-[#293F57] dark:text-white">
                        Administrator
                    </p>

                </div>


                {{-- STATUS --}}
                <div class="ap-info-item">

                    <div class="mb-3 flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-[#3478BD] dark:text-blue-300">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                        <label class="text-xs font-bold ap-muted">
                            Status Akun
                        </label>

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>

                        <p class="text-sm font-extrabold text-[#218454] dark:text-green-300">
                            Aktif
                        </p>

                    </div>

                </div>


                {{-- HAK AKSES --}}
                <div class="ap-info-item">

                    <div class="mb-3 flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-[#3478BD] dark:text-blue-300">
                            <rect x="3" y="10" width="18" height="11" rx="2"/>
                            <path d="M7 10V7a5 5 0 0 1 10 0v3"/>
                        </svg>

                        <label class="text-xs font-bold ap-muted">
                            Hak Akses
                        </label>

                    </div>

                    <p class="text-sm font-extrabold text-[#293F57] dark:text-white">
                        Akses Administrator
                    </p>

                </div>

            </div>


            {{-- INFORMATION --}}
            <div class="ap-info-box mt-6 flex items-start gap-3 p-5">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="mt-0.5 shrink-0">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4"/>
                    <path d="M12 8h.01"/>
                </svg>

                <div>

                    <p class="text-sm font-extrabold">
                        Informasi
                    </p>

                    <p class="mt-1 text-xs leading-relaxed opacity-90">
                        Halaman ini menampilkan informasi akun administrator
                        yang sedang digunakan untuk mengakses Sistem Akademik Mini.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- CHANGE PASSWORD CARD --}}
    <div class="ap-card">

        {{-- CARD HEADER --}}
        <div class="border-b border-[#D5E1ED] px-6 py-5 dark:border-[#354962]">

            <div class="flex items-center gap-3">

                <div class="ap-section-icon">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="10" width="18" height="11" rx="2"/>
                        <path d="M7 10V7a5 5 0 0 1 10 0v3"/>
                    </svg>

                </div>

                <div>

                    <h3 class="text-base font-extrabold text-[#293F57] dark:text-white">
                        Ganti Password
                    </h3>

                    <p class="mt-1 text-xs ap-muted">
                        Perbarui password akun administrator.
                    </p>

                </div>

            </div>

        </div>


        {{-- PASSWORD FORM --}}
        <form
            action="{{ route('admin.profil.password') }}"
            method="POST"
            autocomplete="off"
        >

            @csrf

            <div class="space-y-5 p-6">


                {{-- CURRENT PASSWORD --}}
                <div>

                    <label
                        for="current_password"
                        class="ap-label"
                    >
                        Password Saat Ini
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            required
                            autocomplete="current-password"
                            class="ap-input"
                            placeholder="Masukkan password saat ini"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('current_password', this)"
                            class="ap-password-toggle"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg class="eye-closed hidden"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m3 3 18 18"/>
                                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                <path d="M9.9 5.1A10.7 10.7 0 0 1 12 5c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.1 4.1"/>
                                <path d="M6.2 6.2A13.6 13.6 0 0 0 2 12s3.5 7 10 7c1.4 0 2.7-.3 3.9-.8"/>
                            </svg>

                        </button>

                    </div>

                    @error('current_password')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- NEW PASSWORD --}}
                <div>

                    <label
                        for="password"
                        class="ap-label"
                    >
                        Password Baru
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="ap-input"
                            placeholder="Masukkan password baru"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="ap-password-toggle"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg class="eye-closed hidden"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m3 3 18 18"/>
                                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                <path d="M9.9 5.1A10.7 10.7 0 0 1 12 5c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.1 4.1"/>
                                <path d="M6.2 6.2A13.6 13.6 0 0 0 2 12s3.5 7 10 7c1.4 0 2.7-.3 3.9-.8"/>
                            </svg>

                        </button>

                    </div>

                    <p class="mt-2 text-xs ap-muted">
                        Minimal 8 karakter, terdiri dari huruf besar, huruf kecil, dan angka.
                    </p>

                    @error('password')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- CONFIRM PASSWORD --}}
                <div>

                    <label
                        for="password_confirmation"
                        class="ap-label"
                    >
                        Konfirmasi Password Baru
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="ap-input"
                            placeholder="Ulangi password baru"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', this)"
                            class="ap-password-toggle"
                            aria-label="Tampilkan password"
                        >

                            <svg class="eye-open"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg class="eye-closed hidden"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m3 3 18 18"/>
                                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                <path d="M9.9 5.1A10.7 10.7 0 0 1 12 5c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.1 4.1"/>
                                <path d="M6.2 6.2A13.6 13.6 0 0 0 2 12s3.5 7 10 7c1.4 0 2.7-.3 3.9-.8"/>
                            </svg>

                        </button>

                    </div>

                    @error('password_confirmation')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- INFORMASI PASSWORD --}}
                <div class="ap-info-box flex items-start gap-3 p-4">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mt-0.5 shrink-0">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 16v-4"/>
                        <path d="M12 8h.01"/>
                    </svg>

                    <div>

                        <p class="text-xs font-extrabold">
                            Keamanan Akun
                        </p>

                        <p class="mt-1 text-xs leading-relaxed opacity-90">
                            Pastikan password baru dan konfirmasi password
                            sama sebelum menyimpan perubahan.
                        </p>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="flex justify-end border-t border-[#D5E1ED] pt-5 dark:border-[#354962]">

                    <button
                        type="submit"
                        class="ap-submit-btn"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="17"
                            height="17"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>

                        Simpan Password Baru

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- FOOTER --}}
    <p class="pt-2 text-center text-xs text-[#8A9DB1] dark:text-slate-500">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>


{{-- SCRIPT TAMPIL / SEMBUNYIKAN PASSWORD --}}
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