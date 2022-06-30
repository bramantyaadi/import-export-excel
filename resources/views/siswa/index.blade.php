@extends("layout")
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
                    <td>{{ $Siswa->kelas}}</td>
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
    <div class="d-flex">
        {{ $siswa->links() }}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary"> 
                <div class="card-header">
                    <h3 class="card-title">Chart</h3>

                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                    
                    <figure class="highcharts-figure">
                      <div id="container"></div>
                      <p class="highcharts-description">
                        A basic column chart compares rainfall values between four cities.
                        Tokyo has the overall highest amount of rainfall, followed by New York.
                        The chart is making use of the axis crosshair feature, to highlight
                        months as they are hovered over.
                      </p>
                    </figure>
                <!-- /.card-body -->
            </div>
        </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Monthly Average Rainfall'
  },
  subtitle: {
    text: 'Source: WorldClimate.com'
  },
  xAxis: {
    categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Rainfall (mm)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
    name: 'Tokyo',
    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

  }, {
    name: 'New York',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

  }, {
    name: 'London',
    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

  }, {
    name: 'Berlin',
    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

  }]
});
        }); 
    </script>
@endpush