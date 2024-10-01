<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.petugas.index', [
            'petugas' => User::where('role', 'petugas')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:20'
        ]);

        $validated['role'] = 'petugas';
        $validated['text_password'] = $validated['password'];

        User::create($validated);

        return redirect('petugas')->with('success', 'Petugas berhasil ditambah!');
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
    public function edit(User $petuga)
    {
        return view('admin.petugas.edit', [
            'petugas' => $petuga
        ]);
    }

    /**$validated = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:20'
        ]);
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $petuga)
    {
        $rules = [
            'name' => 'required|max:200',
            'password' => 'required|max:20'
        ];

        if ($request->email != $petuga->email) {
            $rules['email'] = 'required|max:100|unique:users';
        }


        $validated = $request->validate($rules);

        $validated['text_password'] = $validated['password'];

        User::find($petuga->id)->update($validated);

        return redirect('petugas')->with('success', 'Data petugas berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $petuga)
    {

        User::destroy($petuga->id);

        return redirect('petugas')->with('success', 'Data telah berhasil dihapus!');

    }
}
