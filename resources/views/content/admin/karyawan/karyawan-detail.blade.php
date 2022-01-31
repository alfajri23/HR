@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
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
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($data->foto)}}" class="rounded-circle" alt="">
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
                                            @if($jam < 1)
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
                                <li class="nav-item"><a href="#ganti-jam-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Ganti jam</a>
                                </li>
                                <li class="nav-item"><a href="#izin-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Izin</a>
                                </li>
                                <li class="nav-item"><a href="#lembur-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Lembur</a>
                                </li>
                                <li class="nav-item"><a href="#cuti-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Cuti</a>
                                </li>
                                <li class="nav-item"><a href="#absensi-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Absensi</a>
                                </li>       
                                <li class="nav-item"><a href="#profile-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
                                <li class="nav-item"><a href="#edit-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Edit</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Progress -->
                                <div class="tab-pane active" id="home-tab-bordered-1">
                                    <div class="container bg-white p-3">
                                        <h5>OKR Berjalan</h5>
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
                                    </div>
                                    <div class="container bg-white p-3">
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
                          
                                <!-- Ganti jam -->
                                <div class="tab-pane" id="ganti-jam-tab-bordered-1">
                                    <div class="container">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%">No</th>
                                                    <th style="width: 11%">Tanggal</th>
                                                    <th style="width: 5%">Jam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $jams = 0;
                                                @endphp
                                                @forelse ($ganti as $iz )
                                                    @php
                                                        $jams = $jams + $iz->jam;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$iz->hari}}</td>
                                                        <td>{{$iz->jam}}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-center"> tidak ada data</td>
                                                </tr>
                                                    
                                                @endforelse
                                                <tr>
                                                    <td colspan="2" class="text-center">Hutang jam</td>
                                                    <td>{{$jams}}</td>
                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Ijin -->
                                <div class="tab-pane" id="izin-tab-bordered-1">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5>Daftar izin {{$data->nama}} bulan ini</h5>
                                        </div>
                                        <div class="col-3">
                                            <h5>Total hutang izin : {{$ijin}} jam</h5>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        @forelse ($izin as $iz)
                                        <div class="col-sm-4 mr-b-20">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">{{$iz->tipe}}</h5>
                                                        @if ($iz->ganti_jam == 1)
                                                            <h6 class="card-title">Hutang {{$iz->jam}} jam</h6>
                                                        @endif
                                                        
                                                    </div>
                                                    <p class="card-text text-dark">{{$iz->alasan}}</p>
                                                    <p class="card-text text-dark">
                                                        {{$iz->tanggal_mulai}}

                                                        @if (empty($iz->tanggal_akhir))
                                                            
                                                        @else
                                                            sampai {{$iz->tanggal_akhir}}<br>
                                                            {{$iz->hari}} hari   

                                                        @endif
                                                    
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            tidak ada catatan izin
                                        @endforelse
                                        
                                    </div>
                                </div>
   
                                <!-- Lembur -->
                                <div class="tab-pane" id="lembur-tab-bordered-1">
                                    <div class="container">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%">No</th>
                                                    <th style="width: 11%">Tanggal</th>
                                                    <th>Alasan</th>
                                                    <th style="width: 5%">Jam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $jams = 0;
                                                @endphp
                                                @forelse ($lembur as $iz )
                                                    @php
                                                        $jams = $jams + $iz->jam;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$iz->hari}}</td>
                                                        <td>{{$iz->alasan}}</td>
                                                        <td>{{$iz->jam}}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-center"> tidak ada data</td>
                                                </tr>
                                                    
                                                @endforelse
                                                <tr>
                                                    <td colspan="3" class="text-center">Total jam</td>
                                                    <td >{{$jams}}</td>
                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Cuti -->
                                <div class="tab-pane" id="cuti-tab-bordered-1">
                                    <div class="col-6">
                                        <h5>Jatah cuti : {{$data->cuti}} </h5>
                                    </div>
                                    
                                    <div class="row">
                                        @forelse ($cuti as $iz)
                                        <div class="col-sm-4 mr-b-20">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">{{$iz->tipe}}</h5>
                                                    </div>
                                                    <p class="card-text text-dark">{{$iz->alasan}}</p>
                                                    <p class="card-text text-dark">
                                                        {{$iz->tanggal_mulai}}

                                                        @if (empty($iz->tanggal_akhir))
                                                            
                                                        @else
                                                            sampai {{$iz->tanggal_akhir}}<br>
                                                            {{$iz->hari}} hari   

                                                        @endif
                                                    
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            tidak ada catatan cuti
                                        @endforelse
                                        
                                    </div>
                                </div>

                                {{-- Absensi --}}
                                <div class="tab-pane" id="absensi-tab-bordered-1">
                                    <div class="container bg-white p-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">Bulan</th>
                                                    <th>Jam masuk</th>
                                                    <th>Total jam</th>
                                                    <th>Max Jam</th>
                                                    <th>Hasil</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $bulan = 1;
                                                @endphp
                                                @forelse ($absen as $tr )
                                                    @php
                                                        $bulan++;
                                                    @endphp
                                                    
                                                <tr>
                                                    <td>{{$tr->bulan}}</td>
                                                    <td>{{$tr->jam_masuk}}</td>
                                                    <td>{{$tr->total_jam}}</td>  
                                                    <td></td>   
                                                    <td>{{$tr->hasil}}</td>                                                    
                                                </tr>
                                                @empty
                                                    
                                                @endforelse
                                                <tr>
                                                    <form action="{{route('absenStore')}}" method="POST">
                                                    @csrf
                                                    <td>
                                                        <input class="form-control" name="id_user" value="{{$data->id}}" type="hidden">
                                                        <input class="form-control" name="bulan" value="{{$bulan}}" type="hidden">
                                                        {{$bulan}}
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="jam" type="time" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="tot" type="number" >
                                                    </td>
                                                    <td>
                                                        @if(!empty(session('jam_max')))
                                                            <input class="form-control" value="{{session('jam_max')}}" name="max" type="number" readonly>
                                                        @else
                                                        <input class="form-control" name="max" type="number" >
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                    </td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            
                                <!-- Detail -->
                                <div class="tab-pane" id="profile-tab-bordered-1">
                                    <div class="contact-details-profile pd-lr-30">
                                        <h4>Profile</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Nama</h6>
                                                <p class="mr-t-0">{{$data->nama}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Username</h6>
                                                <p class="mr-t-0">{{$data->username}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Jenis kelamin</h6>
                                                <p class="mr-t-0">{{$data->jenkel}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Alamat</h6>
                                                <p class="mr-t-0">{{$data->alamat}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Alamat KTP</h6>
                                                <p class="mr-t-0">{{$data->alamat_ktp}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon</h6>
                                                <p class="mr-t-0">{{$data->telepon}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon WA</h6>
                                                <p class="mr-t-0">{{$data->telepon_wa}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tempat lahir</h6>
                                                <p class="mr-t-0">{{$data->tmpt_lahir}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tanggal lahir</h6>
                                                <p class="mr-t-0">{{$data->tgl_lahir}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Usia</h6>
                                                <p class="mr-t-0">{{$data->usia}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">status_keluarga</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->status_keluarga)
                                                        @case(1)
                                                            Menikah
                                                            @break
                                                        @case(2)
                                                            Belum menikah
                                                            @break
                                                        
                                                        @default
                                                    @endswitch
                                            </div>
                                        
                                        <hr class="mr-tb-50">

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Sekolah</h6>
                                                <p class="mr-t-0">{{$data->sekolah}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Pendidikan</h6>
                                                <p class="mr-t-0">{{$data->pendidikan}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Jurusan</h6>
                                                <p class="mr-t-0">{{$data->jurusan}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Rekening</h6>
                                                <p class="mr-t-0">{{$data->rekening}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Npwp</h6>
                                                <p class="mr-t-0">{{$data->npwp}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bpjs tenaga kerja</h6>
                                                <p class="mr-t-0">{{$data->bpjs_tk}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bpjs kesehatan</h6>
                                                <p class="mr-t-0">{{$data->bpjs_kes}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Cuti</h6>
                                                <p class="mr-t-0">{{$data->cuti}}</p>
                                            </div>

                                        </div>
                                        
                                        <hr class="mr-tb-50">

                                        <h4>Informasi</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Pangkat</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->pangkat)
                                                        @case(1)
                                                            Direktur
                                                            @break
                                                        @case(2)
                                                            Manager
                                                            @break
                                                        @case(3)
                                                            Supervisor
                                                            @break
                                                        @case(4)
                                                            Officer
                                                            @break
                                                    
                                                        @default
                                                        
                                                    @endswitch
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Level</h6>
                                                <p class="mr-t-0">{{$data->level}}
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Divisi</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->id_divisi)
                                                        @case(1)
                                                            HR
                                                            @break
                                                        @case(2)
                                                            Budimark
                                                            @break
                                                        @case(3)
                                                            MySch
                                                            @break
                                                        @case(4)
                                                            Makin mahir
                                                            @break
                                                        @case(5)
                                                            Dev
                                                            @break
                                                        @default
                                                    @endswitch
                                                
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Jabatan</h6>
                                                <p class="mr-t-0">{{$data->jabatan}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Status kerja</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->status_kerja)
                                                        @case(1)
                                                            Karyawan tetap
                                                            @break
                                                        @case(2)
                                                            Karyawan tidak tetap
                                                            @break
                                                        @case(3)
                                                            Karyawan kontrak
                                                            @break
                                                        @case(4)
                                                            Karyawan freelancer
                                                            @break
                                                        @case(5)
                                                            Training
                                                            @break
                                                        @case(6)
                                                            Magang
                                                            @break
                                                        @default
                                                    @endswitch
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Habis kontrak</h6>
                                                <p class="mr-t-0">{{$data->habis_kontrak}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Reminder habis kontrak</h6>
                                                <p class="mr-t-0">{{$data->reminder_habis_kontrak}}</p>
                                            </div>
                                        </div>
                                        <hr class="border-0 mr-tb-50">
                                    </div>
                                </div>
                                <!-- End Detail -->

                                <!-- Edit -->
                                <div class="tab-pane" id="edit-tab-bordered-1">
                                    <form class="form-material pt-3" action="{{route('karyawanUpdate')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="media align-items-center p-3 mb-4 bg-light-grey">
                                            <div class="d-flex mr-4 w-25 justify-content-end">
                                                <figure class="mb-0 thumb-md">
                                                    <img src="{{ asset($data->foto) }}" class="img-thumbnail">
                                                </figure>
                                            </div>
                                            <!-- /.d-flex -->
                                            <div class="media-body w-75">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="file" id="logo">
                                                    <label for="exampleInputFile">File input</label>
                                                </div>
                                            </div>
                                            <!-- /.media-body -->
                                        </div>
                                        <!-- /.media -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="{{$data->id}}" name="id" id="id" aria-describedby="emailHelp">
                                                    <input type="text" class="form-control" value="{{$data->nama}}" name="nama" id="nama" aria-describedby="emailHelp">
                                                    <label>Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->cuti}}" name="cuti" id="cuti" aria-describedby="emailHelp">
                                                    <label>Cuti</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->username}}" name="username" id="usernama" aria-describedby="emailHelp">
                                                    <label>Username</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->nik}}" name="nik" id="usernama" aria-describedby="emailHelp">
                                                    <label>NIK</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- alamat --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->alamat}}" name="alamat" id="usernama" aria-describedby="emailHelp">
                                                    <label>Alamat</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->alamat_ktp}}" name="alamat_ktp" id="usernama" aria-describedby="emailHelp">
                                                    <label>Alamat KTP</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- tmpt tgl lahir --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->tmpt_lahir}}" name="tmpt_lahir" id="email">
                                                    <label for="example-email">Tempat lahir</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="tgl_lahir" value="{{$data->tgl_lahir}}" class="form-control form-control-line">
                                                    <label>Tanggal lahir</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- email --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="BCA 123 456 7890" name="rekening" value="{{$data->rekening}}" class="form-control form-control-line">
                                                    <label>Rekening</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email">
                                                    <label for="example-email">Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- telepon --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon_wa" value="{{$data->telepon_wa}}" class="form-control form-control-line">
                                                    <label>Telepon WA</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon" value="{{$data->telepon}}" class="form-control form-control-line">
                                                    <label>Telepon</label>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- pendidikan sekolah --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->pendidikan}}" name="pendidikan" id="email">
                                                    <label for="example-email">Pendidikan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="sekolah" value="{{$data->sekolah}}" class="form-control form-control-line">
                                                    <label>Sekolah</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->jurusan}}" name="jurusan" id="email">
                                                    <label for="example-email">Jurusan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select id="keluarga" class="form-control" value="{{$data->status_keluarga}}" name="status_keluarga">
                                                        <option value="{{$data->status_keluarga}}">Pilih</option>
                                                        <option value="1">Menikah</option>
                                                        <option value="2">Belum menikah</option>
                                                    </select>
                                                    <label for="keluarga">Status keluarga</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select id="jk" class="form-control" value="{{$data->jenkel}}" name="jenkel">
                                                    <option value="{{$data->jenkel}}">Pilih</option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                                <label for="jk">Jenis kelamin</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->usia}}" name="usia" id="email">
                                                    <label for="example-email">Usia</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- npwp kpj bpjs --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->npwp}}" name="npwp" id="email">
                                                    <label for="example-email">NPWP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="bpjs_kes" value="{{$data->bpjs_kes}}" class="form-control form-control-line">
                                                    <label>BPJS Kes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->bpjs_tk}}" name="bpjs_tk" id="email">
                                                    <label for="example-email">BPJS TK</label>
                                                </div>
                                            </div>
                                        </div>

                                
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->jabatan}}" name="jabatan" id="usernama" aria-describedby="emailHelp">
                                            <label>Jabatan</label>
                                        </div>
                                        
                                        <div class="row">  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="status_kerja" value="{{$data->status_kerja}}">
                                                        <option value="{{$data->status_kerja}}">Pilih</option>
                                                        <option value="1">Karyawan tetap</option>
                                                        <option value="2">Karyawan tidak tetap</option>
                                                        <option value="3">Karyawan kontrak</option>
                                                        <option value="4">Karyawan freelancer</option>
                                                        <option value="5">Training</option>
                                                        <option value="6">Magang</option>
                                                    </select>
                                                    <label for="l38">Status kerja</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="pangkat" value="{{$data->pangkat}}">
                                                        <option value="{{$data->pangkat}}">Pilih</option>
                                                        <option value="1">Direktur</option>
                                                        <option value="2">Manager</option>
                                                        <option value="3">Supervisor</option>
                                                        <option value="4">Officer</option>
                                                    </select>
                                                    <label for="l38">Pangkat</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- date --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" class="form-control" value="{{$data->tgl_masuk_grup}}" name="tgl_masuk_grup" id="email">
                                                    <label for="example-email">Tanggal masuk grup</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="tgl_masuk" value="{{$data->tgl_masuk}}" class="form-control form-control-line">
                                                    <label>Tanggal masuk</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" class="form-control" value="{{$data->habis_kontrak}}" name="habis_kontrak" id="email">
                                                    <label for="example-email">Habis kontrak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="reminder_habis_kontrak" value="{{$data->remider_habis_kontrak}}" class="form-control">
                                                    <label>Reminder habis kontrak</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- alamat --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="id_divisi" id="l13">
                                                        <option value="{{$data->id_divisi}}">Pilih</option>
                                                        @foreach ($divisi as $us )
                                                            <option value="{{$us['id']}}">{{$us['nama']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="l38">Divisi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control" name="level" id="l13">
                                                        <option value="{{$data->level}}">Pilih</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <label for="l38">Level</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control" value="{{$data->edukasi_pekanan}}" name="edukasi_pekanan">
                                                        <option value="{{$data->edukasi_pekanan}}">Pilih</option>
                                                        <option value="1">Aktif</option>
                                                        <option value="2">Tidak aktif</option>
                                                    </select>
                                                    <label for="l38">Edukasi pekanan</label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="form-group">
                                            <button class="btn btn-success ripple">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Edit -->
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
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );



</script>


@endsection