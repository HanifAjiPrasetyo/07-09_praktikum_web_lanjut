@php
    use Carbon\Carbon;
@endphp
@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswas.create') }}">Input Mahasiswa</a>
            </div>
            <div class="float-left my-2">
                <form action="/mahasiswas">
                    <div class="form-group" role="search">
                        <label for="search">Cari Mahasiswa</label>
                        <div class="d-flex">
                            <input type="search" name="search" class="form-control" id="search"
                                aria-describedby="search" value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-sm btn-dark mx-1">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($paginate as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama }}</td>
                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                <td>{{ $mahasiswa->jurusan }}</td>
                <td>{{ $mahasiswa->no_hp }}</td>
                <td>{{ $mahasiswa->email }}</td>
                <td>{{ Carbon::parse($mahasiswa->tgl_lahir)->locale('id_ID')->isoFormat('dddd, DD MMMM YYYY') }}</td>
                <td>
                    <form action="{{ route('mahasiswas.destroy', $mahasiswa->nim) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('mahasiswas.show', $mahasiswa->nim) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mahasiswas.edit', $mahasiswa->nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
        {{ $paginate->links() }}
    </div>
@endsection
