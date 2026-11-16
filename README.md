
# EDUVIA — Sistem Akademik Mini

EDUVIA merupakan aplikasi sistem informasi akademik berbasis web yang dikembangkan untuk membantu pengelolaan data akademik sekolah secara terstruktur, efisien, dan terintegrasi.

Aplikasi ini dibangun menggunakan framework Laravel dengan database MySQL. EDUVIA menyediakan akses berdasarkan peran pengguna, yaitu Administrator, Guru, dan Siswa.

## Informasi Proyek

| Informasi | Keterangan |
|---|---|
| Nama Aplikasi | EDUVIA |
| Jenis Aplikasi | Sistem Informasi Akademik Berbasis Web |
| Framework | Laravel |
| Bahasa Pemrograman | PHP |
| Database | MySQL |
| Template | Laravel Blade |
| Repository | https://github.com/dinovianti09-lgtm/beep |
| Aplikasi Online | https://eduvia.ethiodeploy.app |

## Fitur Utama

### 1. Administrator

Administrator bertugas mengelola data master dan administrasi akademik sekolah.

- Dashboard administrator.
- Pengelolaan data mata pelajaran.
- Pengaturan mata pelajaran berdasarkan kombinasi tingkat kelas dan jurusan.
- Pengelolaan data guru.
- Pengelolaan data siswa.
- Pengelolaan kelas dan wali kelas.
- Pengelolaan data kepala sekolah.
- Pengelolaan akun dan akses pengguna.

### 2. Guru

Guru menggunakan sistem untuk mendukung kegiatan akademik sesuai hak akses yang diberikan.

- Login ke sistem menggunakan akun guru.
- Mengakses dashboard guru.
- Melihat informasi kelas dan mata pelajaran terkait.
- Mengelola nilai siswa sesuai kewenangan.
- Mengakses informasi akademik yang tersedia.

### 3. Siswa

Siswa dapat mengakses informasi akademik melalui akun masing-masing.

- Login menggunakan akun siswa.
- Mengakses dashboard siswa.
- Melihat informasi akademik pribadi.
- Mengakses nilai dan rapor sesuai data yang tersedia.
- Mengakses transkrip akademik apabila tersedia.

## Teknologi yang Digunakan

| Teknologi | Fungsi |
|---|---|
| Laravel | Framework backend |
| PHP | Bahasa pemrograman server |
| MySQL | Sistem manajemen database |
| Blade | Template antarmuka |
| HTML | Struktur halaman |
| CSS | Tampilan antarmuka |
| JavaScript | Interaksi pada halaman |
| Composer | Manajemen dependensi PHP |
| NPM | Manajemen dependensi frontend |
| Git & GitHub | Version control dan repository |
| EthioDeploy | Hosting aplikasi |

## Arsitektur Sistem

EDUVIA menggunakan pola arsitektur Model-View-Controller (MVC) yang diterapkan pada framework Laravel.

### Model

Model menangani representasi data serta interaksi dengan database menggunakan Eloquent ORM.

Contoh:
- Model Guru
- Model Siswa
- Model Kelas
- Model Mapel

### View

View digunakan untuk menampilkan antarmuka pengguna menggunakan Laravel Blade.

Struktur halaman dipisahkan berdasarkan peran pengguna, seperti Administrator, Guru, dan Siswa.

### Controller

Controller menerima permintaan dari pengguna, menjalankan validasi, memproses logika aplikasi, dan menghubungkan Model dengan View.

Contoh:
- AuthController
- GuruController
- SiswaController
- KelasController
- MapelController

### Alur Kerja MVC

1. Pengguna mengakses aplikasi melalui browser.
2. Laravel Route menerima permintaan.
3. Controller memproses permintaan dan validasi.
4. Model berinteraksi dengan database MySQL.
5. Controller mengirimkan hasil ke View.
6. View menampilkan informasi kepada pengguna.

## Struktur Direktori Utama

