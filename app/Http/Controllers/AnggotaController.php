<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.anggota.index', [
            'anggotas' => User::filters(request('search'))->siswa()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|',
            'nis' => 'required|max:20|unique:users',
            'password' => 'required|max:10',
            'gambar' => 'required|image|max:2000',
            'email' => 'required|email|max:20'
        ]);

        $gambar = $request->file('gambar');

        $renameFile = uniqid() . '_' . $gambar->getClientOriginalName();

        $tujuanUpload = 'files';

        $gambar->move($tujuanUpload, $renameFile);

        $validated['gambar'] = $renameFile;

        User::create($validated);

        return redirect('anggota')->with('success', 'Data anggota berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        return view('admin.anggota.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|max:100|',
            'password' => 'required|max:10',
            'gambar' => 'image|max:2000',
            'email' => 'required|email|max:20'
        ];

        if ($request->nis != $user->nis) {
            $rules['nis'] = 'required|max:20|unique:users';
        }

        $validated = $request->validate($rules);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');

            $renameFile = uniqid() . '_' . $file->getClientOriginalName();

            $tujuanUpload = 'files';

            $file->move($tujuanUpload, $renameFile);

            $validated['gambar'] = $renameFile;

            File::delete('files/' . $user->gambar);
        }

        try {
            User::where('id', $id)->update($validated);
        } catch (\Throwable $th) {
            return redirect('anggota')->with('error', 'Edit data gagal!');
        }

        return redirect('anggota')->with('success', 'Data berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        User::destroy($id);

        File::delete('files/' . $user->gambar);

        return redirect('anggota')->with('success', 'Data anggota berhasil dihapus!');
    }

    public function profil(User $user)
    {
        return view('user.profil', [
            'user' => $user
        ]);
    }

    public function editAdmin()
    {
        $admin = User::where('is_admin', true)->first();

        return view('admin.anggota.edit_admin', [
            'user' => $admin
        ]);
    }

    public function updateAdmin(Request $request, User $user)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users';
        }

        $validated = $request->validate($rules);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        return redirect('anggota')->with('success', 'Data admin berhasil dirubah!');
    }
}
