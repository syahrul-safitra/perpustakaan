<?php

namespace App\Http\Controllers;

use App\Models\BatasWaktuPeminjaman;
use App\Models\book;
use App\Models\Category;
use App\Models\PasswordBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $password = PasswordBook::all();
        return view('admin.buku.index', [
            'books' => book::with('category')->cari(request('search'))->latest()->paginate(10),
            'password' => $password[0]->password,
            'batas_waktu' => BatasWaktuPeminjaman::first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buku.create', [
            'categories' => Category::all()
        ]);

    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_buku' => 'required|max:255|unique:books',
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|date',
            'category_id' => 'required',
            'stok' => 'required',
            'rak' => 'required',
            'deskripsi' => 'required|max:1000',
            'gambar' => 'required|max:2000',
        ]);

        $file = $request->file('gambar');

        $renameFile = uniqid() . '_' . $file->getClientOriginalName();

        $validated['gambar'] = $renameFile;

        Book::create($validated);

        $tujuan_upload = 'files';

        $file->move($tujuan_upload, $renameFile);

        return redirect('book')->with('success', 'Data buku berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {

        $password = PasswordBook::all();
        return view('user.show', [
            'book' => $book,
            'password' => $password[0]->password,
            'batas_waktu' => BatasWaktuPeminjaman::first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {

        return view('admin.buku.edit', [
            'book' => $book,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, book $book)
    {
        $rules = [
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|date',
            'category_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required|max:1000',
            'gambar' => 'max:2000',
            'berkas' => 'max:10000',
            'kunci' => '',
            'rak' => 'required'
        ];

        if ($request->id_buku != $book->id_buku) {
            $rules['id_buku'] = 'required|max:255|unique:books';
        }

        $validated = $request->validate($rules);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');

            $renameFile = uniqid() . '_' . $file->getClientOriginalName();

            $tujuan = 'files';

            $validated['gambar'] = $renameFile;

            $file->move($tujuan, $renameFile);

            // hapus file lama : 
            File::delete('files/' . $book->gambar);
        }

        if ($request->file('berkas')) {
            $berkas = $request->file('berkas');

            $renameBerkas = uniqid() . '_' . $berkas->getClientOriginalName();

            $tujuan = 'files';

            $validated['berkas'] = $renameBerkas;

            $berkas->move($tujuan, $renameBerkas);

            File::delete('files/' . $book->berkas);
        }

        try {
            Book::where('id', $book->id)->update($validated);
        } catch (\Throwable $th) {
            return redirect('book')->with('error', 'Data gagal dirubah!');
        }

        return redirect('book')->with('success', 'Data buku berhasil dirubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
        Book::destroy($book->id);

        File::delete('files/' . $book->gambar);

        return redirect('book')->with('success', 'Data buku berhasil dihapus!');

    }

    public function getCategories(Request $request)
    {
        return Book::where('category_id', $request->category_id)->get();
    }

    public function baca(book $book)
    {
        return view('user.baca', [
            'book' => $book
        ]);
    }

    public function changePassword(Request $request)
    {

        $validate = $request->validate([
            'password' => 'required|max:50'
        ]);

        PasswordBook::find(1)->update($validate);

        return back()->with('success', 'Password buku telah dirubah!');
    }

    public function cetak(Request $request)
    {
        $data = book::with('category')->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->latest()->get();

        return view('admin.buku.cetak', [
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ]);

    }
}
