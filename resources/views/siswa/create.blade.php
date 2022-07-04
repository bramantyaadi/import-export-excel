@extends('layouts')

@push('css')
    <style>
        #map {
            height: 100px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
@endpush

@section('content')
    <div class="container">
        <form action="/siswa" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama: </label>
                <input type="text" class="form-control" required="required" name="nama"></br>
                <label for="email">email: </label>
                <input type="text" class="form-control" required="required" name="email"></br>
                <label for="no_hp">No: </label>
                <input type="text" class="form-control" required="required" name="no_hp"></br>
                <label for="kelas">Kelas: </label>
                <input type="text" class="form-control" required="required" name="kelas"></br>
                <div class="form-group">
                    <label>Pilih lokasi</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Choose Location">
                </div>

                <div class="form-group" id="latitudeArea">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control">
                </div>

                <div class="form-group" id="longtitudeArea">
                    <label>Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
            <div wire:ignore id="map" style="width: 100%; height: 500px;"> </div>
        </form>

        <form action="{{ url('/siswa/import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>

    <script>
        var map = L.map('map').setView([-7.275973, 112.808304], 13);
        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([51.5, -0.09]).addTo(map);
        var circle = L.circle([51.508, -0.11], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);
        var polygon = L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(map);
    </script>
@endpush
