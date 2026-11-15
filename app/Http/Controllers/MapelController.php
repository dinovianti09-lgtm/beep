<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    private function daftarJurusan(): array
    {
        return ['BR', 'RPL', 'DKV'];
    }

    private function daftarTingkat(): array
    {
        return ['X', 'XI', 'XII'];
    }

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $filterJurusan = (string) $request->query('jurusan', '');
        $filterTingkat = (string) $request->query('tingkat', '');

        $query = Mapel::with('pengaturanKelas')
            ->orderBy('id_mapel', 'desc');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mapel', 'like', "%{$search}%")
                    ->orWhereRaw(
                        'CAST(kkm AS CHAR) LIKE ?',
                        ["%{$search}%"]
                    );
            });
        }

        if ($filterJurusan !== '' || $filterTingkat !== '') {
            $query->whereHas('pengaturanKelas', function ($q) use (
                $filterJurusan,
                $filterTingkat
            ) {
                if ($filterJurusan !== '') {
                    $q->where('jurusan', $filterJurusan);
                }

                if ($filterTingkat !== '') {
                    $q->where('tingkat', $filterTingkat);
                }
            });
        }

        $mapelList = $query
            ->paginate(10)
            ->withQueryString();

        $jurusanList = $this->daftarJurusan();
        $tingkatList = $this->daftarTingkat();

        return view('admin.mapel.index', compact(
            'mapelList',
            'jurusanList',
            'tingkatList'
        ));
    }

    public function create()
    {
        $jurusanList = $this->daftarJurusan();
        $tingkatList = $this->daftarTingkat();

        return view('admin.mapel.create', compact(
            'jurusanList',
            'tingkatList'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => [
                'required',
                'string',
                'max:100',
                Rule::unique('mapel', 'nama_mapel'),
            ],
            'kkm' => 'required|integer|min:0|max:100',
            'jurusan' => 'required|array|min:1',
            'jurusan.*' => [
                'required',
                'string',
                Rule::in($this->daftarJurusan()),
            ],
            'tingkat' => 'required|array|min:1',
            'tingkat.*' => [
                'required',
                'string',
                Rule::in($this->daftarTingkat()),
            ],
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'nama_mapel.max' => 'Nama mata pelajaran maksimal 100 karakter.',
            'nama_mapel.unique' => 'Nama mata pelajaran tersebut sudah tersedia.',
            'kkm.required' => 'KKM wajib diisi.',
            'kkm.integer' => 'KKM harus berupa angka bulat.',
            'kkm.min' => 'KKM minimal 0.',
            'kkm.max' => 'KKM maksimal 100.',
            'jurusan.required' => 'Pilih minimal satu jurusan.',
            'jurusan.min' => 'Pilih minimal satu jurusan.',
            'jurusan.*.in' => 'Pilihan jurusan tidak valid.',
            'tingkat.required' => 'Pilih minimal satu tingkat kelas.',
            'tingkat.min' => 'Pilih minimal satu tingkat kelas.',
            'tingkat.*.in' => 'Pilihan tingkat kelas tidak valid.',
        ]);

        DB::transaction(function () use ($validated) {
            $mapel = Mapel::create([
                'nama_mapel' => $validated['nama_mapel'],
                'kkm' => $validated['kkm'],
            ]);

            $pengaturan = [];

            foreach (array_unique($validated['jurusan']) as $jurusan) {
                foreach (array_unique($validated['tingkat']) as $tingkat) {
                    $pengaturan[] = [
                        'jurusan' => $jurusan,
                        'tingkat' => $tingkat,
                    ];
                }
            }

            $mapel->pengaturanKelas()->createMany($pengaturan);
        });

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mapel = Mapel::with('pengaturanKelas')
            ->findOrFail($id);

        $jurusanList = $this->daftarJurusan();
        $tingkatList = $this->daftarTingkat();

        $jurusanTerpilih = $mapel->pengaturanKelas
            ->pluck('jurusan')
            ->unique()
            ->values()
            ->all();

        $tingkatTerpilih = $mapel->pengaturanKelas
            ->pluck('tingkat')
            ->unique()
            ->values()
            ->all();

        return view('admin.mapel.edit', compact(
            'mapel',
            'jurusanList',
            'tingkatList',
            'jurusanTerpilih',
            'tingkatTerpilih'
        ));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $kombinasiValid = [];

        foreach ($this->daftarTingkat() as $tingkat) {
            foreach ($this->daftarJurusan() as $jurusan) {
                $kombinasiValid[] = $tingkat . '|' . $jurusan;
            }
        }

        $validated = $request->validate([
            'nama_mapel' => [
                'required',
                'string',
                'max:100',
                Rule::unique('mapel', 'nama_mapel')
                    ->ignore($mapel->id_mapel, 'id_mapel'),
            ],
            'kkm' => 'required|integer|min:0|max:100',
            'kombinasi' => 'required|array|min:1',
            'kombinasi.*' => [
                'required',
                'string',
                'distinct',
                Rule::in($kombinasiValid),
            ],
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'nama_mapel.max' => 'Nama mata pelajaran maksimal 100 karakter.',
            'nama_mapel.unique' => 'Nama mata pelajaran tersebut sudah digunakan.',
            'kkm.required' => 'KKM wajib diisi.',
            'kkm.integer' => 'KKM harus berupa angka bulat.',
            'kkm.min' => 'KKM minimal 0.',
            'kkm.max' => 'KKM maksimal 100.',
            'kombinasi.required' => 'Pilih minimal satu kombinasi kelas.',
            'kombinasi.min' => 'Pilih minimal satu kombinasi kelas.',
            'kombinasi.*.in' => 'Kombinasi kelas tidak valid.',
            'kombinasi.*.distinct' => 'Kombinasi kelas tidak boleh duplikat.',
        ]);

        DB::transaction(function () use ($mapel, $validated) {
            // Simpan nama mapel sebelumnya.
            $namaLama = trim($mapel->nama_mapel);
            $namaBaru = trim($validated['nama_mapel']);

            // Perbarui data mata pelajaran.
            $mapel->update([
                'nama_mapel' => $namaBaru,
                'kkm' => $validated['kkm'],
            ]);

            // Sinkronkan nama mapel pada data guru.
            if (strcasecmp($namaLama, $namaBaru) !== 0) {
                DB::table('guru')
                    ->whereRaw(
                        'LOWER(TRIM(mapel_diampu)) = ?',
                        [strtolower($namaLama)]
                    )
                    ->update([
                        'mapel_diampu' => $namaBaru,
                    ]);
            }

            // Perbarui pemetaan jurusan dan tingkat.
            $pengaturan = [];

            foreach ($validated['kombinasi'] as $kode) {
                [$tingkat, $jurusan] = explode('|', $kode, 2);

                $pengaturan[] = [
                    'tingkat' => $tingkat,
                    'jurusan' => $jurusan,
                ];
            }

            $mapel->pengaturanKelas()->delete();
            $mapel->pengaturanKelas()->createMany($pengaturan);
        });

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $mapel = Mapel::where('id_mapel', $id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Lindungi data nilai siswa.
                $jumlahNilai = DB::table('nilai')
                    ->where('id_mapel', $mapel->id_mapel)
                    ->count();

                if ($jumlahNilai > 0) {
                    throw new \DomainException(
                        'Mata pelajaran tidak dapat dihapus karena masih memiliki '
                        . $jumlahNilai
                        . ' data nilai. Riwayat akademik harus dipertahankan.'
                    );
                }
// Cegah penghapusan mapel yang masih diampu guru aktif.
$guruAktif = DB::table('guru')
    ->join('users', 'guru.user_id', '=', 'users.id')
    ->whereRaw('LOWER(TRIM(guru.mapel_diampu)) = ?', [
        strtolower(trim($mapel->nama_mapel))
    ])
    ->where('users.status', 'aktif')
    ->exists();

if ($guruAktif) {
    throw new \DomainException(
        'Mata pelajaran tidak dapat dihapus karena masih diampu guru aktif.'
    );
}
                // Bersihkan bobot nilai jika tidak ada nilai siswa.
                DB::table('bobot_nilai')
                    ->where('id_mapel', $mapel->id_mapel)
                    ->delete();

                // Bersihkan pengaturan jurusan dan tingkat.
                $mapel->pengaturanKelas()->delete();

                // Hapus mata pelajaran.
                $mapel->delete();
            });

            return redirect()
                ->route('admin.mapel.index')
                ->with(
                    'success',
                    'Mata pelajaran dan pengaturan terkait berhasil dihapus.'
                );

        } catch (\DomainException $e) {
            return redirect()
                ->route('admin.mapel.index')
                ->with('error', $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);

            return redirect()
                ->route('admin.mapel.index')
                ->with(
                    'error',
                    'Mata pelajaran belum dapat dihapus karena masih '
                    . 'memiliki keterkaitan data lain.'
                );
        }
    }
}
