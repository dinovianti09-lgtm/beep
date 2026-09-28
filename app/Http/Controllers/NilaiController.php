<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();
        return response()->json([
            'status' => 'success',
            'data' => $nilai
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'semester' => 'required',
            'nilai_harian' => 'required|numeric',
            'nilai_uts' => 'required|numeric',
            'nilai_uas' => 'required|numeric',
        ]);

        // Hitung nilai akhir sederhana (misal rata-rata)
        $harian = $request->nilai_harian;
        $uts = $request->nilai_uts;
        $uas = $request->nilai_uas;
        $nilai_akhir = ($harian + $uts + $uas) / 3;

        // Tentukan predikat
        if ($nilai_akhir >= 85) $predikat = 'A';
        elseif ($nilai_akhir >= 75) $predikat = 'B';
        elseif ($nilai_akhir >= 60) $predikat = 'C';
        else $predikat = 'D';

        $data = $request->all();
        $data['nilai_akhir'] = round($nilai_akhir, 2);
        $data['predikat'] = $predikat;

        $nilai = Nilai::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil ditambahkan',
            'data' => $nilai
        ], 201);
    }

    public function show($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $nilai
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        $nilai->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil diperbarui',
            'data' => $nilai
        ], 200);
    }

    public function destroy($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil dihapus'
        ], 200);
    }
}