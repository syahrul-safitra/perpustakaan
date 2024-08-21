<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.buku.index', [
            'books' => book::with('category')->cari(request('search'))->latest()->paginate(10),
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
            'deskripsi' => 'required|max:1000',
            'berkas' => 'required|max:10000',
            'gambar' => 'required|max:2000'
        ]);

        $file = $request->file('gambar');

        $renameFile = uniqid() . '_' . $file->getClientOriginalName();

        $validated['gambar'] = $renameFile;

        $berkas = $request->file('berkas');

        $renameBerkas = uniqid() . '_' . $berkas->getClientOriginalName();

        $validated['berkas'] = $renameBerkas;

        Book::create($validated);

        $tujuan_upload = 'files';

        $file->move($tujuan_upload, $renameFile);
        $berkas->move($tujuan_upload, $renameBerkas);

        return redirect('book')->with('success', 'Data buku berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        return view('user.show', [
            'book' => $book
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
            'berkas' => 'max:10000'
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
}
