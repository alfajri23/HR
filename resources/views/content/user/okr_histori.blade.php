@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.user')
@endsection

@section('content')

<div class="container bg-white p-3">

    <h4>Histori track OKR</h4>
    <div class="col-12">
        <canvas id="myChart"></canvas>
      </div>
       

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let datas = "{{ $track_tahun }}";

    const labels = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Progres',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: datas.split(","),
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );



</script>

@endsection