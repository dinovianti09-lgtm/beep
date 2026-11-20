
@extends('layouts.guru')

@section('title', 'Persetujuan Nilai - EDUVIA')
@section('page-title', 'Persetujuan Nilai')
@section('page-subtitle', 'Periksa dan setujui nilai siswa sebelum dipublikasikan')

@push('styles')
<style>
    .approval-page {
        color: #26374A;
    }

    .approval-header {
        padding: 22px 24px;
        border: 1px solid #C8DCEE;
        border-radius: 16px;
        background: linear-gradient(120deg, #E3F0FA, #F3F8FD);
        margin-bottom: 22px;
    }

    .approval-header h2 {
        font-size: 21px;
        font-weight: 800;
        color: #294D70;
        margin-bottom: 6px;
    }

    .approval-header p {
        color: #607A94;
        font-size: 14px;
    }

    .approval-card {
        background: #FFFFFF;
        border: 1px solid #D8E3EE;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(39,77,119,.045);
    }

    .approval-card-title {
        padding: 18px 20px;
        font-weight: 800;
        border-bottom: 1px solid #E5ECF3;
    }

    .approval-table-wrap {
        overflow-x: auto;
    }

    .approval-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .approval-table th {
        background: #F3F8FD;
        padding: 14px;
        text-align: left;
        color: #48647F;
        white-space: nowrap;
    }

    .approval-table td {
        padding: 14px;
        border-top: 1px solid #E5ECF3;
        vertical-align: middle;
    }

    .approval-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 999px;
        background: #FFF3D6;
        color: #9A6700;
        font-size: 12px;
        font-weight: 700;
    }

    .approval-button {
        padding: 9px 14px;
        background: #356C9D;
        color: white;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .approval-button:hover {
        background: #254F75;
    }

    .approval-empty {
        padding: 45px 20px;
        text-align: center;
        color: #647991;
    }

    .approval-success {
        padding: 14px 18px;
        margin-bottom: 18px;
        border: 1px solid #B7E2C6;
        border-radius: 12px;
        background: #EDF9F0;
        color: #246B3D;
    }

    .approval-pagination {
        padding: 18px 20px;
        border-top: 1px solid #E5ECF3;
    }
</style>
@endpush

@section('content')
<div class="approval-page">

    <div class="approval-header">
        <h2>Persetujuan Nilai Siswa</h2>
        <p>
            Kelas: {{ $kelas->nama_kelas }} |
            Wali Kelas: {{ $guru->nama_guru }}
        </p>
        <p>
            Periksa nilai yang telah diinput guru mata pelajaran
            sebelum menyetujuinya untuk dipublikasikan.
        </p>
    </div>

    @if(session('success'))
        <div class="approval-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="approval-card">

        <div class="approval-card-title">
            Daftar Nilai Menunggu Persetujuan
            ({{ $nilaiPending->total() }})
        </div>

        <div class="approval-table-wrap">
            <table class="approval-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Semester</th>
                        <th>Nilai Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($nilaiPending as $nilai)
                        <tr>
                            <td>
                                {{ $nilaiPending->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $nilai->siswa->nama_siswa ?? '-' }}
                            </td>

                            <td>
                                {{ $nilai->mapel->nama_mapel ?? '-' }}
                            </td>

                            <td>
                                {{ $nilai->semester }}
                            </td>

                            <td>
                                <strong>
                                    {{ number_format((float) $nilai->nilai_akhir, 2) }}
                                </strong>
                            </td>

                            <td>
                                <span class="approval-badge">
                                    Pending
                                </span>
                            </td>

                            <td>
                                <form
                                    action="{{ route('guru.persetujuan-nilai.setujui', $nilai->id_nilai) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menyetujui nilai siswa ini?')"
                                >
                                    @csrf

                                    <button type="submit" class="approval-button">
                                        Setujui Nilai
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="approval-empty">
                                    Tidak ada nilai yang menunggu persetujuan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($nilaiPending->hasPages())
            <div class="approval-pagination">
                {{ $nilaiPending->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
