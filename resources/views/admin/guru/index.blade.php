@extends('layouts.admin')

@section('title', 'Data Guru - Sistem Akademik Mini')
@section('page-title', 'Data Guru')
@section('page-subtitle', 'Kelola data guru dan kelas yang diajar')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA GURU
   Pastel Blue + Dark Navy
===================================================== */

.guru-page {
    --guru-blue: #3478BD;
    --guru-blue-dark: #285F96;
    --guru-pale: #E3F0FA;
    --guru-text: #293F57;
    --guru-muted: #526982;
    --guru-border: #D5E1ED;
    --guru-card: #FFFFFF;

    color: var(--guru-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.dark .guru-page {
    --guru-text: #E4ECF6;
    --guru-muted: #AABBD0;
    --guru-border: #354A62;
    --guru-card: #192438;
}

.guru-page *,
.guru-page *::before,
.guru-page *::after {
    box-sizing: border-box;
}

/* =====================================================
   ANIMASI
===================================================== */

.guru-enter {
    animation: guruEnter .35s ease-out both;
}

.guru-delay-1 {
    animation-delay: .06s;
}

.guru-delay-2 {
    animation-delay: .12s;
}

@keyframes guruEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =====================================================
   HEADER UTAMA
===================================================== */

.guru-hero {
    position: relative;
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

.guru-hero::before,
.guru-hero::after {
    display: none !important;
    content: none !important;
}

.guru-hero-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    color: #285F96;
    background: #FFFFFF;
}

.guru-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.guru-hero-title {
    color: #214A77;
}

.guru-hero-description {
    color: #4D6886;
}

.dark .guru-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .guru-hero-label {
    color: #C6E1FF;
}

.dark .guru-hero-title {
    color: #F1F6FC;
}

.dark .guru-hero-description {
    color: #C2D0E0;
}

.dark .guru-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

/* =====================================================
   TOMBOL
===================================================== */

.guru-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
    text-align: center;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background .18s ease,
        border-color .18s ease,
        color .18s ease;
}

.guru-btn:hover {
    transform: translateY(-1px);
}

.guru-btn:active {
    transform: translateY(0);
}

.guru-btn:focus-visible,
.guru-page button:focus-visible,
.guru-page a:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.guru-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.guru-btn-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.guru-btn-export {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.guru-btn-export:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

.dark .guru-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .guru-btn-primary:hover {
    background: #285F96;
}

.dark .guru-btn-export {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .guru-btn-export:hover {
    color: #FFFFFF;
    background: #2F4865;
}

/* =====================================================
   NOTIFIKASI
===================================================== */

.guru-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.6;
    animation: guruEnter .3s ease both;
}

.guru-alert-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 9px;
}

/* =====================================================
   PANEL UMUM
===================================================== */

.guru-panel {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .guru-panel {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.guru-panel-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 22px;
    border-bottom: 1px solid #D4E3F2;
    background: #F5F9FE;
}

.dark .guru-panel-heading {
    border-color: #354962;
    background: #1C2C42;
}

.guru-panel-heading h3 {
    color: #214A77;
}

.dark .guru-panel-heading h3 {
    color: #F1F6FC;
}

.guru-panel-description {
    color: #71849A;
}

.dark .guru-panel-description {
    color: #AABBD0;
}

.guru-panel-body {
    padding: 22px;
}/* =====================================================
   IKON BAGIAN
===================================================== */

.guru-section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    color: #3478BD;
    background: #E3F0FA;
}

.guru-section-icon svg {
    width: 20px;
    height: 20px;
}

.dark .guru-section-icon {
    color: #C6E1FF;
    background: #263E59;
    border-color: #405773;
}

/* =====================================================
   PANEL PENCARIAN
===================================================== */

.guru-search-panel {
    position: relative;
    overflow: visible;
    border: 1px solid #BDD6EE;
    border-radius: 17px;
    background: linear-gradient(
        115deg,
        #C3E0F4 0%,
        #E3F0FA 55%,
        #F8FAFC 100%
    );
    box-shadow: 0 4px 12px rgba(47, 93, 145, .06);
}

.dark .guru-search-panel {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.guru-search-panel h3 {
    color: #214A77;
}

.dark .guru-search-panel h3 {
    color: #F1F6FC;
}

.guru-search-description {
    color: #526982;
}

.dark .guru-search-description {
    color: #C2D0E0;
}

/* INPUT PENCARIAN */

.guru-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    outline: none;
    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.guru-input::placeholder {
    color: #8495A8;
}

.guru-input:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.dark .guru-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .guru-input::placeholder {
    color: #93A6BD;
}

.dark .guru-input:focus {
    border-color: #5799DC;
    background: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* TOMBOL PENCARIAN */

.guru-search-button {
    display: inline-flex;
    min-height: 44px;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 17px;
    border: 1px solid #3478BD;
    border-radius: 9px;
    background: #3478BD;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
}

.guru-search-button:hover {
    transform: translateY(-1px);
    background: #285F96;
}

.guru-reset-button {
    display: inline-flex;
    min-height: 44px;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 15px;
    border: 1px solid #C8DCEE;
    border-radius: 9px;
    background: #FFFFFF;
    color: #365773;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: background .2s ease, transform .2s ease;
}

.guru-reset-button:hover {
    background: #E3F0FA;
    border-color: #A4BFDF;
    color: #285F96;
    transform: translateY(-1px);
}

.dark .guru-reset-button {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .guru-reset-button:hover {
    border-color: #58789D;
    background: #2F4865;
    color: #FFFFFF;
}

/* =====================================================
   INFORMASI IMPORT
===================================================== */

.guru-info-box {
    padding: 16px;
    border: 1px solid #C9DDF2;
    border-radius: 11px;
    background: #F0F7FD;
    color: #2D5C8B;
}

.dark .guru-info-box {
    border-color: #365A7B;
    background: #203C57;
    color: #C8E3FF;
}

.guru-warning-box {
    padding: 18px;
    border: 1px solid #F3D89A;
    border-radius: 12px;
    background: #FFFAF0;
    color: #865C11;
}

.dark .guru-warning-box {
    border-color: #765B2D;
    background: #3B3120;
    color: #F8D99A;
}

.guru-import-step {
    padding: 16px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F8FAFC;
}

.dark .guru-import-step {
    border-color: #344B63;
    background: #1B2B3E;
}

.guru-step-title {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #344F6B;
    font-size: 13px;
    font-weight: 800;
}

.dark .guru-step-title {
    color: #D7E4F3;
}

.guru-step-number {
    display: inline-flex;
    width: 27px;
    height: 27px;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F98;
    font-size: 12px;
    font-weight: 900;
}

.dark .guru-step-number {
    border-color: #3A5674;
    background: #263E59;
    color: #C6E1FF;
}

/* INPUT FILE */

.guru-file-input {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px dashed #A4BFDF;
    border-radius: 9px;
    background: #F8FBFF;
    color: #405268;
    font-size: 12px;
}

.guru-file-input::file-selector-button {
    margin-right: 10px;
    padding: 8px 11px;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F98;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
}

.guru-file-input::file-selector-button:hover {
    background: #C3E0F4;
}

.dark .guru-file-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .guru-file-input::file-selector-button {
    border-color: #3A5674;
    background: #263E59;
    color: #C6E1FF;
}

/* IMPORT ERROR */

.guru-import-error {
    border: 1px solid #F0DBA9;
    border-radius: 10px;
    background: #FFFFFF;
}

.dark .guru-import-error {
    border-color: #70592E;
    background: #202D3C;
}

/* =====================================================
   PASSWORD SEMENTARA
   HANYA WARNA YANG DIUBAH MENJADI BIRU EDUVIA
===================================================== */

.guru-password-box {
    padding: 20px;
    border: 1px solid #A4BFDF;
    border-radius: 14px;
    background: linear-gradient(135deg, #E3F0FA, #C3E0F4);
}

.dark .guru-password-box {
    border-color: #405B78;
    background: linear-gradient(135deg, #17283D, #243E59);
}

.guru-password-input {
    display: block;
    width: 100%;
    min-width: 0;
    padding: 12px 14px;
    border: 1px solid #C3D8EB;
    border-radius: 9px;
    background: #FFFFFF;
    color: #2E4054;
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 13px;
    font-weight: 800;
}

.dark .guru-password-input {
    border-color: #405B78;
    background: #1B2431;
    color: #F1F5F9;
}

.guru-copy-button {
    display: inline-flex;
    min-height: 43px;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 15px;
    border: 1px solid #3478BD;
    border-radius: 9px;
    background: #3478BD;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
}

.guru-copy-button:hover {
    transform: translateY(-1px);
    background: #285F96;
}/* =====================================================
   TABEL GURU
===================================================== */

.guru-table-shell {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .guru-table-shell {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.guru-table-top {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid #D4E3F2;
    background: #F5F9FE;
}

.dark .guru-table-top {
    border-color: #354962;
    background: #1C2C42;
}

.guru-table-top h3 {
    color: #214A77;
}

.dark .guru-table-top h3 {
    color: #F1F6FC;
}

.guru-table-description {
    color: #71849A;
}

.dark .guru-table-description {
    color: #AABBD0;
}

.guru-total {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 8px 11px;
    border: 1px solid #BDD8F2;
    border-radius: 9px;
    background: #E3F0FA;
    color: #285F98;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.dark .guru-total {
    border-color: #3A5776;
    background: #263E59;
    color: #C6E1FF;
}

.guru-table {
    width: 100%;
    min-width: 1450px;
    border-collapse: separate;
    border-spacing: 0;
    text-align: left;
    font-size: 12px;
}

.guru-table thead th {
    padding: 14px;
    border-right: 1px solid #D4E3F2;
    border-bottom: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #315579;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: .045em;
    text-transform: uppercase;
    white-space: nowrap;
}

.guru-table thead th:last-child {
    border-right: 0;
    text-align: center;
}

.guru-table tbody td {
    padding: 15px 14px;
    border-right: 1px solid #E0EAF4;
    border-bottom: 1px solid #E0EAF4;
    color: #405268;
    vertical-align: middle;
    line-height: 1.6;
}

.guru-table tbody td:last-child {
    border-right: 0;
}

.guru-table tbody tr:last-child td {
    border-bottom: 0;
}

.guru-table tbody tr {
    background: #FFFFFF;
    transition: background .18s ease;
}

.guru-table tbody tr:nth-child(even) {
    background: #F8FAFC;
}

.guru-table tbody tr:hover {
    background: #EDF5FE;
}

.dark .guru-table thead th {
    border-color: #3B506B;
    background: #263A53;
    color: #DDEBFC;
}

.dark .guru-table tbody td {
    border-color: #34465F;
    color: #C7D4E4;
}

.dark .guru-table tbody tr,
.dark .guru-table tbody tr:nth-child(even) {
    background: #192438;
}

.dark .guru-table tbody tr:hover {
    background: #24354C;
}

/* =====================================================
   NOMOR, IDENTITAS DAN KELAS
===================================================== */

.guru-number {
    display: inline-flex;
    min-width: 29px;
    height: 29px;
    align-items: center;
    justify-content: center;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F96;
    font-weight: 900;
}

.dark .guru-number {
    border-color: #3B5877;
    background: #203C5B;
    color: #C6E1FF;
}

.guru-name {
    color: #293F57;
    font-size: 13px;
    font-weight: 800;
}

.guru-nip {
    color: #293F57;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.dark .guru-name,
.dark .guru-nip {
    color: #F0F6FF;
}

.guru-class-list {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    max-width: 250px;
}

.guru-class-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 2px 3px 2px 0;
    padding: 5px 8px;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F98;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.4;
    white-space: nowrap;
}

.guru-class-tag-wali {
    border-color: #A4BFDF;
    background: #C3E0F4;
    color: #214A77;
}

.dark .guru-class-tag {
    border-color: #3B5877;
    background: #203C5B;
    color: #C6E1FF;
}

.dark .guru-class-tag-wali {
    border-color: #3B5877;
    background: #263E59;
    color: #C6E1FF;
}

/* =====================================================
   STATUS AKUN
===================================================== */

.guru-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 900;
    line-height: 1.4;
    white-space: nowrap;
}

.guru-status-dot {
    width: 6px;
    height: 6px;
    flex-shrink: 0;
    border-radius: 50%;
    background: currentColor;
}

.guru-status-active {
    border-color: #B9E7CF;
    background: #EAFAF1;
    color: #18734B;
}

.guru-status-inactive {
    border-color: #F1C4C4;
    background: #FFF0F0;
    color: #B23535;
}

.guru-status-pending {
    border-color: #F2D89B;
    background: #FFF8E8;
    color: #95620D;
}

.guru-status-neutral {
    border-color: #DBE3EC;
    background: #F1F5F9;
    color: #536477;
}

.dark .guru-status-active {
    border-color: #32634D;
    background: #183A2C;
    color: #9AE6BD;
}

.dark .guru-status-inactive {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .guru-status-pending {
    border-color: #70592E;
    background: #3B311E;
    color: #FFDC91;
}

.dark .guru-status-neutral {
    border-color: #405168;
    background: #263549;
    color: #C3D0DF;
}

/* =====================================================
   TOMBOL AKSI
===================================================== */

.guru-action {
    display: flex;
    width: 100%;
    min-height: 44px;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 8px 10px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.35;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease,
        border-color .18s ease,
        box-shadow .18s ease,
        color .18s ease;
}

.guru-action:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 7px rgba(39, 68, 99, .08);
}

.guru-action svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
}

.guru-action-edit {
    border-color: #C3D8EB;
    background: #E3F0FA;
    color: #285F98;
}

.guru-action-edit:hover {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.guru-action-reset {
    border-color: #C3D8EB;
    background: #F0F6FD;
    color: #285F98;
}

.guru-action-reset:hover {
    background: #DCEBFA;
}

.guru-action-disable {
    border-color: #F2C9C9;
    background: #FFF0F0;
    color: #B23535;
}

.guru-action-disable:hover {
    background: #FFE0E0;
}

.guru-action-delete {
    border-color: #F1D1D5;
    background: #FFF0F1;
    color: #A93649;
}

.guru-action-delete:hover {
    color: #FFFFFF;
    background: #C9475D;
    border-color: #C9475D;
}

.guru-action-enable {
    border-color: #B9E7CF;
    background: #EAFAF1;
    color: #18734B;
}

.guru-action-enable:hover {
    background: #D7F6E5;
}

.guru-action-note {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 34px;
    padding: 8px;
    border: 1px dashed #C9D9E9;
    border-radius: 8px;
    background: #F3F6FA;
    color: #526982;
    font-size: 10px;
    font-weight: 800;
    line-height: 1.5;
    text-align: center;
}

.dark .guru-action-edit,
.dark .guru-action-reset {
    border-color: #3A5674;
    background: #243D59;
    color: #C7E2FF;
}

.dark .guru-action-edit:hover,
.dark .guru-action-reset:hover {
    background: #2F4865;
    color: #FFFFFF;
}

.dark .guru-action-disable {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .guru-action-delete {
    color: #FFC5CD;
    background: #432A35;
    border-color: #65404B;
}

.dark .guru-action-delete:hover {
    color: #FFFFFF;
    background: #B83B52;
    border-color: #B83B52;
}

.dark .guru-action-enable {
    border-color: #32634D;
    background: #183A2C;
    color: #9AE6BD;
}

.dark .guru-action-note {
    border-color: #405168;
    background: #263549;
    color: #C3D0DF;
}

.guru-action-delete svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

/* =====================================================
   PASSWORD DAN INFORMASI
   WARNA DIUBAH MENJADI BIRU EDUVIA
===================================================== */

.guru-password-heading {
    color: #214A77;
}

.dark .guru-password-heading {
    color: #C6E1FF;
}

.guru-password-description {
    color: #365F89;
}

.dark .guru-password-description {
    color: #C6E1FF;
}/* =====================================================
   DATA KOSONG
===================================================== */

.guru-empty {
    padding: 55px 20px !important;
    text-align: center;
}

.guru-empty-icon {
    display: flex;
    width: 56px;
    height: 56px;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    border: 1px solid #C8DFF6;
    border-radius: 14px;
    background: #E3F0FA;
    color: #3478BD;
}

.dark .guru-empty-icon {
    border-color: #3D5876;
    background: #263C56;
    color: #C7E3FF;
}

/* =====================================================
   PAGINATION
===================================================== */

.guru-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px;
}

.guru-page-link {
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
    transition: background .2s ease, border-color .2s ease;
}

.guru-page-link:hover {
    border-color: #A4BFDF;
    background: #EAF4FF;
}

.guru-page-link-disabled {
    border-color: #E0E7EF;
    background: #F4F7FA;
    color: #9AA9B9;
    cursor: not-allowed;
}

/* DARK MODE PAGINATION */

.dark .guru-page-link {
    border-color: #405773;
    background: #24364D;
    color: #D5E5F8;
}

.dark .guru-page-link:hover {
    border-color: #58799F;
    background: #2F4865;
}

.dark .guru-page-link-disabled {
    border-color: #35465D;
    background: #1D2B3E;
    color: #71849A;
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 640px) {
    .guru-hero {
        border-radius: 14px;
    }

    .guru-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .guru-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .guru-panel-heading,
    .guru-table-top {
        padding: 16px;
    }

    .guru-panel-body {
        padding: 16px;
    }

    .guru-search-button,
    .guru-reset-button,
    .guru-btn {
        width: 100%;
    }

    .guru-password-box {
        padding: 16px;
    }

    .guru-copy-button {
        width: 100%;
    }

    .guru-pagination {
        justify-content: center;
        gap: 8px;
        padding: 16px;
    }

    .guru-page-link {
        padding: 8px 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .guru-page *,
    .guru-page *::before,
    .guru-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="guru-page space-y-6">

    {{-- =================================================
         HEADER UTAMA
    ================================================== --}}
    <section class="guru-hero guru-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="guru-hero-icon">

                    <svg class="w-7 h-7"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="guru-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="guru-hero-title text-xl font-extrabold sm:text-2xl">
                        Data Guru
                    </h2>

                    <p class="guru-hero-description mt-2 text-sm leading-relaxed">
                        Kelola data guru, mata pelajaran, kelas yang diajar,
                        status akun, dan tanggung jawab wali kelas.
                    </p>

                </div>

            </div>

            <div class="flex flex-col gap-3 sm:min-w-[165px]">

                {{-- EXPORT EXCEL --}}
                <a href="{{ route('admin.guru.export', request()->only('search')) }}"
                   class="guru-btn guru-btn-export">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v4h14v-4"/>
                    </svg>                    Export Excel

                </a>

                {{-- TAMBAH GURU --}}
                <a href="{{ route('admin.guru.create') }}"
                   class="guru-btn guru-btn-primary">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 5v14m7-7H5"/>
                    </svg>

                    Tambah Guru

                </a>

            </div>

        </div>

    </section>


    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))

        <div class="guru-alert border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-300"
             role="status">

            <div class="guru-alert-icon bg-emerald-100 text-emerald-700 dark:bg-emerald-900/60 dark:text-emerald-300">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m5 13 4 4L19 7"/>
                </svg>

            </div>

            <div class="pt-1">
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))

        <div class="guru-alert border-rose-200 bg-rose-50 text-rose-800 dark:border-rose-800 dark:bg-rose-950/30 dark:text-rose-300"
             role="alert">

            <div class="guru-alert-icon bg-rose-100 text-rose-700 dark:bg-rose-900/60 dark:text-rose-300">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8v4m0 4h.01"/>
                </svg>

            </div>

            <div class="pt-1">
                {{ session('error') }}
            </div>

        </div>

    @endif


    {{-- =================================================
         HASIL RESET PASSWORD
    ================================================== --}}
    @if(session('reset_password_result'))

        @php
            $hasilReset = session('reset_password_result');
        @endphp

        <div class="guru-password-box">

            <div class="flex items-start gap-4">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-white text-blue-700 dark:border-blue-700 dark:bg-slate-800 dark:text-blue-300">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <rect x="4" y="10" width="16" height="11" rx="2"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2"/>
                    </svg>

                </div>

                <div class="min-w-0 flex-1">

                    <div class="text-xs font-extrabold uppercase tracking-widest text-blue-700 dark:text-blue-300">
                        Informasi Akun
                    </div>

                    <h3 class="guru-password-heading mt-1 text-lg font-extrabold">
                        Password Guru Berhasil Direset
                    </h3>

                    <p class="guru-password-description mt-1 text-sm">
                        Berikan password sementara ini kepada guru yang bersangkutan.
                    </p>

                    <div class="mt-4 rounded-xl border border-blue-200 bg-white p-4 dark:border-blue-700 dark:bg-slate-900">

                        <div class="grid gap-4 sm:grid-cols-2">

                            <div>

                                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Nama Guru
                                </p>

                                <p class="mt-1 font-extrabold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nama'] ?? '-' }}
                                </p>

                            </div>

                            <div>

                                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    NIP
                                </p>

                                <p class="mt-1 font-extrabold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nip'] ?? '-' }}
                                </p>

                            </div>

                        </div>

                        <div class="mt-5">

                            <label for="passwordSementaraGuru"
                                   class="mb-2 block text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                Password Sementara
                            </label>

                            <div class="flex flex-col gap-3 sm:flex-row">

                                <input
                                    id="passwordSementaraGuru"
                                    type="text"
                                    readonly
                                    value="{{ $hasilReset['password'] ?? '' }}"
                                    class="guru-password-input"
                                >

                                <button
                                    type="button"
                                    onclick="salinPasswordGuru()"
                                    class="guru-copy-button"
                                >

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24"
                                         aria-hidden="true">
                                        <rect x="8" y="8" width="12" height="12" rx="2"/>
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M16 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h3"/>
                                    </svg>

                                    Salin Password

                                </button>

                            </div>

                            <p id="statusSalinPasswordGuru"
                               class="mt-3 text-xs font-bold text-slate-500 dark:text-slate-400"
                               aria-live="polite">
                                Simpan password ini sebelum meninggalkan halaman.
                            </p>

                        </div>

                        <div class="mt-4 rounded-lg border border-blue-200 bg-blue-50 p-3 text-sm leading-6 text-blue-900 dark:border-blue-700 dark:bg-blue-950/30 dark:text-blue-200">
                            Guru harus mengganti password setelah berhasil login jika sistem login sudah menerapkan kewajiban ganti password.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- =================================================
         IMPORT DATA GURU
    ================================================== --}}
    <section class="guru-panel guru-enter">

        <div class="guru-panel-heading">

            <div class="guru-section-icon">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14 2v6h6M8 13h8M8 17h8"/>
                </svg>

            </div>

            <div>

                <h3 class="text-base font-extrabold">
                    Import Data Guru dari Excel
                </h3>                <p class="guru-panel-description mt-1 text-xs leading-relaxed">
                    Tambahkan banyak data guru sekaligus tanpa mengisi formulir satu per satu.
                </p>

            </div>

        </div>


        <div class="guru-panel-body space-y-5">

            <div class="guru-info-box">

                <div class="flex items-center gap-2 font-extrabold">

                    <svg class="w-5 h-5 shrink-0"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 11v5m0-8h.01"/>
                    </svg>

                    Petunjuk sebelum import

                </div>

                <ul class="mt-3 list-inside list-disc space-y-2 text-sm leading-6">

                    <li>Download template Excel terlebih dahulu.</li>
                    <li>Isi kolom NIP, nama guru, mata pelajaran, dan kelas.</li>
                    <li>Nama kelas harus sama persis dengan data di menu Data Kelas.</li>
                    <li>Jika guru mengajar beberapa kelas, pisahkan nama kelas dengan koma.</li>
                    <li>NIP tidak boleh sama dengan NIP guru lain atau username akun yang sudah terdaftar.</li>
                    <li>Import hanya menambahkan data Guru. Guru dapat membuat akun sendiri melalui Register menggunakan NIP.</li>
                    <li>File yang didukung: XLSX, XLS, atau CSV, maksimal 5 MB.</li>

                </ul>

            </div>


            <div class="grid gap-4 lg:grid-cols-2">

                {{-- DOWNLOAD TEMPLATE --}}
                <div class="guru-import-step">

                    <p class="guru-step-title">

                        <span class="guru-step-number">
                            1
                        </span>

                        Download template

                    </p>

                    <p class="mt-3 mb-4 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Gunakan format kolom yang sudah disediakan agar data terbaca dengan benar.
                    </p>

                    <a
                        href="{{ route('admin.guru.template') }}"
                        class="guru-btn guru-btn-primary w-full sm:w-auto"
                    >

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v4h14v-4"/>
                        </svg>

                        Download Template Excel

                    </a>

                </div>


                {{-- UPLOAD FILE --}}
                <div class="guru-import-step">

                    <p class="guru-step-title">

                        <span class="guru-step-number">
                            2
                        </span>

                        Upload file Excel

                    </p>

                    <p class="mt-3 mb-4 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Pilih file yang sudah diisi sesuai template.
                    </p>

                    <form
                        action="{{ route('admin.guru.import') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        onsubmit="return confirm('Yakin ingin mengimport data guru dari file ini?')"
                    >

                        @csrf

                        <input
                            type="file"
                            name="file"
                            accept=".xlsx,.xls,.csv"
                            required
                            class="guru-file-input"
                        >

                        @error('file')
                            <p class="mt-2 text-sm font-bold text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                        <button type="submit"
                                class="guru-btn guru-btn-primary mt-3 w-full sm:w-auto">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24"
                                 aria-hidden="true">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 15V3m0 0L8 7m4-4 4 4M5 15v4h14v-4"/>
                            </svg>

                            Import Data Guru

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>


    {{-- =================================================
         LAPORAN BARIS GAGAL IMPORT
    ================================================== --}}
    @if(session('import_errors'))

        <section class="guru-warning-box">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-amber-200 bg-white text-amber-700 dark:border-amber-700 dark:bg-slate-800 dark:text-amber-300">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v4m0 4h.01M10.3 3.9 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/>
                    </svg>

                </div>

                <div class="min-w-0 flex-1">

                    <h3 class="font-extrabold">
                        Periksa Data yang Belum Berhasil Diimport
                    </h3>

                    <p class="mt-1 text-sm leading-6">
                        Sebagian baris mungkin dilewati karena data tidak lengkap, NIP sudah digunakan, atau nama kelas tidak ditemukan.
                    </p>

                    <div class="mt-4 space-y-3">

                        @foreach(session('import_errors') as $error)

                            <div class="guru-import-error p-4">

                                <p class="font-extrabold text-slate-800 dark:text-white">
                                    Baris {{ $error['baris'] ?? '-' }}
                                </p>

                                <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                    {{ $error['pesan'] ?? 'Data tidak dapat diimport.' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =================================================
         PENCARIAN DATA GURU
    ================================================== --}}
    <section class="guru-search-panel guru-enter guru-delay-1">

        <div class="p-5 sm:p-6">

            <div class="mb-5 flex items-center gap-3">

                <div class="guru-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round"
                              d="m20 20-4-4"/>
                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-extrabold">
                        Cari Data Guru
                    </h3>

                    <p class="guru-search-description mt-1 text-xs">
                        Cari berdasarkan nama, NIP, atau mata pelajaran.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.guru.index') }}"
                method="GET"
                autocomplete="off"
                class="flex flex-col gap-3 sm:flex-row"
            >

                <div class="relative min-w-0 flex-1">

                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round"
                              d="m20 20-4-4"/>
                    </svg>

                    <label for="searchGuru" class="sr-only">
                        Cari guru
                    </label>

                    <input
                        id="searchGuru"
                        type="text"
                        name="search"
                        value="{{ $search ?? request('search') }}"
                        placeholder="Cari nama guru, NIP, atau mata pelajaran..."
                        class="guru-input pl-11"
                        autocomplete="off"
                        spellcheck="false"
                    >

                </div>


                <button type="submit" class="guru-search-button">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round"
                              d="m20 20-4-4"/>
                    </svg>

                    Cari

                </button>


                @if(request('search'))                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="guru-reset-button"
                    >

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3 3v5h5"/>
                        </svg>

                        Reset

                    </a>

                @endif

            </form>

        </div>

    </section>


    {{-- =================================================
         TABEL DATA GURU
    ================================================== --}}
    <section class="guru-table-shell guru-enter guru-delay-2">

        {{-- HEADER TABEL --}}
        <div class="guru-table-top">

            <div class="flex items-center gap-3">

                <div class="guru-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-extrabold sm:text-base">
                        Daftar Guru
                    </h3>

                    <p class="guru-table-description mt-1 text-xs">
                        Informasi identitas, penugasan, dan akses akun guru.
                    </p>

                </div>

            </div>

            <div class="guru-total">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m18 0v-2a4 4 0 0 0-3-3.87M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10-7.87a4 4 0 0 1 0 7.75"/>
                </svg>

                Total hasil: {{ $guruList->total() }} guru

            </div>

        </div>


        {{-- ISI TABEL --}}
        <div class="overflow-x-auto">

            <table class="guru-table">

                <thead>

                    <tr>
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas yang Diajar</th>
                        <th>Status Akun</th>
                        <th>Status Wali Kelas</th>
                        <th>Kelas yang Diwakili</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($guruList as $guru)

                        @php
                            $statusAkunGuru = strtolower(trim($guru->status_akun ?? 'tanpa akun'));

                            $punyaAkunAktif = in_array(
                                $statusAkunGuru,
                                ['aktif', 'nonaktif'],
                                true
                            );

                            $akunAktif = $statusAkunGuru === 'aktif';

                            $belumAktivasi = $statusAkunGuru === 'belum aktif';
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td>

                                <span class="guru-number">
                                    {{ $guruList->firstItem() + $loop->index }}
                                </span>

                            </td>


                            {{-- NIP --}}
                            <td>

                                <span class="guru-nip">
                                    {{ $guru->nip ?: '-' }}
                                </span>

                            </td>


                            {{-- NAMA GURU --}}
                            <td>

                                <div class="guru-name">
                                    {{ $guru->nama_guru }}
                                </div>

                            </td>


                            {{-- MATA PELAJARAN --}}
                            <td>

                                <div class="guru-name">
                                    {{ $guru->mapel_diampu ?: '-' }}
                                </div>

                            </td>


                            {{-- KELAS YANG DIAJAR --}}
                            <td>

                                @if($guru->kelasDiajar && $guru->kelasDiajar->count())

                                    <div class="guru-class-list">

                                        @foreach($guru->kelasDiajar as $kelas)

                                            <span class="guru-class-tag">
                                                {{ $kelas->nama_kelas }}
                                            </span>

                                        @endforeach

                                    </div>

                                @else

                                    <span class="text-slate-500 dark:text-slate-400">
                                        Belum ada kelas
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS AKUN --}}
                            <td>

                                @if($statusAkunGuru === 'aktif')

                                    <span class="guru-status guru-status-active">
                                        <span class="guru-status-dot"></span>
                                        Aktif
                                    </span>

                                @elseif($statusAkunGuru === 'nonaktif')

                                    <span class="guru-status guru-status-inactive">
                                        <span class="guru-status-dot"></span>
                                        Nonaktif
                                    </span>

                                @elseif($belumAktivasi)

                                    <span class="guru-status guru-status-pending">
                                        <span class="guru-status-dot"></span>
                                        Belum Aktivasi
                                    </span>

                                @else

                                    <span class="guru-status guru-status-neutral">
                                        <span class="guru-status-dot"></span>
                                        Belum Ada Akun
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS WALI KELAS --}}
                            <td>

                                @if($guru->status_wali_kelas)

                                    <span class="guru-status guru-status-active">
                                        <span class="guru-status-dot"></span>
                                        Wali Kelas
                                    </span>

                                @else

                                    <span class="guru-status guru-status-neutral">
                                        Belum menjadi wali kelas
                                    </span>

                                @endif

                            </td>


                            {{-- KELAS YANG DIWAKILI --}}
                            <td>

                                @if($guru->status_wali_kelas && $guru->nama_kelas_wali)

                                    <div class="guru-class-list">

                                        @foreach(explode(', ', $guru->nama_kelas_wali) as $namaKelasWali)

                                            <span class="guru-class-tag guru-class-tag-wali">
                                                {{ $namaKelasWali }}
                                            </span>

                                        @endforeach

                                    </div>

                                @else

                                    <span class="text-slate-500 dark:text-slate-400">
                                        Belum ditugaskan
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="flex min-w-[145px] flex-col gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.guru.edit', $guru->id_guru) }}"
                                        class="guru-action guru-action-edit"
                                    >

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="m16 4 4 4M4 20l4-.8L19 8a2.1 2.1 0 0 0-3-3L5 16l-1 4Z"/>
                                        </svg>

                                        Edit

                                    </a>


                                    {{-- AKUN SUDAH AKTIF ATAU NONAKTIF --}}
                                    @if($punyaAkunAktif)

                                        {{-- RESET PASSWORD --}}
                                        <form
                                            action="{{ route('admin.guru.resetPassword', $guru->id_guru) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin mereset password guru ini? Password sementara yang baru akan dibuat.')"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="guru-action guru-action-reset"
                                            >

                                                <svg fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"                                                     viewBox="0 0 24 24"
                                                     aria-hidden="true">
                                                    <rect x="4" y="10" width="16" height="11" rx="2"/>
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                                </svg>

                                                Reset Password

                                            </button>

                                        </form>


                                        {{-- AKTIFKAN / NONAKTIFKAN --}}
                                        <form
                                            action="{{ route('admin.guru.toggleStatus', $guru->id_guru) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin {{ $akunAktif ? 'menonaktifkan' : 'mengaktifkan kembali' }} akun guru ini?')"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="guru-action {{ $akunAktif ? 'guru-action-disable' : 'guru-action-enable' }}"
                                            >

                                                @if($akunAktif)

                                                    <svg fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="1.8"
                                                         viewBox="0 0 24 24"
                                                         aria-hidden="true">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="M9 5v14m6-14v14"/>
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


                                    {{-- AKUN TERHUBUNG TAPI BELUM AKTIVASI --}}
                                    @elseif($belumAktivasi)

                                        <span class="guru-action-note">
                                            Menunggu Aktivasi
                                        </span>


                                    {{-- BELUM PUNYA AKUN --}}
                                    @else

                                        <span class="guru-action-note">
                                            Belum Ada Akun
                                        </span>

                                    @endif


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.guru.destroy', $guru->id_guru) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data Guru {{ addslashes($guru->nama_guru) }}? Jika akun sudah terhubung, akun login Guru tersebut juga akan dihapus.')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="guru-action guru-action-delete"
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

                            <td colspan="9" class="guru-empty">

                                <div class="guru-empty-icon">

                                    <svg class="w-7 h-7"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.7"
                                         viewBox="0 0 24 24"
                                         aria-hidden="true">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                                    </svg>

                                </div>

                                <p class="text-base font-extrabold text-slate-700 dark:text-slate-200">
                                    Data guru belum ditemukan
                                </p>

                                <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-400">

                                    @if(request('search'))
                                        Coba kata kunci pencarian yang berbeda.
                                    @else
                                        Belum ada data guru yang tersedia.
                                    @endif

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>


    {{-- =================================================
         PAGINATION DATA GURU
    ================================================== --}}
    @if($guruList->hasPages())

        <section class="guru-panel">

            <nav
                class="guru-pagination"
                aria-label="Navigasi halaman data guru"
            >

                {{-- SEBELUMNYA --}}
                @if($guruList->onFirstPage())

                    <span class="guru-page-link guru-page-link-disabled">
                        ← Sebelumnya
                    </span>

                @else

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $guruList->currentPage() - 1
                        ]) }}"
                        class="guru-page-link"
                    >
                        ← Sebelumnya
                    </a>

                @endif


                {{-- SELANJUTNYA --}}
                @if($guruList->hasMorePages())

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $guruList->currentPage() + 1
                        ]) }}"
                        class="guru-page-link"
                    >
                        Selanjutnya →
                    </a>

                @else

                    <span class="guru-page-link guru-page-link-disabled">
                        Selanjutnya →
                    </span>

                @endif

            </nav>

        </section>

    @endif


</div>


{{-- =====================================================
     JAVASCRIPT SALIN PASSWORD
===================================================== --}}

<script>
async function salinPasswordGuru() {    const field = document.getElementById('passwordSementaraGuru');
    const status = document.getElementById('statusSalinPasswordGuru');

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

        status.className =
            'mt-3 text-xs font-bold text-emerald-600 dark:text-emerald-400';

    } catch (error) {

        field.focus();
        field.select();

        status.textContent =
            'Password sudah dipilih. Tekan Ctrl+C untuk menyalin.';

        status.className =
            'mt-3 text-xs font-bold text-amber-600 dark:text-amber-400';

    }

}
</script>

@endsection