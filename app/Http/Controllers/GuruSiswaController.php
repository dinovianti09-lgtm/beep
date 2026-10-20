<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class GuruSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $guru = Guru::where('user_id', $user->id)->firstOrFail();

        $kelasWali = Kelas::where('wali_kelas', $guru->nama_guru)->first();

        $siswaList = collect();

        if ($kelasWali) {

            $namaKelas = str_replace('-', ' ', $kelasWali->nama_kelas);

            $siswaList = Siswa::whereRaw(
                "REPLACE(kelas, '-', ' ') = ?",
                [$namaKelas]
            )
            ->orderBy('nama_siswa')
            ->get();
        }

        return view('guru.siswa.index', compact(
            'guru',
            'kelasWali',
            'siswaList'
        ));
    }
}