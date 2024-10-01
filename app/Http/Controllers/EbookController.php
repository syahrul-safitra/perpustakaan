<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\PasswordBook;
use App\Models\Category;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $password = PasswordBook::first();
        return view('admin.ebook.index', [
            'ebooks' => Ebook::with('category')->cari(request('search'))->latest()->paginate(10),
            'password' => $password
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ebook.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_buku' => 'required|max:255|unique:ebooks',
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|date',
            'category_id' => 'required',
            'deskripsi' => 'required|max:1000',
            'berkas' => 'required|max:10000',
            'gambar' => 'required|max:2000',
        ]);

        if ($request->kunci) {
            $validated['kunci'] = 1;
        }

        $file = $request->file('gambar');

        $renameFile = uniqid() . '_' . $file->getClientOriginalName();

        $validated['gambar'] = $renameFile;

        $berkas = $request->file('berkas');

        $renameBerkas = uniqid() . '_' . $berkas->getClientOriginalName();

        $validated['berkas'] = $renameBerkas;

        Ebook::create($validated);

        $tujuan_upload = 'files';

        $file->move($tujuan_upload, $renameFile);
        $berkas->move($tujuan_upload, $renameBerkas);

        return redirect('ebook')->with('success', 'Data Ebook berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ebook $ebook)
    {
        $password = PasswordBook::all();
        return view('user.show_ebook', [
            'book' => $ebook,
            'password' => $password[0]->password
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ebook $ebook)
    {
        return view('admin.ebook.edit', [
            'ebook' => $ebook,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ebook $ebook)
    {
        $rules = [
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|date',
            'category_id' => 'required',
            'deskripsi' => 'required|max:1000',
            'gambar' => 'max:2000',
            'berkas' => 'max:10000',
            'kunci' => ''
        ];

        if ($request->id_buku != $ebook->id_buku) {
            $rules['id_buku'] = 'required|max:255|unique:books';
        }

        $validated = $request->validate($rules);

        if ($request->kunci) {
            $validated['kunci'] = 1;
        }

        if ($request->file('gambar')) {
            $file = $request->file('gambar');

            $renameFile = uniqid() . '_' . $file->getClientOriginalName();

            $tujuan = 'files';

            $validated['gambar'] = $renameFile;

            $file->move($tujuan, $renameFile);

            // hapus file lama : 
            File::delete('files/' . $ebook->gambar);
        }

        if ($request->file('berkas')) {
            $berkas = $request->file('berkas');

            $renameBerkas = uniqid() . '_' . $berkas->getClientOriginalName();

            $tujuan = 'files';

            $validated['berkas'] = $renameBerkas;

            $berkas->move($tujuan, $renameBerkas);

            File::delete('files/' . $ebook->berkas);
        }

        try {
            Ebook::where('id', $ebook->id)->update($validated);
        } catch (\Throwable $th) {
            return redirect('ebook')->with('error', 'Data gagal dirubah!');
        }

        return redirect('ebook')->with('success', 'Data ebook berhasil dirubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ebook $ebook)
    {
        Ebook::destroy($ebook->id);

        File::delete('files/' . $ebook->gambar);

        return redirect('ebook')->with('success', 'Data ebook berhasil dihapus!');

    }

    public function cetak(Request $request)
    {
        $data = Ebook::with('category')->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->latest()->get();

        return view('admin.ebook.cetak', [
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ]);

    }
}
