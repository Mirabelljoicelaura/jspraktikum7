@extends('mahasiswas.layouts')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('mahasiswas.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="key" class="form-control" placeholder="Search by Nama">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Email</th>
            <th width="290px">Action</th>
        </tr>
        @foreach ($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->Nim }}</td>
                <td>{{ $mahasiswa->Nama }}</td>
                <td>{{ $mahasiswa->Tanggal_Lahir }}</td>
                <td>{{ $mahasiswa->kelas->nama_kelas}}</td>
                <td>{{ $mahasiswa->Jurusan }}</td>
                <td>{{ $mahasiswa->No_Handphone }}</td>
                <td>{{ $mahasiswa->Email }}</td>
                <td>
                <form action="{{ route('mahasiswas.destroy',$mahasiswa) }}" method="POST">
                @dd()
                <a class="btn btn-info" href="{{ route('mahasiswas.show', $mahasiswa) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$mahasiswa) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="{{ route('mahasiswas.nilai',$mahasiswa->Nim) }}">Nilai</a>

                </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="pagination-container">
        {{$mahasiswas->links('pagination::bootstrap-5')}}
    </div>
@endsection
