<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaporSiswa; // <-- Wajib ada ini
use App\Models\Nilai;      // <-- Wajib ada ini
use App\Models\Siswa;      // <-- Wajib ada ini
use App\Models\Rapor;      // <-- Wajib ada ini
use PDF;                   // <-- Jika menggunakan DomPDF

class RaporController extends Controller
{
    // ...
}