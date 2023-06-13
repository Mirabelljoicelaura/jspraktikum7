@extends('mahasiswas.layouts')
@section('content')
    <div class="text-center  ">
        <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        <h1>KARTU HASIL STUDI(KRS)</h1>
    </div>

    <p><strong>Nama</strong>:{{ $Mahasiswa->Nama }}</p>
    <p><strong>NIM</strong>:{{ $Mahasiswa->Nim }}</p>
    <p><strong>Kelas</strong>:{{ $Mahasiswa->Kelas->nama_kelas }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @if ($mahasiswa_matakuliah)
            @foreach ($mahasiswa_matakuliah as $nilai)
                <tr>
                    <td>{{ $nilai->matakuliah->nama_matkul }}</td>
                    <td>{{ $nilai->matakuliah->sks }}</td>
                    <td>{{ $nilai->matakuliah->semester }}</td>
                    <td>{{ $nilai->pivot->nilai }}</td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="4">Data nilai tidak ditemukan.</td>
                </tr>
            @endif


        </tbody>
    </table>
@endsection
