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

    public function index()
    {
        $mapelList = Mapel::with('pengaturanKelas')
            ->orderBy('id_mapel', 'desc')
            ->get();

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

        $validated = $request->validate([
            'nama_mapel' => [
                'required',
                'string',
                'max:100',
                Rule::unique('mapel', 'nama_mapel')
                    ->ignore($mapel->id_mapel, 'id_mapel'),
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
            'nama_mapel.unique' => 'Nama mata pelajaran tersebut sudah digunakan.',
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

        DB::transaction(function () use ($mapel, $validated) {
            $mapel->update([
                'nama_mapel' => $validated['nama_mapel'],
                'kkm' => $validated['kkm'],
            ]);

            $mapel->pengaturanKelas()->delete();

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
            ->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);

        $jumlahNilai = DB::table('nilai')
            ->where('id_mapel', $mapel->id_mapel)
            ->count();

        if ($jumlahNilai > 0) {
            return redirect()
                ->route('admin.mapel.index')
                ->with(
                    'error',
                    'Mata pelajaran tidak dapat dihapus karena masih digunakan dalam '
                    . $jumlahNilai
                    . ' data nilai. Hapus atau pindahkan data terkait terlebih dahulu jika memang diperlukan.'
                );
        }

        $mapel->delete();

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}
