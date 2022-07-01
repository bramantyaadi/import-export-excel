@extends('layout')
@push('css')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2 style="text-align: center">DATA SISWA</h2>
            </div>
            <div class="float-right my-2" style="margin-left: 20px">
                <a class="btn btn-primary" href="/siswa/export"> Cetak</a>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('siswa.create') }}"> Input Siswa</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kelas</th>
                <th>Absen</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $Siswa)
                <tr>
                    <td>{{ $Siswa->nama }}</td>
                    <td>{{ $Siswa->alamat }}</td>
                    <td>{{ $Siswa->kelas }}</td>
                    <td>{{ $Siswa->absen }}</td>
                    <td>
                        <form action="{{ route('siswa.destroy', $Siswa->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('siswa.show', $Siswa->id) }}">Detail</a>
                        </form>
                    </td>
                </tr>

                </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="container">
        <div id="chart">
        </div>
    </div>
    <div class="container mt-5">
        <h2>Google Maps Place Autocomplete Laravel</h2>
    
        <div class="form-group">
            <label>Location/City/Address</label>
            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
        </div>
    
        <div class="form-group" id="latitudeArea">
            <label>Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control">
        </div>
    
        <div class="form-group" id="longtitudeArea">
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    {{-- {{dd($nama)}} --}}
    @endsection 
    @push('js') 
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>

        let kelas = [];
        let total = [];
        let siswa = {!! json_encode($siswa_chart) !!};

        siswa.forEach(element => {
            kelas.push(element.kelas);
            total.push(element.total);
        });

        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Nama Siswa'
            },
            xAxis: {
                categories: kelas,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Kelas'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Jumlah Stok Tersisa',
                data: total
            }]
        });
    </script>

@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places" ></script>
<script>
    $(document).ready(function () {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");
    });
</script>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());

            $("#latitudeArea").removeClass("d-none");
            $("#longtitudeArea").removeClass("d-none");
        });
    }
</script>
@endpush