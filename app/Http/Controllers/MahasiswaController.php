<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
        'Foto' => 'required', // Mengubah 'required' menjadi 'nullable' untuk memungkinkan input kosong
        'Tanggal_Lahir' => 'required',
        'kelas_id' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'Email' => 'required',
    ]);

    // Simpan file foto ke direktori dan dapatkan nama file yang disimpan jika ada
    if ($request->hasFile('Foto')) {
        $foto = $request->file('Foto')->store('images', 'public');
    }

    // Buat entri Mahasiswa dengan menyertakan nama file foto jika ada
    Mahasiswa::create($request->except('Foto') + ['Foto' => $foto]);

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

        $mahasiswa->update($request->except('Foto'));

        if ($request->hasFile('Foto')) {
            if ($mahasiswa->Foto && file_exists(storage_path('app/public/' . $mahasiswa->Foto))) {
                Storage::delete('public/' . $mahasiswa->Foto);
            }
            $foto = $request->file('Foto')->store('images', 'public');
            $mahasiswa->Foto = $foto;
            $mahasiswa->save();
        }

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
    public function cetak_pdf($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pdf = PDF::loadView('mahasiswas.cetak_pdf', ['Mahasiswa' => $mahasiswa]);
        return $pdf->stream();
    }





}
