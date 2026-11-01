@extends('layouts.admin')

@section('title', 'Data Rapor - Sistem Akademik Mini')

@section('page-title', 'Data Rapor')

@section('page-subtitle', 'Kelola periode rapor yang tersedia dalam sistem.')

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

    /* TOMBOL TAMBAH */

    .rp-primary-btn {
        background: #3478BD;
        color: #FFFFFF;
        transition: .2s ease;
    }

    .rp-primary-btn:hover {
        background: #285F96;
        transform: translateY(-1px);
    }

    /* TABLE */

    .rp-table {
        width: 100%;
        min-width: 650px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .rp-table th {
        background: #EAF4FF;
        color: #526982;
        border-right: 1px solid #D7E5F3;
        border-bottom: 1px solid #CFDEED;
        padding: 15px 20px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .rp-table th:last-child,
    .rp-table td:last-child {
        border-right: none;
    }

    .rp-table td {
        padding: 17px 20px;
        border-right: 1px solid #E0E9F3;
        border-bottom: 1px solid #E0E9F3;
        color: #293F57;
        font-size: 13px;
    }

    .rp-table tbody tr:nth-child(even) {
        background: #F9FBFE;
    }

    .rp-table tbody tr:hover {
        background: #EDF6FF;
    }

    .rp-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* BADGE SEMESTER */

    .rp-semester {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        border-radius: 8px;
        border: 1px solid #C8DCEE;
        background: #EAF4FF;
        color: #3478BD;
        font-size: 11px;
        font-weight: 800;
    }

    .rp-semester-genap {
        border-color: #AFC7E2;
        background: #C9DDF1;
        color: #315D89;
    }

    /* TOMBOL EDIT */

    .rp-edit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 15px;
        border-radius: 9px;
        background: #EAF4FF;
        color: #3478BD;
        border: 1px solid #D5E5F5;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
        cursor: pointer;
    }

    .rp-edit-btn:hover {
        background: #3478BD;
        border-color: #3478BD;
        color: #FFFFFF;
    }

    /* TOMBOL HAPUS */

    .rp-delete-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 15px;
        border: 1px solid #F1D1D5;
        border-radius: 9px;
        background: #FFF0F1;
        color: #A93649;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .rp-delete-btn:hover {
        color: #FFFFFF;
        background: #C9475D;
        border-color: #C9475D;
        transform: translateY(-1px);
    }

    .rp-delete-btn svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    /* NOTIFIKASI */

    .rp-alert-success {
        background: #ECFDF5;
        border: 1px solid #BBF7D0;
        color: #047857;
    }

    .rp-alert-error {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #B91C1C;
    }

    /* =====================================================
       PAGINATION
       HANYA TOMBOL SEBELUMNYA DAN SELANJUTNYA
    ===================================================== */

    .rp-pagination {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        padding: 16px 20px;
        border-top: 1px solid #D5E1ED;
        background: #FFFFFF;
    }

    .rp-pagination-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    .rp-page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 14px;
        border: 1px solid #C8DCEE;
        border-radius: 8px;
        background: #FFFFFF;
        color: #3478BD;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: background .18s ease, border-color .18s ease;
    }

    .rp-page-link:hover {
        border-color: #A4BFDF;
        background: #E3F0FA;
    }

    .rp-page-link-disabled {
        border-color: #E0E7EF;
        background: #F4F7FA;
        color: #9AA9B9;
        cursor: not-allowed;
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

    .dark .rp-table th {
        background: #263E59;
        color: #C1D0E1;
        border-color: #3A5068;
    }

    .dark .rp-table td {
        color: #E4ECF6;
        border-color: #354962;
    }

    .dark .rp-table tbody tr:nth-child(even) {
        background: #1C2B40;
    }

    .dark .rp-table tbody tr:hover {
        background: #243E59;
    }

    .dark .rp-semester {
        background: #243E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .rp-semester-genap {
        background: #315071;
        border-color: #496D91;
        color: #D2E7FA;
    }

    /* EDIT DARK MODE */

    .dark .rp-edit-btn {
        background: #263E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .rp-edit-btn:hover {
        background: #3478BD;
        border-color: #3478BD;
        color: #FFFFFF;
    }

    /* HAPUS DARK MODE */

    .dark .rp-delete-btn {
        color: #FFC5CD;
        background: #432A35;
        border-color: #65404B;
    }

    .dark .rp-delete-btn:hover {
        color: #FFFFFF;
        background: #B83B52;
        border-color: #B83B52;
    }

    /* NOTIFIKASI DARK MODE */

    .dark .rp-alert-success {
        background: #12372F;
        border-color: #23604D;
        color: #86EFAC;
    }

    .dark .rp-alert-error {
        background: #3B2028;
        border-color: #693541;
        color: #FCA5A5;
    }

    /* PAGINATION DARK MODE */

    .dark .rp-pagination {
        border-color: #354962;
        background: #192438;
    }

    .dark .rp-page-link {
        border-color: #405773;
        background: #24364D;
        color: #D5E5F8;
    }

    .dark .rp-page-link:hover {
        background: #2F4865;
    }

    .dark .rp-page-link-disabled {
        border-color: #35465D;
        background: #1D2B3E;
        color: #71849A;
    }

    /* RESPONSIVE */

    @media (max-width: 640px) {
        .rp-action-wrapper {
            flex-direction: column;
        }

        .rp-action-wrapper form,
        .rp-action-wrapper a,
        .rp-action-wrapper button {
            width: 100%;
        }

        .rp-pagination {
            padding: 16px;
        }

        .rp-pagination-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

<div class="rp-page p-6 lg:p-8">

    {{-- HERO HEADER --}}
    <div class="rp-hero mb-7 flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between lg:p-7">

        <div class="flex items-center gap-4">

            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-white/60 bg-white/70 text-[#3478BD] shadow-sm dark:border-slate-500/20 dark:bg-slate-800/40 dark:text-blue-300">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="27" height="27" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <path d="M14 2v6h6"/>
                    <path d="M8 13h8"/>
                    <path d="M8 17h8"/>
                </svg>

            </div>

            <div>

                <p class="mb-1 text-xs font-bold uppercase tracking-wider text-[#3478BD] dark:text-blue-300">
                    Manajemen Akademik
                </p>

                <h2 class="text-xl font-extrabold text-[#293F57] dark:text-white lg:text-2xl">
                    Periode Rapor
                </h2>

                <p class="mt-1 text-xs text-[#526982] dark:text-slate-300 sm:text-sm">
                    Kelola semester dan tahun ajaran rapor sekolah.
                </p>

            </div>

        </div>


        {{-- TAMBAH PERIODE --}}
        <a href="{{ route('admin.rapor.create') }}"
            class="rp-primary-btn inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold shadow-md shadow-blue-900/10">

            <svg xmlns="http://www.w3.org/2000/svg"
                width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>

            Tambah Periode
        </a>

    </div>


    {{-- NOTIFIKASI BERHASIL --}}
    @if(session('success'))

        <div class="rp-alert-success mb-6 flex items-center gap-3 rounded-xl p-4">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-lg font-bold dark:bg-black/10">
                ✓
            </div>

            <p class="text-sm font-semibold">
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))

        <div class="rp-alert-error mb-6 flex items-center gap-3 rounded-xl p-4">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-lg font-bold dark:bg-black/10">
                !
            </div>

            <p class="text-sm font-semibold">
                {{ session('error') }}
            </p>

        </div>

    @endif


    {{-- NOTIFIKASI VALIDASI --}}
    @if($errors->any())

        <div class="rp-alert-error mb-6 rounded-xl p-4">

            <p class="mb-2 text-sm font-bold">
                Terjadi kesalahan
            </p>

            <ul class="space-y-1 text-sm">

                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- TABLE CARD --}}
    <div class="rp-card">

        {{-- CARD HEADER --}}
        <div class="flex flex-col gap-3 border-b border-[#D5E1ED] px-5 py-5 dark:border-[#354962] sm:flex-row sm:items-center sm:justify-between lg:px-6">

            <div>

                <h3 class="text-base font-extrabold text-[#293F57] dark:text-white">
                    Daftar Periode Rapor
                </h3>

                <p class="mt-1 text-xs rp-muted">
                    Data semester dan tahun ajaran yang telah terdaftar.
                </p>

            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-full border border-[#D5E5F5] bg-[#EAF4FF] px-3.5 py-2 text-xs font-bold text-[#3478BD] dark:border-[#3A5876] dark:bg-[#263E59] dark:text-blue-300">

                <span class="h-2 w-2 rounded-full bg-[#3478BD]"></span>

                {{ $rapors->total() }} Periode Terdaftar

            </div>

        </div>


        {{-- TABLE --}}
        <div class="w-full overflow-x-auto">

            <table class="rp-table" id="rapor-index-table">

                <colgroup>
                    <col style="width: 10%">
                    <col style="width: 25%">
                    <col style="width: 30%">
                    <col style="width: 35%">
                </colgroup>

                <thead>
                    <tr>

                        <th class="text-left">
                            No
                        </th>

                        <th class="text-left">
                            Semester
                        </th>

                        <th class="text-left">
                            Tahun Ajaran
                        </th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($rapors as $index => $rapor)

                        <tr>

                            {{-- NOMOR --}}
                            <td>
                                <span class="font-bold rp-muted">
                                    {{ $rapors->firstItem() + $index }}
                                </span>
                            </td>


                            {{-- SEMESTER --}}
                            <td>

                                @if(in_array(strtolower(trim((string) $rapor->semester)), ['1', 'ganjil']))

                                    <span class="rp-semester">
                                        Semester Ganjil
                                    </span>

                                @elseif(in_array(strtolower(trim((string) $rapor->semester)), ['2', 'genap']))

                                    <span class="rp-semester rp-semester-genap">
                                        Semester Genap
                                    </span>

                                @else

                                    <span class="rp-semester">
                                        Semester {{ $rapor->semester }}
                                    </span>

                                @endif

                            </td>


                            {{-- TAHUN AJARAN --}}
                            <td>
                                <span class="font-bold">
                                    {{ $rapor->tahun_ajaran }}
                                </span>
                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="rp-action-wrapper flex flex-wrap items-center justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.rapor.edit', $rapor->id_rapor) }}"
                                        class="rp-edit-btn">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="15" height="15"
                                            viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                                        </svg>

                                        Edit
                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.rapor.destroy', $rapor->id_rapor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus periode {{ $rapor->semester }} - {{ $rapor->tahun_ajaran }}? Periode hanya bisa dihapus jika belum digunakan oleh data akademik.')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rp-delete-btn"
                                        >

                                            <svg
                                                width="16"
                                                height="16"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 7h16M10 11v6m4-6v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                                />
                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#EAF4FF] text-[#3478BD] dark:bg-[#263E59] dark:text-blue-300">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="30" height="30"
                                            viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <path d="M14 2v6h6"/>
                                            <path d="M8 13h8"/>
                                            <path d="M8 17h5"/>
                                        </svg>

                                    </div>

                                    <h4 class="text-sm font-extrabold text-[#293F57] dark:text-white">
                                        Belum Ada Periode Rapor
                                    </h4>

                                    <p class="mt-2 max-w-sm text-xs rp-muted">
                                        Belum ada periode rapor yang terdaftar.
                                        Silakan tambahkan periode rapor terlebih dahulu.
                                    </p>

                                    <a href="{{ route('admin.rapor.create') }}"
                                        class="rp-primary-btn mt-5 inline-flex items-center gap-2 rounded-lg px-4 py-2.5 text-xs font-bold">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="15" height="15"
                                            viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round">
                                            <path d="M12 5v14"/>
                                            <path d="M5 12h14"/>
                                        </svg>

                                        Tambah Periode
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($rapors->hasPages())

            <div class="rp-pagination">

                <div class="rp-pagination-actions">

                    {{-- SEBELUMNYA --}}
                    @if($rapors->onFirstPage())

                        <span class="rp-page-link rp-page-link-disabled">
                            ← Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ $rapors->previousPageUrl() }}"
                            class="rp-page-link"
                        >
                            ← Sebelumnya
                        </a>

                    @endif


                    {{-- SELANJUTNYA --}}
                    @if($rapors->hasMorePages())

                        <a
                            href="{{ $rapors->nextPageUrl() }}"
                            class="rp-page-link"
                        >
                            Selanjutnya →
                        </a>

                    @else

                        <span class="rp-page-link rp-page-link-disabled">
                            Selanjutnya →
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </div>


    {{-- FOOTER --}}
    <p class="mt-7 text-center text-xs text-[#8A9DB1] dark:text-slate-500">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection