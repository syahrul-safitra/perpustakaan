<?php

namespace App\Http\Controllers;

use App\Models\borrow;
use App\Models\book;
use App\Models\User;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pinjam.index', [
            'peminjaman' => borrow::with(['book', 'user'])->cari(request('search'))->orderByDesc('created_at')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required'
        ]);
        $tanggal_peminjaman = date('Y-m-d');

        $tanggal_pengembalian = date('Y-m-d', strtotime('+6 day', strtotime($tanggal_peminjaman)));

        $validated['tanggal_peminjaman'] = $tanggal_peminjaman;
        $validated['tanggal_pengembalian'] = $tanggal_pengembalian;
        $validated['denda'] = 0;

        $book = Book::find($request->book_id);

        if ($book->stok == 0) {
            return redirect()->back()->with('error', 'stok buku habis');
        }
        $stok = $book->stok - 1;

        DB::beginTransaction();
        try {
            borrow::create($validated);
            book::where('id', $request->book_id)->update([
                'stok' => $stok
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // return back()->with('error', 'Peminjaman buku ' . $book->judul . ' gagal!');
            return back()->with('error', $e->getMessage());
        }

        return redirect('siswa')->with('success', 'Peminjaman buku ' . $book->judul . ' berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(borrow $borrow)
    {
        return 'disini pinjam';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(borrow $pinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, borrow $pinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(borrow $pinjam)
    {
        borrow::destroy($pinjam->id);
        return back()->with('success', 'Data peminjaman berhasil dihapus!');
    }

    public function peminjaman_user(User $user)
    {
        return view('user.riwayatPeminjaman', [
            'data' => borrow::with('book')->where('user_id', $user->id)->orderByDesc('created_at')->get()
        ]);


    }

    public function kembalikan(Request $request, borrow $pinjam)
    {

        $validated = $request->validate([
            'denda' => 'required',
            'tanggal_dikembalikan' => 'required'
        ]);


        try {
            $pinjam->denda = $validated['denda'];
            $pinjam->status = 'dikembalikan';
            $pinjam->tanggal_dikembalikan = $validated['tanggal_dikembalikan'];

            $book = Book::where('id', $pinjam->book_id)->first();
            $book->stok = $book->stok + 1;

            $pinjam->save();
            $book->save();
        } catch (\Exception $e) {
            return back()->with('error', 'Data gagal dirubah!');
        }

        return back()->with('success', 'Data berhasil dirubah!');
    }

    public function cetak(Request $request)
    {
        $data = borrow::with(['book', 'user'])->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->latest()->get();

        return view('admin.pinjam.cetak', [
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ]);
    }

    public function dashboard()
    {
        return view('admin.index', [
            'anggota' => User::siswa()->count(),
            'buku' => book::all()->count(),
            'peminjaman' => borrow::whereYear('tanggal_peminjaman', Carbon::now()->format('Y'))
                ->whereMonth('tanggal_peminjaman', Carbon::now()->format('m'))->count(),
            'denda' => borrow::denda_bulan_ini(),
        ]);
    }
}
