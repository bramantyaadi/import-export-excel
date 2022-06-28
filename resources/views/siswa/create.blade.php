@extends('layout')

@section('content')
    <div class="container">
        <title>Tambah Siswa</title>
        <h2 style="text-align: center">Tambah Data Siswa</h2>
        <form action="/siswa" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama: </label>
                <input type="nama" class="form-control" required="required" name="nama"><br>
                <label for="nama">Alamat: </label>
                <input type="alamat" class="form-control" required="required" name="alamat"><br>
                <label for="nama">Kelas: </label>
                <input type="kelas" class="form-control" required="required" name="kelas"><br>
                <label for="nama">Absen: </label>
                <input type="absen" class="form-control" required="required" name="absen"><br>
                <button type="submit" name="submit" class="btn btn-primary text-center">Simpan</button>
            </div>
        </form>

        <form action="{{url('siswa/import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
@endsection