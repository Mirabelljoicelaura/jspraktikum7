<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    if($request->has('key')){
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%".$request->key."%")->paginate(5);

    }else{

    $mahasiswas = Mahasiswa::with('kelas')->paginate(5);
    $mahasiswas = Mahasiswa::orderBy('id', 'asc')->paginate(3);
    }

    return view('mahasiswas.index',['mahasiswas' => $mahasiswas,'paginate' =>$mahasiswas]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_Lahir' => 'required',
            'kelas_id' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);
        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.detail', compact('mahasiswa'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all();

        return view('mahasiswas.edit', compact('mahasiswa', 'kelas'));
    }

    // create function update
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_Lahir' => 'required',
            'kelas_id' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // Mahasiswa::find($Nim)->delete();
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function nilai(string $Nim)
    {
       $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->where('Nim' , $Nim)->first();
       return view('mahasiswas.nilai', compact('Mahasiswa'));
    }


}
