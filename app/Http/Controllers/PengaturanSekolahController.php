<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanSekolahController extends Controller
{
    public function index()
    {
        $pengaturan = DB::table('pengaturan_sekolah')->first();

        return view('admin.pengaturan_sekolah', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kepala_sekolah' => ['required', 'string', 'max:150'],
            'nip_kepala_sekolah' => ['nullable', 'string', 'max:50'],
        ], [
            'nama_kepala_sekolah.required' => 'Nama Kepala Sekolah wajib diisi.',
            'nama_kepala_sekolah.max' => 'Nama Kepala Sekolah maksimal 150 karakter.',
            'nip_kepala_sekolah.max' => 'NIP maksimal 50 karakter.',
        ]);

        $pengaturan = DB::table('pengaturan_sekolah')->first();

        if ($pengaturan) {
            DB::table('pengaturan_sekolah')
                ->where('id', $pengaturan->id)
                ->update([
                    'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
                    'nip_kepala_sekolah' => $request->filled('nip_kepala_sekolah')
                        ? $request->nip_kepala_sekolah
                        : null,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('pengaturan_sekolah')->insert([
                'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
                'nip_kepala_sekolah' => $request->filled('nip_kepala_sekolah')
                    ? $request->nip_kepala_sekolah
                    : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()
            ->route('admin.pengaturan-sekolah.index')
            ->with('success', 'Pengaturan Kepala Sekolah berhasil disimpan.');
    }
}
