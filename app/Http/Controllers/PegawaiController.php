<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:pegawais|max:20',
            'nama' => 'required|string|max:255',
            'bidang' => 'required|string|max:100',
            'layanan' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:15',
            'tempat_tinggal' => 'required|string|max:255',
        ]);

        $pegawai = Pegawai::create($validatedData);

        return response()->json($pegawai, 201);
    }

    public function show($nik)
    {
        $pegawai = Pegawai::where('nik', $nik)->firstOrFail();
        return response()->json($pegawai);
    }
}

