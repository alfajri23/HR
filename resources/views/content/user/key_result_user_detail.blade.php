@extends('layouts.apps')

@section('sidebar')
    @hasrole('admin')
    @include('includes.sidebar.admin')
    @endhasrole
    @hasrole('user|user_manager')
    @include('includes.sidebar.user')
    @endhasrole
@endsection

@section('content')

<div class="container bg-white p-3">

    <h4>{{$key->kode_key}}</h4>
    <h4>{{$key->keyResult[0]->nama}}</h4>
    <div class="col-10">
        <canvas id="myChart"></canvas>
      </div>
       

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let datas = "{{ $key['target_1'] }}";
    

    function show(){
        console.log(data);
    }
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
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
        type: 'bar',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endsection