<?php

namespace App\Http\Controllers;

use App\Models\BobotNilai;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Rapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BobotNilaiController extends Controller
{
    /**
     * Memastikan akun yang login adalah Guru
     * dan mengambil data Gurunya.
     */
    private function guruLogin(): Guru
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        $guru = Guru::where('user_id', auth()->id())->first();

        if (!$guru) {
            abort(403, 'Data Guru tidak ditemukan.');
        }

        return $guru;
    }

    /**
     * Mengambil mata pelajaran yang diampu Guru.
     */
    private function mapelGuru(Guru $guru): Mapel
    {
        if (empty($guru->mapel_diampu)) {
            abort(403, 'Mata pelajaran Guru belum ditentukan.');
        }

        $mapel = Mapel::whereRaw(
            'LOWER(TRIM(nama_mapel)) = ?',
            [strtolower(trim($guru->mapel_diampu))]
        )->first();

        if (!$mapel) {
            abort(403, 'Mata pelajaran Guru tidak ditemukan.');
        }

        return $mapel;
    }

    /**
     * Menampilkan halaman pengaturan bobot.
     */
    public function index(Request $request)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $raporList = Rapor::orderByDesc('id_rapor')->get();

        $idRapor = $request->query('id_rapor');

        if ($idRapor !== null && $idRapor !== '') {
            $request->validate([
                'id_rapor' => 'required|integer|exists:rapor,id_rapor',
            ]);

            $raporTerpilih = Rapor::findOrFail($idRapor);
        } else {
            $raporTerpilih = $raporList->first();
        }

        $bobot = null;

        if ($raporTerpilih) {
            $bobot = BobotNilai::where('id_mapel', $mapel->id_mapel)
                ->where('id_rapor', $raporTerpilih->id_rapor)
                ->first();
        }

        return view('guru.bobot-nilai.index', compact(
            'guru',
            'mapel',
            'raporList',
            'raporTerpilih',
            'bobot'
        ));
    }

    /**
     * Menyimpan pengaturan bobot.
     */
    public function update(Request $request)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $validated = $request->validate([
            'id_rapor' => 'required|integer|exists:rapor,id_rapor',
            'bobot_harian' => 'required|integer|min:0|max:100',
            'bobot_uts' => 'required|integer|min:0|max:100',
            'bobot_uas' => 'required|integer|min:0|max:100',
        ]);

        $totalBobot = (int) $validated['bobot_harian']
            + (int) $validated['bobot_uts']
            + (int) $validated['bobot_uas'];

        if ($totalBobot !== 100) {
            throw ValidationException::withMessages([
                'bobot_harian' => 'Total bobot Harian, UTS, dan UAS harus tepat 100%.',
            ]);
        }

        DB::transaction(function () use ($validated, $mapel) {
            BobotNilai::updateOrCreate(
                [
                    'id_mapel' => $mapel->id_mapel,
                    'id_rapor' => $validated['id_rapor'],
                ],
                [
                    'bobot_harian' => $validated['bobot_harian'],
                    'bobot_uts' => $validated['bobot_uts'],
                    'bobot_uas' => $validated['bobot_uas'],
                ]
            );
        });

        return redirect()
            ->route('guru.bobot-nilai.index', [
                'id_rapor' => $validated['id_rapor'],
            ])
            ->with('success', 'Pengaturan bobot nilai berhasil disimpan.');
    }
}
