<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => Mapel::all()], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ]);

        $mapel = Mapel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data mapel berhasil ditambahkan',
            'data' => $mapel
        ], 201);
    }
}