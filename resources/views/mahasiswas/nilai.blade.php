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

            @foreach ($Mahasiswa->Matakuliah as $nilai)
                <tr>
                    <td>{{ $nilai->nama_matkul }}</td>
                    <td>{{ $nilai->sks }}</td>
                    <td>{{ $nilai->semester }}</td>
                    <td>{{ $nilai->pivot->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
