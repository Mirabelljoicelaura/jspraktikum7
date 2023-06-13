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
    $mahasiswas = Mahasiswa::orderBy('Nim', 'asc')->paginate(3);
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
    public function show(string $Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail',compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
{
    $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
    $kelas = Kelas::all();

    return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
}

    // create function update
    public function update(Request $request, $Nim)
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

        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::find($Nim)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }
    // function nilai($Nim)
    // {
    //     $mahasiswa_id = Mahasiswa::where('Nim', $Nim)->pluck('id')->first();
    //     $Mahasiswa = Mahasiswa::with('mahasiswa_matakuliah.matakuliah')->where('id', $mahasiswa_id)->first();
    //     return view('mahasiswas.mahasiswa_nilai', compact('mahasiswa'));
    // }
    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::where('Nim', $Nim)->first();

        if (!$Mahasiswa) {

        }

        $mahasiswa_matakuliah = $Mahasiswa->mahasiswa_matakuliah;
        return view('mahasiswas.nilai', compact('Mahasiswa', 'mahasiswa_matakuliah'));
    }

}
