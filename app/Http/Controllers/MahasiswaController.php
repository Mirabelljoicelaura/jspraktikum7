<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $request->validate([
             'Nim' => 'required',
             'Nama' => 'required',
             'Kelas' => 'required',
             'Jurusan' => 'required',
             'No_Handphone' => 'required',
         ]);

         Mahasiswa::create($request->all());

         return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
     }


    /**
     * Display the specified resource.
     */
    public function show(string $Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail',compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
        ]);
        Mahasiswa::find($Nim)->update($request->all());
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
