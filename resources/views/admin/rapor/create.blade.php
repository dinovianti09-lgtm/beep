@extends('layouts.admin')

@section('title', 'Tambah Periode Rapor - Sistem Akademik Mini')

@section('page-title', 'Tambah Periode Rapor')

@section('page-subtitle', 'Tambahkan periode rapor baru.')

@section('content')

<style>
    .rp-page {
        color: #293F57;
    }

    .rp-hero {
        background: linear-gradient(115deg, #C3E0F4 0%, #E3F0FA 58%, #F8FAFC 100%);
        border: 1px solid #BDD6EE;
        border-radius: 17px;
    }

    .rp-card {
        background: #FFFFFF;
        border: 1px solid #D5E1ED;
        border-radius: 15px;
        overflow: hidden;
    }

    .rp-muted {
        color: #526982;
    }

    .rp-label {
        display: block;
        margin-bottom: 9px;
        color: #293F57;
        font-size: 13px;
        font-weight: 700;
    }

    .rp-required {
        color: #DC5555;
    }

    .rp-input {
        width: 100%;
        border: 1px solid #D5E1ED;
        border-radius: 10px;
        background: #F8FAFC;
        color: #293F57;
        padding: 12px 15px;
        font-size: 13px;
        outline: none;
        transition: .2s ease;
    }

    .rp-input:focus {
        border-color: #3478BD;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(52, 120, 189, .12);
    }

    .rp-input::placeholder {
        color: #94A3B8;
    }

    .rp-primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #3478BD;
        color: #FFFFFF;
        border-radius: 10px;
        padding: 12px 21px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .rp-primary-btn:hover {
        background: #285F96;
        transform: translateY(-1px);
    }

    .rp-secondary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1px solid #D5E1ED;
        background: #FFFFFF;
        color: #526982;
        border-radius: 10px;
        padding: 12px 21px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .rp-secondary-btn:hover {
        background: #F1F6FB;
        border-color: #BDD6EE;
    }

    .rp-info {
        background: #EAF4FF;
        border: 1px solid #D5E5F5;
        border-radius: 12px;
        color: #3478BD;
    }

    .rp-error {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
        border-radius: 12px;
    }

    /* DARK MODE */

    .dark .rp-page {
        color: #E4ECF6;
    }

    .dark .rp-hero {
        background: linear-gradient(115deg, #243E59 0%, #1C3049 58%, #17283D 100%);
        border-color: #354962;
    }

    .dark .rp-card {
        background: #192438;
        border-color: #354962;
    }

    .dark .rp-muted {
        color: #A7B8CC;
    }

    .dark .rp-label {
        color: #E4ECF6;
    }

    .dark .rp-input {
        background: #1C3049;
        border-color: #3A5068;
        color: #E4ECF6;
    }

    .dark .rp-input:focus {
        background: #243E59;
        border-color: #6CA7DE;
        box-shadow: 0 0 0 3px rgba(108, 167, 222, .12);
    }

    .dark .rp-input::placeholder {
        color: #8295AB;
    }

    .dark .rp-input option {
        background: #192438;
        color: #E4ECF6;
    }

    .dark .rp-secondary-btn {
        background: #24364D;
        border-color: #3A5068;
        color: #D3DFEC;
    }

    .dark .rp-secondary-btn:hover {
        background: #304966;
        border-color: #527393;
    }

    .dark .rp-info {
        background: #243E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .rp-error {
        background: #3B2028;
        border-color: #693541;
        color: #FCA5A5;
    }
</style>

<div class="rp-page p-6 lg:p-8">

    {{-- HERO HEADER --}}
    <div class="rp-hero mb-7 flex items-center gap-4 p-6 lg:p-7">

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
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <path d="M14 2v6h6"/>
                <path d="M8 13h8"/>
                <path d="M8 17h8"/>
                <path d="M8 9h2"/>
            </svg>

        </div>

        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-[#3478BD] dark:text-blue-300">
                Manajemen Akademik
            </p>

            <h2 class="text-xl font-extrabold text-[#293F57] dark:text-white lg:text-2xl">
                Tambah Periode Rapor
            </h2>

            <p class="mt-1 text-xs text-[#526982] dark:text-slate-300 sm:text-sm">
                Tambahkan semester dan tahun ajaran baru ke dalam sistem.
            </p>
        </div>

    </div>


    {{-- FORM CARD --}}
    <div class="rp-card">

        {{-- CARD HEADER --}}
        <div class="flex items-center gap-3 border-b border-[#D5E1ED] px-6 py-5 dark:border-[#354962]">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EAF4FF] text-[#3478BD] dark:bg-[#263E59] dark:text-blue-300">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>

            </div>

            <div>
                <h3 class="text-sm font-extrabold text-[#293F57] dark:text-white">
                    Form Periode Rapor
                </h3>

                <p class="mt-1 text-xs rp-muted">
                    Lengkapi informasi periode rapor yang akan ditambahkan.
                </p>
            </div>

        </div>


        {{-- FORM --}}
        <form action="{{ route('admin.rapor.store') }}" method="POST">

            @csrf

            <div class="space-y-6 p-6 sm:p-8">

                {{-- SEMESTER --}}
                <div>

                    <label for="semester" class="rp-label">
                        Semester
                        <span class="rp-required">*</span>
                    </label>

                    <select
                        id="semester"
                        name="semester"
                        required
                        class="rp-input"
                    >

                        <option value="">
                            Pilih Semester
                        </option>

                        <option
                            value="Ganjil"
                            {{ old('semester') == 'Ganjil' ? 'selected' : '' }}
                        >
                            Ganjil
                        </option>

                        <option
                            value="Genap"
                            {{ old('semester') == 'Genap' ? 'selected' : '' }}
                        >
                            Genap
                        </option>

                    </select>

                    @error('semester')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-2 text-xs rp-muted">
                        Pilih semester Ganjil atau Genap.
                    </p>

                </div>


                {{-- TAHUN AJARAN --}}
                <div>

                    <label for="tahun_ajaran" class="rp-label">
                        Tahun Ajaran
                        <span class="rp-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="tahun_ajaran"
                        name="tahun_ajaran"
                        value="{{ old('tahun_ajaran', '2026/2027') }}"
                        placeholder="Contoh: 2026/2027"
                        required
                        maxlength="20"
                        class="rp-input"
                    >

                    <p class="mt-2 text-xs rp-muted">
                        Gunakan format tahun ajaran, contoh: 2026/2027.
                    </p>

                    @error('tahun_ajaran')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ERROR VALIDASI --}}
                @if ($errors->any())

                    <div class="rp-error p-4">

                        <div class="mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v4"/>
                                <path d="M12 16h.01"/>
                            </svg>

                            <p class="text-sm font-bold">
                                Data belum bisa disimpan
                            </p>
                        </div>

                        <ul class="list-inside list-disc space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

            </div>


            {{-- BUTTON FOOTER --}}
            <div class="flex flex-col justify-end gap-3 border-t border-[#D5E1ED] bg-[#F8FAFC] px-6 py-5 dark:border-[#354962] dark:bg-[#17283D] sm:flex-row sm:px-8">

                <a
                    href="{{ route('admin.rapor.index') }}"
                    class="rp-secondary-btn"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>

                    Batal
                </a>

                <button
                    type="submit"
                    class="rp-primary-btn"
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
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>

                    Simpan Periode
                </button>

            </div>

        </form>

    </div>


    {{-- INFORMATION --}}
    <div class="rp-info mt-6 flex items-start gap-3 p-5">

        <div class="mt-0.5 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 16v-4"/>
                <path d="M12 8h.01"/>
            </svg>
        </div>

        <div>
            <p class="text-sm font-extrabold">
                Informasi
            </p>

            <p class="mt-1 text-xs leading-relaxed opacity-90">
                Periode rapor yang ditambahkan akan digunakan sebagai acuan
                saat Guru menginput nilai siswa dan saat sistem menyusun rapor.
            </p>
        </div>

    </div>


    {{-- FOOTER --}}
    <p class="mt-7 text-center text-xs text-[#8A9DB1] dark:text-slate-500">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection