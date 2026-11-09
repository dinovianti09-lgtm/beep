@extends('layouts.admin')

@section('title', 'Data Siswa - Sistem Akademik Mini')
@section('page-title', 'Data Siswa')
@section('page-subtitle', 'Kelola data siswa berdasarkan kelas.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA SISWA
   Pastel Blue + Dark Navy
===================================================== */

.siswa-page {
    --sp-blue: #3478BD;
    --sp-blue-dark: #285F96;
    --sp-text: #293F57;
    --sp-muted: #526982;
    --sp-border: #D5E1ED;

    color: var(--sp-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.siswa-page *,
.siswa-page *::before,
.siswa-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.sp-enter {
    animation: spEnter .35s ease-out both;
}

.sp-delay {
    animation-delay: .08s;
}

@keyframes spEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes spRowEnter {
    from {
        opacity: 0;
        transform: translateY(4px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */

.sp-hero {
    overflow: hidden;
    border: 1px solid #BDD6EE;
    border-radius: 17px;
    background: linear-gradient(
        115deg,
        #C3E0F4 0%,
        #E3F0FA 58%,
        #F8FAFC 100%
    );
    box-shadow: 0 4px 12px rgba(47, 93, 145, .06);
}

.sp-hero-icon,
.sp-section-icon,
.sp-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.sp-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.sp-hero-icon svg {
    width: 27px;
    height: 27px;
}

.sp-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.sp-section-icon svg {
    width: 20px;
    height: 20px;
}

.sp-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.sp-hero-title {
    color: #214A77;
}

.sp-hero-description {
    color: #4D6886;
}

/* TOMBOL UTAMA */

.sp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background .18s ease,
        border-color .18s ease;
}

.sp-button svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.sp-button:hover {
    transform: translateY(-1px);
}

.sp-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.sp-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.sp-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.sp-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
}

.sp-button:focus-visible,
.sp-search-button:focus-visible,
.sp-reset-button:focus-visible,
.sp-action:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

/* NOTIFIKASI */

.sp-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.7;
    animation: spEnter .35s ease both;
}

.sp-alert-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border: 1px solid currentColor;
    border-radius: 9px;
    background: rgba(255, 255, 255, .8);
    font-size: 17px;
    font-weight: 900;
}

.sp-alert-icon svg {
    width: 18px;
    height: 18px;
}

/* PANEL */

.sp-panel {
    position: relative;
    z-index: 5;
    overflow: visible;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #F2F7FC;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.sp-panel-body {
    padding: 20px;
}

.sp-panel-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.sp-panel-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    line-height: 1.7;
}

/* INPUT DAN FILTER */

.sp-field-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
}

.sp-search-wrapper {
    position: relative;
    min-width: 0;
    flex: 1;
}

.sp-search-input,
.sp-filter-select {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    outline: none;
    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.sp-search-input {
    padding-left: 41px;
}

.sp-search-input::placeholder {
    color: #8495A8;
}

.sp-search-input:focus,
.sp-filter-select:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.sp-search-icon {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 13px;
    display: flex;
    align-items: center;
    color: #849AB0;
    pointer-events: none;
}

.sp-search-icon svg {
    width: 17px;
    height: 17px;
}

/* DROPDOWN KELAS */

.siswa-page select.sp-filter-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    color-scheme: light;

    padding: 10px 40px 10px 12px;

    background-color: #FFFFFF;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23526982' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 13px center;
    background-size: 16px;

    cursor: pointer;
}

.siswa-page select.sp-filter-select option {
    background: #FFFFFF;
    color: #26374A;
}

/* TOMBOL CARI DAN RESET */

.sp-search-button,
.sp-reset-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 44px;
    padding: 10px 16px;
    border-radius: 9px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease;
}

.sp-search-button svg,
.sp-reset-button svg {
    width: 16px;
    height: 16px;
}

.sp-search-button {
    border: 1px solid #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.sp-search-button:hover {
    transform: translateY(-1px);
    background: #285F96;
}

.sp-reset-button {
    border: 1px solid #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.sp-reset-button:hover {
    background: #E3F0FA;
}

/* RINGKASAN FILTER */

.sp-filter-summary {
    color: #506983;
    background: rgba(255, 255, 255, .62);
    border: 1px solid #D8E7F6;
    border-radius: 9px;
}

/* RIWAYAT PENCARIAN */

.sp-suggestion-box {
    position: absolute;
    top: calc(100% + 7px);
    left: 0;
    right: 0;
    z-index: 90;
    overflow: hidden;
    max-height: 260px;
    overflow-y: auto;
    border: 1px solid #D5E1ED;
    border-radius: 10px;
    background: #FFFFFF;
    box-shadow: 0 8px 20px rgba(39, 77, 119, .12);
    animation: spSuggestionEnter .16s ease-out;
}

.sp-suggestion-box[hidden] {
    display: none !important;
}

@keyframes spSuggestionEnter {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.sp-suggestion-heading {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: 10px 13px;
    border-bottom: 1px solid #E5EDF5;
    background: #F8FAFC;
    color: #71849A;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .07em;
    text-transform: uppercase;
}

.sp-suggestion-item {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 11px 13px;
    border: 0;
    background: #FFFFFF;
    color: #30445B;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    text-align: left;
    cursor: pointer;
    transition: background .18s ease;
}

.sp-suggestion-item + .sp-suggestion-item {
    border-top: 1px solid #EDF1F6;
}

.sp-suggestion-item:hover,
.sp-suggestion-item:focus-visible {
    outline: none;
    background: #EAF3FC;
    color: #285F96;
}

.sp-suggestion-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    color: #89AAD7;
}

/* =====================================================
   IMPORT EXCEL
===================================================== */

.sp-import-info {
    border: 1px solid #D8E7F6;
    border-radius: 10px;
    background: rgba(255, 255, 255, .62);
    color: #506983;
}

.sp-import-step {
    min-width: 0;
    padding: 17px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #FFFFFF;
}

.sp-step-title {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #344F6B;
    font-size: 13px;
    font-weight: 800;
}

.sp-step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 27px;
    height: 27px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
}

.sp-file-input {
    display: block;
    width: 100%;
    padding: 9px;
    border: 1px dashed #C9D9E9;
    border-radius: 9px;
    background: #F8FAFC;
    color: #405268;
    font-size: 12px;
}

.sp-file-input::file-selector-button {
    margin-right: 9px;
    padding: 7px 10px;
    border: 0;
    border-radius: 7px;
    background: #E3F0FA;
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
}

.sp-import-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 15px;
    border: 1px solid #3478BD;
    border-radius: 9px;
    background: #3478BD;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
    transition: background .18s ease;
}

.sp-import-button:hover {
    background: #285F96;
}

.sp-import-button svg {
    width: 16px;
    height: 16px;
}

.sp-import-note {
    margin-top: 15px;
    padding-top: 12px;
    border-top: 1px solid #D5E1ED;
    color: #73869B;
    font-size: 11px;
    line-height: 1.8;
}

.sp-import-error {
    padding: 13px;
    border: 1px solid #D5E1ED;
    border-radius: 9px;
    background: #F8FAFC;
}

/* PASSWORD SEMENTARA */

.sp-password-box {
    border: 1px solid #BDD6EE;
    border-radius: 13px;
    background: linear-gradient(115deg, #F5F9FE, #E3F0FA);
}

.sp-password-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 42px;
    padding: 10px 12px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 13px;
    font-weight: 800;
}

.sp-copy-button {
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid #3478BD;
    border-radius: 9px;
    background: #3478BD;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
}

.sp-copy-button:hover {
    background: #285F96;
}

/* =====================================================
   TABEL DATA SISWA
===================================================== */

.sp-table-shell {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.sp-table-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 13px;
    padding: 18px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
}

.sp-total {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border: 1px solid #C8DFF7;
    border-radius: 8px;
    background: #EAF4FF;
    color: #2C6399;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

.sp-total svg {
    width: 15px;
    height: 15px;
}

/* TABEL */

.sp-table {
    width: 100%;
    min-width: 1200px;
    border-collapse: separate;
    border-spacing: 0;
    text-align: left;
}

.sp-table thead th {
    padding: 13px 16px;
    border-right: 1px solid #D7E5F3;
    border-bottom: 1px solid #CFDEED;
    background: #EAF4FF;
    color: #2E5278;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .05em;
    text-transform: uppercase;
    white-space: nowrap;
}

.sp-table thead th:last-child,
.sp-table tbody td:last-child {
    border-right: 0;
}

.sp-table tbody td {
    padding: 14px 16px;
    border-right: 1px solid #E0E9F3;
    border-bottom: 1px solid #E0E9F3;
    color: #405268;
    vertical-align: middle;
    font-size: 12px;
    line-height: 1.7;
}

.sp-table tbody tr:last-child td {
    border-bottom: 0;
}

.sp-table tbody tr {
    animation: spRowEnter .3s ease both;
    transition: background .18s ease;
}

.sp-table tbody tr:nth-child(even) {
    background: #F9FBFE;
}

.sp-table tbody tr:hover {
    background: #EDF6FF;
}

/* NOMOR */

.sp-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 29px;
    height: 29px;
    padding: 0 7px;
    border: 1px solid #D5E5F6;
    border-radius: 8px;
    background: #EEF6FF;
    color: #356DA5;
    font-size: 11px;
    font-weight: 800;
}

/* NIS DAN NAMA */

.sp-nis {
    color: #283F58;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.sp-student-name {
    color: #283F58;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.6;
}

/* KELAS */

.sp-class-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 9px;
    border: 1px solid #C8DFF7;
    border-radius: 8px;
    background: #EDF6FF;
    color: #2C6399;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

/* JENIS KELAMIN */

.sp-gender {
    display: inline-flex;
    align-items: center;
    color: #344F6B;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

/* =====================================================
   STATUS AKUN
===================================================== */

.sp-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 800;
    line-height: 1.4;
    white-space: nowrap;
}

.sp-status-dot {
    width: 6px;
    height: 6px;
    flex-shrink: 0;
    border-radius: 50%;
    background: currentColor;
}

.sp-status-active {
    border-color: #B9E7CF;
    background: #EAF8F0;
    color: #18734B;
}

.sp-status-inactive {
    border-color: #F1C4C4;
    background: #FFF0F0;
    color: #B23535;
}

.sp-status-pending {
    border-color: #F2D89B;
    background: #FFF8E8;
    color: #95620D;
}

.sp-status-neutral {
    border-color: #D5E1ED;
    background: #F3F6FA;
    color: #526982;
}

/* =====================================================
   AKSI TABEL
===================================================== */

.sp-actions {
    display: flex;
    width: 155px;
    min-width: 155px;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
    gap: 7px;
    margin: 0 auto;
}

.sp-actions form {
    display: block;
    width: 100%;
    margin: 0;
}

.sp-action {
    display: flex;
    width: 100%;
    min-height: 44px;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 10px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-family: inherit;
    font-size: 10px;
    font-weight: 800;
    line-height: 1.4;
    text-align: center;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease,
        border-color .18s ease,
        color .18s ease;
}

.sp-action svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.sp-action:hover {
    transform: translateY(-1px);
}

.sp-action-edit {
    border-color: #C8DFF7;
    background: #EDF6FF;
    color: #2C6399;
}

.sp-action-edit:hover {
    background: #DBEEFF;
}

.sp-action-reset {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.sp-action-reset:hover {
    background: #E3F0FA;
}

/* TOMBOL NONAKTIFKAN */

.sp-action-disable {
    border-color: #F0C5C5;
    background: #FFF0F0;
    color: #B23535;
}

.sp-action-disable:hover {
    background: #FFE1E1;
}

/* TOMBOL HAPUS */

.sp-action-delete {
    border-color: #F1D1D5;
    background: #FFF0F1;
    color: #A93649;
}

.sp-action-delete:hover {
    color: #FFFFFF;
    background: #C9475D;
    border-color: #C9475D;
}

.sp-action-delete svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.sp-action-enable {
    border-color: #B9E7CF;
    background: #EAF8F0;
    color: #18734B;
}

.sp-action-enable:hover {
    background: #D7F6E5;
}

.sp-action-note {
    display: flex;
    width: 100%;
    min-height: 36px;
    align-items: center;
    justify-content: center;
    padding: 8px 10px;
    border: 1px dashed #D1DCE8;
    border-radius: 8px;
    background: #F7F9FC;
    color: #65758A;
    font-size: 10px;
    font-weight: 700;
    line-height: 1.5;
    text-align: center;
}

/* LEBAR KOLOM AKSI */

.sp-table thead th:last-child {
    width: 190px;
    text-align: center;
}

.sp-table tbody td:last-child {
    min-width: 190px;
    vertical-align: middle;
}

/* DATA KOSONG */

.sp-empty {
    padding: 50px 20px !important;
    text-align: center;
}

.sp-empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    border-radius: 13px;
}

.sp-empty-icon svg {
    width: 27px;
    height: 27px;
}

.sp-empty-title {
    color: #344F6B;
    font-size: 14px;
    font-weight: 800;
}

.sp-empty-description {
    margin-top: 5px;
    color: #8192A5;
    font-size: 11px;
    line-height: 1.7;
}

/* =====================================================
   PAGINATION
   HANYA TOMBOL SEBELUMNYA DAN SELANJUTNYA
===================================================== */

.sp-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 16px 20px;
    border-top: 1px solid #D5E1ED;
    background: #FFFFFF;
}

.sp-pagination-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
}

.sp-page-link {
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
    transition:
        background .18s ease,
        border-color .18s ease;
}

.sp-page-link:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
}

.sp-page-link-disabled {
    border-color: #E0E7EF;
    background: #F4F7FA;
    color: #9AA9B9;
    cursor: not-allowed;
}

/* FOOTER */

.sp-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.sp-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .siswa-page {
    --sp-text: #E4ECF6;
    --sp-muted: #AABBD0;
    --sp-border: #354A62;
    color: var(--sp-text);
}

.dark .sp-hero {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .sp-hero-label {
    color: #C6E1FF;
}

.dark .sp-hero-title {
    color: #F1F6FC;
}

.dark .sp-hero-description {
    color: #C2D0E0;
}

.dark .sp-hero-icon,
.dark .sp-section-icon,
.dark .sp-empty-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .sp-button-primary {
    border-color: #557FAF;
    background: #3478BD;
}

.dark .sp-button-primary:hover {
    background: #285F96;
}

.dark .sp-button-secondary,
.dark .sp-reset-button {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .sp-button-secondary:hover,
.dark .sp-reset-button:hover {
    background: #2F4865;
}

.dark .sp-panel {
    border-color: #354962;
    background: #1C2C42;
    box-shadow: none;
}

.dark .sp-panel-title {
    color: #EAF3FF;
}

.dark .sp-panel-description {
    color: #AABBD0;
}

/* DARK MODE INPUT */

.dark .sp-search-input,
.dark .sp-filter-select {
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .sp-search-input::placeholder {
    color: #93A6BD;
}

.dark .sp-search-input:focus,
.dark .sp-filter-select:focus {
    border-color: #5799DC;
    background-color: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.dark .sp-search-icon {
    color: #AABBD0;
}

/* DROPDOWN KELAS DARK MODE */

.dark .siswa-page select.sp-filter-select {
    color-scheme: dark;
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .siswa-page select.sp-filter-select option {
    background-color: #192438;
    color: #E8F0FB;
}

.dark .siswa-page select.sp-filter-select option:checked {
    background-color: #263E59;
    color: #FFFFFF;
}

/* DARK MODE RINGKASAN */

.dark .sp-filter-summary,
.dark .sp-import-info {
    border-color: #364B65;
    background: rgba(17, 28, 46, .65);
    color: #C6D5E7;
}

/* DARK MODE RIWAYAT */

.dark .sp-suggestion-box {
    border-color: #354A62;
    background: #192438;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
}

.dark .sp-suggestion-heading {
    border-color: #354A62;
    background: #203149;
    color: #AFC0D4;
}

.dark .sp-suggestion-item {
    border-color: #34465F;
    background: #192438;
    color: #E1EAF5;
}

.dark .sp-suggestion-item:hover,
.dark .sp-suggestion-item:focus-visible {
    background: #263E59;
    color: #FFFFFF;
}

.dark .sp-suggestion-item svg {
    color: #AFCBEA;
}

/* DARK MODE IMPORT */

.dark .sp-import-step {
    border-color: #354A62;
    background: #192438;
}

.dark .sp-step-title {
    color: #E4ECF6;
}

.dark .sp-step-number {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .sp-file-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E2EAF4;
}

.dark .sp-file-input::file-selector-button {
    background: #263E59;
    color: #C6E1FF;
}

.dark .sp-import-button {
    border-color: #557FAF;
    background: #3478BD;
}

.dark .sp-import-note {
    border-color: #354A62;
    color: #AABBD0;
}

.dark .sp-import-error {
    border-color: #40536B;
    background: #192438;
}

/* DARK MODE PASSWORD */

.dark .sp-password-box {
    border-color: #3B5878;
    background: linear-gradient(115deg, #1C3049, #243E59);
}

.dark .sp-password-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .sp-copy-button {
    border-color: #557FAF;
    background: #3478BD;
}

/* DARK MODE TABEL */

.dark .sp-table-shell {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .sp-table-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .sp-total {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .sp-table thead th {
    border-color: #3A5068;
    background: #263E59;
    color: #D5E5F8;
}

.dark .sp-table tbody td {
    border-color: #354962;
    color: #C7D4E4;
}

.dark .sp-table tbody tr:nth-child(even) {
    background: #1C2C42;
}

.dark .sp-table tbody tr:hover {
    background: #263E59;
}

.dark .sp-number,
.dark .sp-class-badge {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .sp-nis,
.dark .sp-student-name {
    color: #EAF3FF;
}

.dark .sp-gender {
    color: #EAF3FF;
}

/* DARK MODE STATUS */

.dark .sp-status-active,
.dark .sp-action-enable {
    border-color: #32634D;
    background: #193A2E;
    color: #A7E8C3;
}

.dark .sp-status-inactive,
.dark .sp-action-disable {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .sp-status-pending {
    border-color: #70592E;
    background: #3B311E;
    color: #FFDC91;
}

.dark .sp-status-neutral,
.dark .sp-action-note {
    border-color: #405168;
    background: #263549;
    color: #C3D0DF;
}

/* DARK MODE AKSI */

.dark .sp-action-edit {
    border-color: #3A5D80;
    background: #203B55;
    color: #B9DCFF;
}

.dark .sp-action-edit:hover {
    background: #294A69;
}

.dark .sp-action-reset {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .sp-action-reset:hover {
    background: #2F4865;
}

.dark .sp-action-disable:hover {
    background: #482A30;
}

/* DARK MODE HAPUS */

.dark .sp-action-delete {
    color: #FFC5CD;
    background: #432A35;
    border-color: #65404B;
}

.dark .sp-action-delete:hover {
    color: #FFFFFF;
    background: #B83B52;
    border-color: #B83B52;
}

.dark .sp-action-enable:hover {
    background: #214B38;
}

.dark .sp-empty-title {
    color: #E4EFFC;
}

.dark .sp-empty-description,
.dark .sp-footer {
    color: #AABBD0;
}

/* DARK MODE PAGINATION */

.dark .sp-pagination {
    border-color: #354962;
    background: #192438;
}

.dark .sp-page-link {
    border-color: #405773;
    background: #24364D;
    color: #D5E5F8;
}

.dark .sp-page-link:hover {
    background: #2F4865;
}

.dark .sp-page-link-disabled {
    border-color: #35465D;
    background: #1D2B3E;
    color: #71849A;
}

/* RESPONSIVE */

@media (max-width: 900px) {
    .sp-filter-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 13px;
    }

    .sp-search-wrapper,
    .sp-filter-actions {
        grid-column: 1 / -1;
    }

    .sp-filter-actions {
        display: flex;
        justify-content: flex-end;
    }
}

@media (max-width: 640px) {
    .sp-hero {
        border-radius: 14px;
    }

    .sp-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .sp-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .sp-panel-body {
        padding: 16px;
    }

    .sp-table-header {
        padding: 16px;
    }

    .sp-button,
    .sp-search-button,
    .sp-reset-button {
        width: 100%;
    }

    .sp-filter-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .sp-search-wrapper,
    .sp-filter-actions {
        grid-column: auto;
    }

    .sp-filter-actions {
        justify-content: flex-start;
    }

    .sp-filter-actions .sp-search-button,
    .sp-filter-actions .sp-reset-button {
        flex: 1;
    }

    .sp-pagination {
        padding: 16px;
    }

    .sp-pagination-actions {
        width: 100%;
        justify-content: flex-end;
    }

    .sp-page-link {
        flex: 0 0 auto;
    }
}

@media (prefers-reduced-motion: reduce) {
    .siswa-page *,
    .siswa-page *::before,
    .siswa-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="siswa-page space-y-6">

    {{-- HEADER UTAMA --}}
    <section class="sp-hero sp-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="sp-hero-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                        <circle cx="10" cy="7" r="4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="sp-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="sp-hero-title text-xl font-extrabold sm:text-2xl">
                        Data Siswa
                    </h2>

                    <p class="sp-hero-description mt-2 text-sm leading-relaxed">
                        Kelola identitas siswa, kelas, jenis kelamin,
                        dan akses akun login siswa.
                    </p>

                </div>

            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:flex-shrink-0">

                <a
                    href="{{ route('admin.siswa.export', request()->only(['search', 'kelas'])) }}"
                    class="sp-button sp-button-secondary"
                >

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 3v12m0 0-4-4m4 4 4-4M4 17v3h16v-3"/>

                    </svg>

                    Export Excel

                </a>

                <a
                    href="{{ route('admin.siswa.create') }}"
                    class="sp-button sp-button-primary"
                >

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 5v14M5 12h14"/>

                    </svg>

                    Tambah Siswa

                </a>

            </div>

        </div>

    </section>


    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))

        <div
            class="sp-alert border border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300"
            role="status"
        >

            <div class="sp-alert-icon text-emerald-700 dark:text-emerald-300">
                ✓
            </div>

            <div class="min-w-0 flex-1">

                <p class="font-extrabold">
                    Berhasil
                </p>

                <p class="mt-1">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))

        <div
            class="sp-alert border border-red-200 bg-red-50 text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300"
            role="alert"
        >

            <div class="sp-alert-icon text-red-700 dark:text-red-300">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="font-extrabold">
                    Terjadi Kesalahan
                </p>

                <p class="mt-1">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- VALIDASI --}}
    @if($errors->any())

        <div
            class="sp-alert border border-red-200 bg-red-50 text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300"
            role="alert"
        >

            <div class="sp-alert-icon text-red-700 dark:text-red-300">
                !
            </div>

            <div>

                <p class="mb-2 font-extrabold">
                    Terjadi Kesalahan
                </p>

                <ul class="space-y-1">

                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- HASIL RESET PASSWORD --}}
    @if(session('reset_password_result'))

        @php
            $hasilReset = session('reset_password_result');
        @endphp

        <section class="sp-password-box sp-enter p-5 sm:p-6">

            <div class="flex items-start gap-4">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-white text-blue-700 dark:border-blue-500/30 dark:bg-slate-800 dark:text-blue-300">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 11V7a4 4 0 0 0-8 0v4m-2 0h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2Zm6 4v2"/>

                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <p class="text-xs font-extrabold uppercase tracking-widest text-blue-700 dark:text-blue-300">
                        Informasi Akun
                    </p>

                    <h3 class="mt-1 text-lg font-extrabold text-blue-950 dark:text-blue-100">
                        Password Siswa Berhasil Direset
                    </h3>

                    <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">
                        Berikan password sementara ini kepada siswa yang bersangkutan.
                    </p>


                    <div class="mt-4 rounded-xl border border-blue-200 bg-white p-4 dark:border-blue-500/30 dark:bg-slate-900">

                        <div class="grid gap-4 sm:grid-cols-2">

                            <div>

                                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Nama Siswa
                                </p>

                                <p class="mt-1 font-extrabold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nama'] ?? '-' }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    NIS
                                </p>

                                <p class="mt-1 font-extrabold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nis'] ?? '-' }}
                                </p>

                            </div>

                        </div>


                        <div class="mt-5">

                            <label
                                for="passwordSementaraSiswa"
                                class="mb-2 block text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400"
                            >
                                Password Sementara
                            </label>

                            <div class="flex flex-col gap-3 sm:flex-row">

                                <input
                                    id="passwordSementaraSiswa"
                                    type="text"
                                    readonly
                                    value="{{ $hasilReset['password'] ?? '' }}"
                                    onclick="this.select()"
                                    class="sp-password-input"
                                >

                                <button
                                    type="button"
                                    onclick="salinPasswordSiswa()"
                                    class="sp-copy-button"
                                >
                                    Salin Password
                                </button>

                            </div>


                            <p
                                id="statusSalinPasswordSiswa"
                                class="mt-3 text-xs font-bold text-slate-500 dark:text-slate-400"
                                aria-live="polite"
                            >
                                Simpan password ini sebelum meninggalkan halaman.
                            </p>

                        </div>


                        <div class="mt-4 rounded-lg border border-blue-100 bg-blue-50 p-3 text-sm leading-6 text-blue-900 dark:border-blue-500/20 dark:bg-blue-500/10 dark:text-blue-200">
                            Siswa harus mengganti password setelah berhasil login.
                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- IMPORT DATA SISWA --}}
    <section class="sp-panel sp-enter">

        <div class="sp-panel-body">

            <div class="mb-5 flex items-center gap-3">

                <div class="sp-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 16V4m0 0L7 9m5-5 5 5M5 15v4a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-4"/>

                    </svg>

                </div>

                <div>

                    <h3 class="sp-panel-title">
                        Import Data Siswa dari Excel
                    </h3>

                    <p class="sp-panel-description">
                        Tambahkan banyak data siswa sekaligus tanpa mengisi formulir satu per satu.
                    </p>

                </div>

            </div>


            {{-- PETUNJUK IMPORT --}}
            <div class="sp-import-info p-4 sm:p-5">

                <div class="flex items-center gap-2 text-xs font-extrabold text-blue-800 dark:text-blue-200">

                    <svg class="h-4 w-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01"/>

                    </svg>

                    Petunjuk sebelum import

                </div>

                <ul class="mt-2 list-disc pl-5 text-xs leading-7">

                    <li>Download template Excel terlebih dahulu.</li>
                    <li>Isi kolom sesuai format template.</li>
                    <li>Pastikan NIS terisi dan belum terdaftar.</li>
                    <li>Nama kelas harus sesuai dengan data di menu Data Kelas.</li>
                    <li>Jangan mengubah nama kolom pada template.</li>
                    <li>Format yang didukung: XLSX, XLS, atau CSV, maksimal 5 MB.</li>

                </ul>

            </div>


            <div class="mt-4 grid gap-4 lg:grid-cols-2">

                {{-- DOWNLOAD TEMPLATE --}}
                <div class="sp-import-step">

                    <p class="sp-step-title">

                        <span class="sp-step-number">
                            1
                        </span>

                        Download template

                    </p>

                    <p class="mb-4 mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Gunakan format kolom yang telah disediakan.
                    </p>

                    <a
                        href="{{ route('admin.siswa.template') }}"
                        class="sp-button sp-button-primary w-full sm:w-auto"
                    >

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 3v12m0 0-4-4m4 4 4-4M4 17v3h16v-3"/>

                        </svg>

                        Download Template Excel

                    </a>

                </div>


                {{-- UPLOAD FILE --}}
                <div class="sp-import-step">

                    <p class="sp-step-title">

                        <span class="sp-step-number">
                            2
                        </span>

                        Upload file Excel

                    </p>

                    <p class="mb-4 mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Pilih file yang sudah diisi sesuai template.
                    </p>

                    <form
                        action="{{ route('admin.siswa.import') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        onsubmit="return confirm('Yakin ingin mengimport data siswa dari file ini?')"
                    >

                        @csrf

                        <input
                            type="file"
                            id="file_excel"
                            name="file"
                            accept=".xlsx,.xls,.csv"
                            required
                            class="sp-file-input"
                        >

                        @error('file')
                            <p class="mt-2 text-sm font-bold text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                        <button type="submit" class="sp-import-button mt-3 w-full sm:w-auto">

                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24"
                                 aria-hidden="true">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 4v12m0 0-4-4m4 4 4-4M5 20h14"/>

                            </svg>

                            Import Data Siswa

                        </button>

                    </form>

                </div>

            </div>


            <p class="sp-import-note">
                Catatan: NIS yang sudah terdaftar akan dilewati. Periksa data dan nama kelas sebelum mengunggah file.
            </p>

        </div>

    </section>


    {{-- LAPORAN IMPORT --}}
    @if(session('import_errors'))

        <section class="sp-table-shell">

            <div class="p-5 sm:p-6">

                <div class="flex items-start gap-3">

                    <div class="sp-section-icon">

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>

                        </svg>

                    </div>

                    <div class="min-w-0 flex-1">

                        <h3 class="text-sm font-extrabold text-slate-800 dark:text-slate-100">
                            Periksa Data yang Belum Berhasil Diimport
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                            Sebagian data mungkin dilewati karena NIS sudah terdaftar atau datanya tidak sesuai.
                        </p>


                        <div class="mt-4 space-y-3">

                            @foreach(session('import_errors') as $error)

                                <div class="sp-import-error dark:border-slate-700 dark:bg-slate-900">

                                    @if(is_array($error))

                                        <p class="font-extrabold text-slate-800 dark:text-white">
                                            Baris {{ $error['baris'] ?? '-' }}
                                        </p>

                                        <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                            {{ $error['pesan'] ?? json_encode($error) }}
                                        </p>

                                    @else

                                        <p class="text-sm leading-6 text-slate-600 dark:text-slate-300">
                                            {{ $error }}
                                        </p>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- PENCARIAN DAN FILTER --}}
    @php
        $search = trim(request('search', ''));
        $kelasTerpilih = trim(request('kelas', ''));

        $adaFilter = $search !== '' || $kelasTerpilih !== '';
    @endphp


    <section class="sp-panel sp-enter sp-delay">

        <div class="sp-panel-body">

            <div class="mb-4 flex items-center gap-3">

                <div class="sp-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16 16 5 5"/>

                    </svg>

                </div>

                <div>

                    <h3 class="sp-panel-title">
                        Cari dan Filter Siswa
                    </h3>

                    <p class="sp-panel-description">
                        Cari berdasarkan nama, NIS, atau tampilkan siswa dari kelas tertentu.
                    </p>

                </div>

            </div>


            {{-- FORM PENCARIAN --}}
            <form
                id="siswaSearchForm"
                action="{{ route('admin.siswa.index') }}"
                method="GET"
                autocomplete="off"
                class="flex flex-col gap-3 sm:flex-row"
            >

                {{-- PENCARIAN --}}
                <div class="sp-search-wrapper">

                    <span class="sp-search-icon">

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <circle cx="10.5" cy="10.5" r="6.5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16 16 5 5"/>

                        </svg>

                    </span>

                    <label for="searchSiswa" class="sr-only">
                        Cari siswa
                    </label>

                    <input
                        id="searchSiswa"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama siswa, NIS, atau kelas..."
                        class="sp-search-input"
                        autocomplete="off"
                        spellcheck="false"
                    >

                    <div
                        id="siswaSearchSuggestions"
                        class="sp-suggestion-box"
                        role="listbox"
                        aria-label="Riwayat pencarian siswa"
                        hidden
                    ></div>

                </div>


                {{-- FILTER KELAS --}}
                <div class="sm:w-56 sm:flex-shrink-0">

                    <label for="filterKelasSiswa" class="sr-only">
                        Filter kelas
                    </label>

                    <select
                        id="filterKelasSiswa"
                        name="kelas"
                        class="sp-filter-select"
                    >

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach($kelasList as $kelas)

                            <option
                                value="{{ $kelas->nama_kelas }}"
                                {{ mb_strtolower($kelasTerpilih) === mb_strtolower($kelas->nama_kelas) ? 'selected' : '' }}
                            >
                                {{ $kelas->nama_kelas }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- CARI --}}
                <button type="submit" class="sp-search-button">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16 16 5 5"/>

                    </svg>

                    Cari

                </button>


                {{-- RESET --}}
                @if($adaFilter)

                    <a
                        href="{{ route('admin.siswa.index') }}"
                        class="sp-reset-button"
                    >

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 4v5h5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5.5 9A7 7 0 0 1 18 6.5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M20 20v-5h-5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M18.5 15A7 7 0 0 1 6 17.5"/>

                        </svg>

                        Reset

                    </a>

                @endif

            </form>


            {{-- HASIL FILTER --}}
            @if($adaFilter)

                <div class="sp-filter-summary mt-5 p-3 text-xs leading-relaxed">

                    Menampilkan
                    <strong>{{ $siswaList->total() }}</strong>
                    siswa

                    @if($search !== '')
                        · Kata kunci <strong>{{ $search }}</strong>
                    @endif

                    @if($kelasTerpilih !== '')
                        · Kelas <strong>{{ $kelasTerpilih }}</strong>
                    @endif

                </div>

            @endif

        </div>

    </section>


    {{-- TABEL DATA SISWA --}}
    <section class="sp-table-shell sp-enter">

        {{-- HEADER TABEL --}}
        <div class="sp-table-header">

            <div class="flex items-center gap-3">

                <div class="sp-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                        <circle cx="10" cy="7" r="4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>

                    </svg>

                </div>

                <div>

                    <h3 class="sp-panel-title">
                        Daftar Siswa
                    </h3>

                    <p class="sp-panel-description">
                        Informasi identitas, kelas, jenis kelamin, dan status akun siswa.
                    </p>

                </div>

            </div>


            <div class="sp-total">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 5h16M4 12h16M4 19h16"/>

                </svg>

                {{ $siswaList->total() }} Siswa

            </div>

        </div>


        {{-- ISI TABEL --}}
        <div class="overflow-x-auto">

            <table class="sp-table">

                <thead>

                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Akun</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($siswaList as $index => $siswa)

                        @php
                            $statusAkun = mb_strtolower(trim($siswa->status_akun ?? 'tanpa akun'));

                            $akunAktif = $statusAkun === 'aktif';
                            $akunNonaktif = $statusAkun === 'nonaktif';
                            $akunSudahAktivasi = $akunAktif || $akunNonaktif;

                            $akunBelumAktivasi = in_array(
                                $statusAkun,
                                ['belum aktif', 'belum aktivasi', 'pending'],
                                true
                            );
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td>

                                <span class="sp-number">
                                    {{ $siswaList->firstItem() + $index }}
                                </span>

                            </td>


                            {{-- NIS --}}
                            <td>

                                <span class="sp-nis">
                                    {{ $siswa->nis ?: '-' }}
                                </span>

                            </td>


                            {{-- NAMA SISWA --}}
                            <td>

                                <div class="sp-student-name">
                                    {{ $siswa->nama_siswa }}
                                </div>

                            </td>


                            {{-- KELAS --}}
                            <td>

                                @if($siswa->kelas)

                                    <span class="sp-class-badge">
                                        {{ $siswa->kelas }}
                                    </span>

                                @else

                                    <span class="sp-status sp-status-neutral">
                                        Belum ada kelas
                                    </span>

                                @endif

                            </td>


                            {{-- JENIS KELAMIN --}}
                            <td>

                                @if($siswa->jenis_kelamin === 'L')

                                    <span class="sp-gender">
                                        Laki-laki
                                    </span>

                                @elseif($siswa->jenis_kelamin === 'P')

                                    <span class="sp-gender">
                                        Perempuan
                                    </span>

                                @else

                                    <span class="sp-gender">
                                        {{ $siswa->jenis_kelamin ?: '-' }}
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS AKUN --}}
                            <td>

                                @if($akunAktif)

                                    <span class="sp-status sp-status-active">
                                        <span class="sp-status-dot"></span>
                                        Aktif
                                    </span>

                                @elseif($akunNonaktif)

                                    <span class="sp-status sp-status-inactive">
                                        <span class="sp-status-dot"></span>
                                        Nonaktif
                                    </span>

                                @elseif($akunBelumAktivasi)

                                    <span class="sp-status sp-status-pending">
                                        <span class="sp-status-dot"></span>
                                        Belum Aktivasi
                                    </span>

                                @else

                                    <span class="sp-status sp-status-neutral">
                                        <span class="sp-status-dot"></span>
                                        Belum Ada Akun
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="sp-actions">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}"
                                        class="sp-action sp-action-edit"
                                    >

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="m15.232 5.232 3.536 3.536"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M4 20h4L18.768 9.232a2.5 2.5 0 0 0-3.536-3.536L4 16v4Z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- AKUN SUDAH AKTIVASI --}}
                                    @if($akunSudahAktivasi)

                                        {{-- RESET PASSWORD --}}
                                        <form
                                            action="{{ route('admin.siswa.resetPassword', $siswa->id_siswa) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin mereset password siswa ini?')"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="sp-action sp-action-reset"
                                            >

                                                <svg fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     viewBox="0 0 24 24"
                                                     aria-hidden="true">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M16 11V7a4 4 0 0 0-8 0v4m-2 0h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2Z"/>

                                                </svg>

                                                Reset Password

                                            </button>

                                        </form>


                                        {{-- AKTIFKAN / NONAKTIFKAN --}}
                                        <form
                                            action="{{ route('admin.siswa.toggleStatus', $siswa->id_siswa) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin {{ $akunAktif ? 'menonaktifkan' : 'mengaktifkan kembali' }} akun siswa ini?')"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="sp-action {{ $akunAktif ? 'sp-action-disable' : 'sp-action-enable' }}"
                                            >

                                                @if($akunAktif)

                                                    <svg fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="1.8"
                                                         viewBox="0 0 24 24"
                                                         aria-hidden="true">

                                                        <circle cx="12" cy="12" r="9"/>
                                                        <path stroke-linecap="round" d="M10 9v6m4-6v6"/>

                                                    </svg>

                                                    Nonaktifkan

                                                @else

                                                    <svg fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="1.8"
                                                         viewBox="0 0 24 24"
                                                         aria-hidden="true">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="m5 13 4 4L19 7"/>

                                                    </svg>

                                                    Aktifkan

                                                @endif

                                            </button>

                                        </form>


                                    {{-- AKUN BELUM AKTIVASI --}}
                                    @elseif($akunBelumAktivasi)

                                        <span class="sp-action-note">
                                            Belum Aktivasi
                                        </span>


                                    {{-- BELUM PUNYA AKUN --}}
                                    @else

                                        <span class="sp-action-note">
                                            Belum Ada Akun
                                        </span>

                                    @endif


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data siswa {{ addslashes($siswa->nama_siswa) }}? Jika siswa memiliki nilai atau rapor, penghapusan akan ditolak.')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="sp-action sp-action-delete"
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

                            <td colspan="7" class="sp-empty">

                                <div class="sp-empty-icon">

                                    <svg fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24"
                                         aria-hidden="true">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                                        <circle cx="10" cy="7" r="4"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>

                                    </svg>

                                </div>


                                <h3 class="sp-empty-title">

                                    @if($adaFilter)
                                        Data Siswa Tidak Ditemukan
                                    @else
                                        Belum Ada Data Siswa
                                    @endif

                                </h3>


                                <p class="sp-empty-description">

                                    @if($adaFilter)
                                        Coba ubah kata kunci atau pilihan filter untuk menemukan data.
                                    @else
                                        Tambahkan data siswa untuk mulai mengelola data akademik.
                                    @endif

                                </p>


                                @if(!$adaFilter)

                                    <a
                                        href="{{ route('admin.siswa.create') }}"
                                        class="sp-button sp-button-primary mt-5"
                                    >

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="2"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 5v14M5 12h14"/>

                                        </svg>

                                        Tambah Siswa

                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION DATA SISWA --}}
        @if($siswaList->hasPages())

            <div class="sp-pagination">

                <div class="sp-pagination-actions">

                    {{-- SEBELUMNYA --}}
                    @if($siswaList->onFirstPage())

                        <span class="sp-page-link sp-page-link-disabled">
                            ← Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ $siswaList->previousPageUrl() }}"
                            class="sp-page-link"
                        >
                            ← Sebelumnya
                        </a>

                    @endif


                    {{-- SELANJUTNYA --}}
                    @if($siswaList->hasMorePages())

                        <a
                            href="{{ $siswaList->nextPageUrl() }}"
                            class="sp-page-link"
                        >
                            Selanjutnya →
                        </a>

                    @else

                        <span class="sp-page-link sp-page-link-disabled">
                            Selanjutnya →
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </section>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="sp-footer-line"></div>

        <p class="sp-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection


{{-- =====================================================
     JAVASCRIPT
===================================================== --}}

@push('scripts')
<script>
/* =====================================================
   SALIN PASSWORD SISWA
===================================================== */

async function salinPasswordSiswa() {

    const field = document.getElementById('passwordSementaraSiswa');
    const status = document.getElementById('statusSalinPasswordSiswa');

    if (!field || !status) {
        return;
    }

    try {

        if (navigator.clipboard && window.isSecureContext) {

            await navigator.clipboard.writeText(field.value);

        } else {

            field.focus();
            field.select();
            field.setSelectionRange(0, field.value.length);

            const berhasil = document.execCommand('copy');

            if (!berhasil) {
                throw new Error('Penyalinan otomatis gagal');
            }

        }

        status.textContent = 'Password berhasil disalin!';
        status.className = 'mt-3 text-xs font-bold text-emerald-600 dark:text-emerald-400';

    } catch (error) {

        field.focus();
        field.select();

        status.textContent = 'Password sudah dipilih. Tekan Ctrl+C untuk menyalin.';
        status.className = 'mt-3 text-xs font-bold text-amber-600 dark:text-amber-400';

    }

}


/* =====================================================
   RIWAYAT PENCARIAN SISWA
===================================================== */

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('siswaSearchForm');
    const input = document.getElementById('searchSiswa');
    const dropdown = document.getElementById('siswaSearchSuggestions');

    if (!form || !input || !dropdown) {
        return;
    }

    const STORAGE_KEY = 'eduvia_siswa_search_history';
    const MAX_HISTORY = 6;


    function getHistory() {

        try {

            const history = JSON.parse(
                localStorage.getItem(STORAGE_KEY) || '[]'
            );

            if (!Array.isArray(history)) {
                return [];
            }

            return history
                .filter(item => typeof item === 'string')
                .filter(item => item.trim() !== '');

        } catch (error) {

            return [];

        }

    }


    function saveHistory(value) {

        const keyword = value.trim();

        if (!keyword) {
            return;
        }

        const history = getHistory().filter(function (item) {

            return item.toLowerCase() !== keyword.toLowerCase();

        });

        history.unshift(keyword);

        try {

            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(history.slice(0, MAX_HISTORY))
            );

        } catch (error) {

            // Pencarian tetap berjalan jika localStorage tidak tersedia.

        }

    }


    function createHistoryIcon() {

        const svg = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'svg'
        );

        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('stroke-width', '1.8');
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('aria-hidden', 'true');

        const circle = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'circle'
        );

        circle.setAttribute('cx', '12');
        circle.setAttribute('cy', '12');
        circle.setAttribute('r', '9');

        const path = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'path'
        );

        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('d', 'M12 7v5l3 2');

        svg.appendChild(circle);
        svg.appendChild(path);

        return svg;

    }


    function hideSuggestions() {

        dropdown.hidden = true;
        dropdown.replaceChildren();

    }


    function renderSuggestions() {

        const keyword = input.value.trim().toLowerCase();
        const history = getHistory();

        const filtered = history
            .filter(function (item) {
                return item.toLowerCase().includes(keyword);
            })
            .slice(0, MAX_HISTORY);

        dropdown.replaceChildren();

        if (filtered.length === 0) {

            hideSuggestions();

            return;

        }


        const heading = document.createElement('div');

        heading.className = 'sp-suggestion-heading';

        heading.textContent = keyword
            ? 'Riwayat yang cocok'
            : 'Riwayat pencarian sebelumnya';

        dropdown.appendChild(heading);


        filtered.forEach(function (item) {

            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'sp-suggestion-item';
            button.setAttribute('role', 'option');

            const icon = createHistoryIcon();

            const text = document.createElement('span');

            text.textContent = item;

            button.appendChild(icon);
            button.appendChild(text);

            button.addEventListener('mousedown', function (event) {
                event.preventDefault();
            });

            button.addEventListener('click', function () {

                input.value = item;

                hideSuggestions();

                saveHistory(item);

                form.requestSubmit();

            });

            dropdown.appendChild(button);

        });


        dropdown.hidden = false;

    }


    input.addEventListener('focus', renderSuggestions);

    input.addEventListener('input', renderSuggestions);


    input.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            hideSuggestions();
        }

    });


    form.addEventListener('submit', function () {

        saveHistory(input.value);

    });


    document.addEventListener('click', function (event) {

        if (!form.contains(event.target)) {
            hideSuggestions();
        }

    });

});
</script>
@endpush