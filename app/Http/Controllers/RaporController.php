<?php

namespace App\Http\Controllers;

use App\Models\Rapor;
use App\Models\Nilai;
use App\Models\RaporSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class RaporController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $rapors = Rapor::orderBy('id_rapor', 'desc')
            ->paginate(10);

        return view('admin.rapor.index', compact('rapors'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.rapor.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'semester' => [
                'required',
                'in:Ganjil,Genap',
                Rule::unique('rapor', 'semester')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'tahun_ajaran',
                            $request->tahun_ajaran
                        );
                    }),
            ],
            'tahun_ajaran' => [
                'required',
                'string',
                'max:20',
            ],
        ], [
            'semester.unique' =>
                'Periode semester dan tahun ajaran tersebut sudah tersedia.',
        ]);

        Rapor::create($validated);

        return redirect()
            ->route('admin.rapor.index')
            ->with('success', 'Periode rapor berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        return view('admin.rapor.edit', compact('rapor'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        $validated = $request->validate([
            'semester' => [
                'required',
                'in:Ganjil,Genap',
                Rule::unique('rapor', 'semester')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'tahun_ajaran',
                            $request->tahun_ajaran
                        );
                    })
                    ->ignore($rapor->id_rapor, 'id_rapor'),
            ],
            'tahun_ajaran' => [
                'required',
                'string',
                'max:20',
            ],
        ], [
            'semester.unique' =>
                'Periode semester dan tahun ajaran tersebut sudah digunakan.',
        ]);

        $rapor->update($validated);

        return redirect()
            ->route('admin.rapor.index')
            ->with('success', 'Periode rapor berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PERIODE RAPOR
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        try {
            $hasil = DB::transaction(function () use ($id) {

                $rapor = Rapor::where('id_rapor', $id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $idRapor = $rapor->id_rapor;

                // Periksa data nilai.
                $adaNilai = Nilai::where(
                    'id_rapor',
                    $idRapor
                )->exists();

                // Periksa data rapor siswa.
                $adaRaporSiswa = RaporSiswa::where(
                    'id_rapor',
                    $idRapor
                )->exists();

                // Periksa pengaturan bobot nilai.
                $adaBobot = DB::table('bobot_nilai')
                    ->where('id_rapor', $idRapor)
                    ->exists();

                // Periksa data kehadiran.
                $adaKehadiran = DB::table('kehadiran_siswa')
                    ->where('id_rapor', $idRapor)
                    ->exists();

                // Periksa data ekstrakurikuler.
                $adaEkstrakurikuler = DB::table('ekstrakurikuler_siswa')
                    ->where('id_rapor', $idRapor)
                    ->exists();

                /*
                 * PERIODE TIDAK BOLEH DIHAPUS
                 * JIKA MASIH MEMILIKI DATA TERKAIT.
                 */
                if (
                    $adaNilai ||
                    $adaRaporSiswa ||
                    $adaBobot ||
                    $adaKehadiran ||
                    $adaEkstrakurikuler
                ) {
                    return false;
                }

                // Hapus periode jika tidak memiliki data terkait.
                $rapor->delete();

                return true;
            });

            if (!$hasil) {
                return redirect()
                    ->route('admin.rapor.index')
                    ->with(
                        'error',
                        'Periode rapor tidak dapat dihapus karena masih digunakan oleh data Nilai, Rapor Siswa, Bobot Nilai, Kehadiran, atau Ekstrakurikuler.'
                    );
            }

            return redirect()
                ->route('admin.rapor.index')
                ->with(
                    'success',
                    'Periode rapor berhasil dihapus.'
                );

        } catch (QueryException $e) {
            return redirect()
                ->route('admin.rapor.index')
                ->with(
                    'error',
                    'Periode rapor tidak dapat dihapus karena masih terhubung dengan data akademik lainnya.'
                );
        }
    }
}