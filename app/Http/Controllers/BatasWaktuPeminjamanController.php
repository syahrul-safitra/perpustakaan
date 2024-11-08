<?php

namespace App\Http\Controllers;

use App\Models\BatasWaktuPeminjaman;
use Illuminate\Http\Request;

class BatasWaktuPeminjamanController extends Controller
{
    public function update(Request $request)
    {
        $batas_waktu = BatasWaktuPeminjaman::first();

        $batas_waktu->batas_waktu = $request->batas_waktu;

        $batas_waktu->save();

        return back()->with('success', 'Berhasil merubah batas waktu!');
    }
}
