<?php

namespace App\Http\Controllers;

use App\Models\BukuKunjungan;
use Illuminate\Http\Request;

class BukuKunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $view = 'user.kunjungan.index';

        if (auth()->user()) {
            $view = 'admin.kunjungan.index';
        }

        return view($view, [
            'data' => BukuKunjungan::orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = 'user.kunjungan.create';

        if (auth()->user()) {
            $view = 'admin.kunjungan.create';
        }

        return view($view);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'nama' => 'required|max:250',
            'kelas' => 'required|max:50',
            'keperluan' => 'required|max:100'
        ]);

        BukuKunjungan::create($validated);

        return redirect('kunjungan')->with('success', 'Berhasil mengisi form tamu!');

    }

    /**
     * Display the specified resource.
     */
    public function show(BukuKunjungan $bukuKunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BukuKunjungan $bukuKunjungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BukuKunjungan $bukuKunjungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BukuKunjungan $kunjungan)
    {
        BukuKunjungan::destroy($kunjungan->id);

        return redirect('kunjungan')->with('success', 'Berhasil mengisi form tamu!');
    }

    public function cetak(Request $request)
    {
        // return BukuKunjungan::whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        return view('admin.kunjungan.cetak', [
            'data' => BukuKunjungan::whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get(),
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ]);
    }
}
