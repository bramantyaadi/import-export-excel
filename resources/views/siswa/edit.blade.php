@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/siswa/{{$siswa->id}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" required="required" name="nama" value="{{$siswa->nama}}"></br>
        </div>
        <div class="form-group">
            <label for="content">Alamat</label>
            <input type="text" class="form-control" required="required" name="alamat" value="{{$siswa->alamat}}"></br>
        </div>
        <div class="form-group">
            <label for="content">Kelas</label>
            <input type="text" class="form-control" required="required" name="kelas" value="{{$siswa->kelas}}"></br>
        </div>
        <div class="form-group">
            <label for="content">Absen</label>
            <input type="text" class="form-control" required="required" name="absen" value="{{$siswa->absen}}"></br>
        </div>
        <button type="submit" class="btn btn-primary float-right">Ubah Data Siswa</button>
    </form>
</div>
@endsection