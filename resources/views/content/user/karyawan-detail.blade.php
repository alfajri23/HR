@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.user')
@endsection

@section('content')
<style>
    .bl{
        border-left: 1px solid #e8e8e8
    }

    .photo{
        object-fit: cover;
        width: 100px !important;
        height: 100px !important;
    }
</style>
        <div class="container-fluid d-flex">
            @php
                $done = 0;
                $progres_tot = 0;
                foreach ($track as $tr){
                    //dd($tr);
                
                    $progres = 0;
                    $target = $tr->target;
                    $bobot = $tr->bobot;
                    $week = explode(",",$tr->week_1);
                    //dd($week);
                    foreach ($track as $tr){
                    $progres_tot += $tr->progres; 
                }

                if(count($track) == 0){
                    $progres_tot = 0;
                }else{
                    $progres_tot = round($progres_tot);
                }
                }

                if(count($track) == 0){
                    $progres_tot = 0;
                }else{
                    $progres_tot = $progres_tot/count($track);
                    $progres_tot = round($progres_tot);
                }
                    

            @endphp

            <div class="col-12 col-md-12 widget-holder">
                <div class="widget-bg">
                    <ul class="list-unstyled widget-user-list card-body">
                        <li class="media">
                            <div class="d-flex mr-3">
                                <a class="user--online thumb-xs" style="width:70px;">
                                    <img src="{{asset($data->foto)}}" class="photo" alt="">
                                </a>
                            </div>
                            <div class="media-body d-flex justify-content-between">        
                                <h5 class="media-heading">
                                    <a href="#">{{$data->nama}}</a> 
                                    <small>{{$data->username}}</small>
                                    <small>{{$data->divisi->nama}}</small>
                                </h5>
                                <span class="btn-group mr-b-20">
                                    <button type="button" class="btn btn-outline-{{$jam > 0 ? 'danger' : 'default'}} ripple">
                                        <p class="mb-0">
                                            @if($jam < 0)
                                                {{$jam*-1}} jam
                                        </p>
                                        <p class="mb-0">Lebih</p>
                                            @else
                                                {{$jam}}
                                        </p>
                                        <p class="mb-0">Hutang jam</p>
                                            @endif

                                    </button>
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{count($track)}}</p>
                                        <p class="mb-0">Key result</p>
                                    </button>
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{round($progres_tot)}}%</p>
                                        <p class="mb-0">Progres</p>
                                    </button>
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{$done}}</p>
                                        <p class="mb-0">Done</p>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="widget-body clearfix">
                        <div class="tabs mr-t-10">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#home-tab-bordered-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Activity</a>
                                </li>
                                <li class="nav-item"><a href="#okr-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">OKR</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Progress -->
                                <div class="tab-pane active" id="home-tab-bordered-1">
                                    <div class="container bg-white p-3">
                                        <h5>OKR Berjalan</h5>
                                        @forelse ($tracks as $e => $track)
                                        <h4>{{$e}}</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2px">No</th>
                                                    <th>Kode</th>
                                                    <th>Key result</th>
                                                    <th>Bobot</th>
                                                    <th>Target</th>
                                                    <th>Start</th>
                                                    <th>Pekan 1</th>
                                                    <th>Pekan 2</th>
                                                    <th>Pekan 3</th>
                                                    <th>Pekan 4</th>
                                                    <th>Pekan 5</th>
                                                    <th>Progres</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $tot_progres = 0;
                                                @endphp
                                                @foreach ($track as $tr )
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$tr->kode_key}}</td>
                                                    <td>{{$tr->keyResult->nama}}</td>
                                                    <td>{{$tr->bobot}}</td>
                                                    <td>{{$tr->target}}</td>
                                                    <td>{{$tr->start}}</td>
                                                    @php
                                                        if($tr->week_1 != null){
                                                            $week = explode(",",$tr->week_1);
                                                        }else {
                                                            $week = [];
                                                        }  
                                                    @endphp
                                                    
                                                    @for($i = 0; $i < 5; $i++)
                                                        @if (empty($week[$i]))
                                                        <td>
                                                            
                                                        </td>
                                                        @else
                                                        <td>{{$week[$i]}}</td>
                                                        @endif
                                                        
                                                    @endfor
                                                    <td>
                                                        <p class="my-0">{{$tr->progres}}%</p>
                                                        <div class="progress" data-toggle="tooltip" title="{{$tr->progres}}%">
                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr->progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr->progres}}%"><span class="sr-only">{{$tr->progres}}%</span>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    
                                                </tr>
                                                @php
                                                    
                                                    $tot_progres += $tr->progres;
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td colspan="11" class="text-center">Total progres</td>
                                                    <td>
                                                        <p class="my-0">{{$tot_progres}}%</p>
                                                        <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td colspan="1"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @empty    

                                        @endforelse

                                        @if (!empty($multi))
                                            <h4>Total</h4>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 2px">No</th>
                                                        <th>Kode</th>
                                                        <th style="width: 300px;">Key result</th>
                                                        <th>Bobot</th>
                                                        <th>Target</th>
                                                        <th>Start</th>
                                                        <th>Pekan 1</th>
                                                        <th>Pekan 2</th>
                                                        <th>Pekan 3</th>
                                                        <th>Pekan 4</th>
                                                        <th>Pekan 5</th>
                                                        <th>Progres</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $tot_progres = 0;
                                                    @endphp
                                                    @foreach ($multi as $tr )
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$tr['kode_key']}}</td>
                                                        <td>{{$tr['nama']}}</td>
                                                        <td>10%</td>
                                                        <td>100%</td>
                                                        <td>0</td>
                                                        @for($i = 0; $i < count($tr['data_pekan']); $i++)
                                                            @if (empty($tr['data_pekan'][$i]))
                                                            <td>
                                                                
                                                            </td>
                                                            @else
                                                            <td>{{number_format($tr['data_pekan'][$i])}}</td>
                                                            @endif
                                                            
                                                        @endfor
                                                        <td>
                                                            <p class="my-0">{{$tr['progres']}}%</p>
                                                            <div class="progress" data-toggle="tooltip" title="{{$tr['progres']}}%">
                                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr['progres']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr['progres']}}%"><span class="sr-only">{{$tr['progres']}}%</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                    
                                                            $tot_progres += $tr['progres'];
                                                        @endphp
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="11" class="text-center">Total progres</td>
                                                        <td>
                                                            <p class="my-0">{{$tot_progres}}%</p>
                                                            <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                                                                </div>
                                                            </div></td>
                                                        <td colspan="2"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif

                                    </div>
                                    <div class="container bg-light p-3">
                                        <h5>OKR Tracking</h5>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                                <!-- End Progress -->

                                {{-- OKR --}}
                                <div class="tab-pane" id="okr-tab-bordered-1">
                                    <h4>OKR</h4>
                                    <div class="row">
                                        @foreach ($bulan as $i => $bln)
                                        <a class="col-sm-3 mr-b-20" href="{{route('trackUser',['id' =>$data->id, 'm' => $loop->iteration])}}">
                                            {{-- <div class="col-sm-12 mr-b-20"> --}}
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$bln}}</h5>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                          
                            </div>
                            <!-- End tab-content -->
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            <!-- End col-12 -->
            
        </div>
        
{{-- </div> --}}

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
        options: {
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: 100
                },
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );



</script>


@endsection