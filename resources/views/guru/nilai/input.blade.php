<!DOCTYPE html>
<html>
<head>
    <title>Input Nilai Siswa</title>
</head>
<body>
    <h2>Form Input Nilai (Guru)</h2>
    <a href="{{ route('guru.dashboard') }}">← Kembali ke Dashboard</a>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('guru.nilai.store') }}" method="POST" style="margin-top: 20px;">
        @csrf

        <label>Pilih Periode Rapor:</label><br>
        <select name="id_rapor" required>
            @foreach($rapors as $rapor)
                <option value="{{ $rapor->id_rapor }}">{{ $rapor->semester }} - {{ $rapor->tahun_ajaran }}</option>
            @endforeach
        </select><br><br>

        <label>Pilih Siswa:</label><br>
        <select name="id_siswa" required>
            @foreach($siswas as $siswa)
                <option value="{{ $siswa->id_siswa }}">{{ $siswa->nis }} - {{ $siswa->nama_siswa }} ({{ $siswa->kelas }})</option>
            @endforeach
        </select><br><br>

        <label>Pilih Mata Pelajaran:</label><br>
        <select name="id_mapel" required>
            @foreach($mapels as $mapel)
                <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }} (KKM: {{ $mapel->kkm }})</option>
            @endforeach
        </select><br><br>

        <label>Nilai Harian (0-100):</label><br>
        <input type="number" step="0.01" name="nilai_harian" required><br><br>

        <label>Nilai UTS (0-100):</label><br>
        <input type="number" step="0.01" name="nilai_uts" required><br><br>

        <label>Nilai UAS (0-100):</label><br>
        <input type="number" step="0.01" name="nilai_uas" required><br><br>

        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Simpan & Hitung Otomatis</button>
    </form>
</body>
</html>