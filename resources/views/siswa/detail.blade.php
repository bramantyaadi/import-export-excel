@extends('layout')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header" style="text-align: center">
                    Data Siswa
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Nama: </b>{{ $siswa->nama }}</li>
                        <li class="list-group-item"><b>Alamat: </b>{{ $siswa->alamat }}</li>
                        <li class="list-group-item"><b>Kelas: </b>{{ $siswa->kelas}}</li>
                        <li class="list-group-item"><b>Absen: </b>{{ $siswa->absen}}</li>
                    </ul>
                </div>
                <a class="btn btn-success mt-3" href="{{ route('siswa.index') }}">Kembali</a>

            </div>
        </div>
    </div>
@endsection