```text
sistem-akademik-mini/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   └── migrations/
├── public/
├── resources/
│   └── views/
│       ├── admin/
│       ├── guru/
│       └── siswa/
├── routes/
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

## Panduan Instalasi Lokal

### Persyaratan

Pastikan perangkat memiliki:

- PHP sesuai persyaratan versi Laravel proyek.
- Composer.
- MySQL.
- Node.js dan NPM.
- Git.
- Web browser.

### 1. Clone Repository

```bash
git clone https://github.com/dinovianti09-lgtm/beep.git
cd beep
```

### 2. Instal Dependensi Backend

```bash
composer install
```

### 3. Instal Dependensi Frontend

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Untuk Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Sesuaikan konfigurasi database lokal:

```env
APP_NAME=EDUVIA
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_rapor_digital
DB_USERNAME=root
DB_PASSWORD=
```

Konfigurasi di atas merupakan contoh untuk lingkungan lokal. Sesuaikan nama database, username, dan password dengan konfigurasi MySQL masing-masing.

Jangan pernah mengunggah file `.env` yang berisi kredensial asli ke repository publik.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Siapkan Database

Buat database MySQL sesuai nama yang digunakan pada file `.env`.

Apabila seluruh struktur database proyek tersedia melalui migration, jalankan:

```bash
php artisan migrate
```

Jika proyek membutuhkan data awal, gunakan seeder yang memang tersedia pada repository atau prosedur impor database yang telah disediakan oleh tim pengembang.

### 7. Build Asset Frontend

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser:

http://127.0.0.1:8000

Gunakan akun yang telah dibuat melalui mekanisme aplikasi atau data awal yang disediakan secara aman oleh tim pengembang.

## Konfigurasi Environment

Berikut beberapa variabel environment yang digunakan pada aplikasi Laravel.

| Variabel | Keterangan |
|---|---|
| APP_NAME | Nama aplikasi |
| APP_ENV | Lingkungan aplikasi |
| APP_KEY | Kunci enkripsi aplikasi |
| APP_DEBUG | Pengaturan debug |
| APP_URL | URL aplikasi |
| DB_CONNECTION | Jenis koneksi database |
| DB_HOST | Host database |
| DB_PORT | Port database |
| DB_DATABASE | Nama database |
| DB_USERNAME | Username database |
| DB_PASSWORD | Password database |

Untuk lingkungan produksi, gunakan pengaturan yang sesuai dengan layanan hosting dan pastikan `APP_DEBUG=false`.

**Keamanan:** Jangan membagikan APP_KEY, password database, token, atau kredensial asli pada README.

## Pengelolaan Data Akademik

EDUVIA dirancang untuk menjaga konsistensi data akademik.

Beberapa penerapan yang digunakan:

1. Validasi input pada proses penambahan dan perubahan data.
2. Pengelolaan akses berdasarkan peran pengguna.
3. Penggunaan transaksi database pada proses tertentu.
4. Perlindungan data akademik yang masih memiliki keterkaitan dengan data lain.
5. Pemisahan antara status akun yang dihapus secara logis dan riwayat akademik yang perlu dipertahankan.

Sebagai contoh, kelas yang masih memiliki data siswa terkait tidak dapat dihapus secara langsung agar integritas riwayat akademik tetap terjaga.

## Deployment

Aplikasi EDUVIA dipublikasikan menggunakan layanan EthioDeploy dan terhubung dengan repository GitHub.

Alur pembaruan aplikasi:

1. Pengembang melakukan perubahan kode di lingkungan lokal.
2. Perubahan diuji sebelum dipublikasikan.
3. Kode disimpan menggunakan Git commit.
4. Perubahan dikirim ke GitHub.
5. Versi terbaru di-deploy ke EthioDeploy.
6. Pengembang memeriksa fungsi aplikasi setelah deployment.

Alamat aplikasi:

https://eduvia.ethiodeploy.app

**Catatan:** Database lokal dan database hosting menggunakan lingkungan penyimpanan yang berbeda. Perubahan data lokal tidak otomatis tersinkronisasi ke database hosting.

## Pengujian

Pengujian aplikasi dilakukan untuk memeriksa fungsi-fungsi utama, antara lain:

- Autentikasi dan akses berdasarkan peran.
- Penambahan, perubahan, dan penghapusan data master.
- Validasi formulir.
- Pengelolaan kelas dan mata pelajaran.
- Pengelolaan nilai dan rapor.
- Perlindungan integritas data yang saling berelasi.
- Pemeriksaan aplikasi setelah deployment.


## Tim Pengembang

| Nama | Peran |
|---|---|
| Dina Novianti | Backend Developer |
| Sopi Pitriani | Frontend Developer |

Proyek Sistem Akademik Mini dikembangkan oleh Tim EDUVIA sebagai bagian dari kegiatan pembelajaran dan pengembangan aplikasi berbasis web.

Dina Novianti bertanggung jawab pada pengembangan backend, meliputi logika aplikasi, pengelolaan database, controller, dan pemrosesan data.

Sopi Pitriani bertanggung jawab pada pengembangan frontend, meliputi perancangan antarmuka pengguna, tampilan halaman, dan interaksi pengguna pada aplikasi.

## Status Proyek

EDUVIA telah memiliki implementasi aplikasi berbasis web dan repository GitHub yang digunakan untuk pengembangan serta pengelolaan versi kode.

Pengembangan dan penyempurnaan fitur dilakukan sesuai kebutuhan pengujian dan evaluasi proyek.

---

**EDUVIA — Sistem Akademik Mini**

Dokumentasi proyek untuk mendukung pengembangan, pemeliharaan, dan penggunaan aplikasi.
