@extends('layouts.apps')

@section('sidebar')
    @hasrole('user')
        @include('includes.sidebar.user')
    @endhasrole
    
    @hasrole('admin')
        @include('includes.sidebar.admin')
    @endhasrole
    
@endsection

@section('content')
{{-- <div class="widget-list"> --}}
        <div class="container-fluid d-flex">
            <!-- User Summary -->
            <div class="col-12 col-md-4 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        
                        {{-- Profile --}}
                        <div class="contact-info">
                            <header class="text-center">
                                
                                <!-- /.dropdown -->
                                <div class="text-center">
                                   
                                    <img class="rounded-circle img-thumbnail" src="{{ asset($data->foto) }}" alt="">
                                    
                                </div>
                                <h4 class="mt-1"><a href="#">{{$data->nama}}</a> <span class="badge text-uppercase badge-warning align-middle">Pro</span></h4>
                                <div class="contact-info-address"><i class="fas fa-map"></i>
                                    <p>{{$data->divisi->nama}}</p>
                                </div>
                            </header>
                            
                            @php
                                $done = 0;
                                $progres_tot = 0;
                                foreach ($track as $tr){
                                
                                    $progres = 0;
                                    $target = $tr->target;
                                    $week = explode(",",$tr->week_1);
                                    foreach($week as $tr ){
                                        $progres += (int)$tr;
                                    }
                                    
                                    $progres = $progres/$target * 100;
                                    if($progres >= 100){
                                        $done += 1;
                                    } 
                                    $progres_tot += $progres; 
                                }
                                    $progres_tot = $progres_tot/count($track);
                                    $progres_tot = round($progres_tot);
         
                            @endphp

                            <section class="padded-reverse">
                                <h5>Detail <small class="float-right">Divisi: <strong>{{$data->divisi->nama}}</strong></small></h5>
                                <div class="row text-center">
                                    <div class="col-4"><span>{{count($track)}}</span>
                                        <br><small>Key Result</small>
                                    </div>
                                    <div class="col-4"><span>{{$progres_tot}}%</span>
                                        <br><small>Progress</small>
                                    </div>
                                    <div class="col-4"><span>{{$done}}</span>
                                        <br><small>Selesai</small>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!--Contact-End -->

                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>


           
            <div class="col-12 col-md-8 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="tabs mr-t-10">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#home-tab-bordered-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Activity</a>
                                </li>
                                <li class="nav-item"><a href="#okr-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">OKR</a>
                                </li>
                                <li class="nav-item"><a href="#profile-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
                                <li class="nav-item"><a href="#edit-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Edit</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Progress -->
                                <div class="tab-pane active" id="home-tab-bordered-1">
                                    <div class="row">
                                        @foreach ($track as $tr)
                                        <div class="col-md-12 mr-b-30">
                                            <div class="card card-default">
                                                <div class="card-header bg-white">
                                                    <span>
                                                        <h5 class="card-title mt-0 mb-3">{{$tr->id}} - {{$tr->kode_key}} - {{$tr->keyResult->nama}}</h5>
                                                    </span>
                                                    
                                                    <span class="float-right">
                                                        <p class="float-right my-0">Bobot: <strong>{{$tr->bobot}}  </strong></p>
                                                        <p class="float-right my-0">Target: <strong>{{$tr->target}} </strong></p>
                                                    </span>
                                                </div>
                                                @php
                                                    $id_track = 0;
                                                    $id_track = $tr->id;
                                                    $progres = 0;
                                                    $target = $tr->target;

                                                    if($tr->week_1 != null){
                                                        $week = explode(",",$tr->week_1);
                                                        foreach($week as $tr ){
                                                            $progres += (int)$tr;
                                                        }
                                                        $progres = $progres/$target * 100;
                                                        $progres = round($progres);
                                                    }else {
                                                        $week = [];
                                                        $progres = 0;
                                                        //dd($week);
                                                    }
                                                    
                                                    
                                                @endphp

                                                <div class="card-body">
                                                    <div class="row text-center align-items-center">
                                                        @php
                                                            $minggu = 1;
                                                        @endphp

                                                        @forelse ($week as $wk )
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Minggu {{$minggu}}- {{$wk}}</label>
                                                                    <input class="form-control" value="{{$wk}}" placeholder="" type="number" readonly>
                                                                </div>
                                                            </div>
                                                            @php
                                                                 $minggu++ ;
                                                            @endphp
                                                        @empty
                                                            <div class="col-md-2">
                                                                <form action="{{route('trackUpdate')}}" method="POST">
                                                                    @csrf
                                                                <div class="form-group">
                                                                    <label for="">Minggu 1</label>
                                                                    <input class="form-control" name="id" value="{{$id_track}}" type="hidden">
                                                                    <input class="form-control" name="week_no" value="0" type="hidden">
                                                                    <input class="form-control" name="week_val" value="" placeholder="" type="number">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="submit" class="btn btn-success ripple">Update</button>
                                                            </div>
                                                        </form>

                                                        @endforelse
                                                        
                                                        @if ($minggu < 6 && count($week) > 0)
                                                        
                                                            <div class="col-md-2">
                                                                <form action="{{route('trackUpdate')}}" method="POST">
                                                                    @csrf
                                                                <div class="form-group">
                                                                    <label for="">Minggu {{$minggu}}</label>
                                                                    <input class="form-control" name="id" value="{{$id_track}}" type="hidden">
                                                                    <input class="form-control" name="week_no" value="{{$minggu-1}}" type="hidden">
                                                                    <input class="form-control" name="week_val" value="" placeholder="" type="number">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="submit" class="btn btn-success ripple">Update</button>
                                                            </div>
                                                        </form>
                                                        
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="card-footer bg-white">
                                                    <div class="progress progress-md mt-4">
                                                        <div class="progress-bar bg-success" style="width: {{$progres}}%" role="progressbar">{{$progres}}%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Progress -->

                                {{-- OKR --}}
                                <div class="tab-pane" id="okr-tab-bordered-1">
                                    <h4>OKR</h4>
                                    <div class="row">
                                        @foreach ($bulan as $i => $bln)
                                        <a class="col-sm-4 mr-b-20" href="{{route('trackUser',['id' =>$data->id, 'm' => $loop->iteration])}}">
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
                                                <h6 class="text-muted text-uppercase">Alamat</h6>
                                                <p class="mr-t-0">{{$data->alamat}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon</h6>
                                                <p class="mr-t-0">{{$data->telepon}}</p>
                                            </div>
                                            
                                        </div>
                                        
                                        <hr class="mr-tb-50">

                                        <h4>Informasi</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tempat lahir</h6>
                                                <p class="mr-t-0">{{$data->tmpt_lahir}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tanggal lahir</h6>
                                                <p class="mr-t-0">{{$data->tgl_lahir}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Status</h6>
                                                <p class="mr-t-0">{{$data->status}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bank</h6>
                                                <p class="mr-t-0">{{$data->id_bank}}</p>
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
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" value="{{$data->id}}" name="id" id="id" aria-describedby="emailHelp">
                                            <input type="text" class="form-control" value="{{$data->nama}}" name="nama" id="nama" aria-describedby="emailHelp">
                                            <label>Nama</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->username}}" name="username" id="usernama" aria-describedby="emailHelp">
                                            <label>Username</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email">
                                                    <label for="example-email">Email</label>
                                                </div>
                                            </div>
                                            <!-- /.col-md-6 -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon" value="{{$data->telepon}}" class="form-control form-control-line">
                                                    <label>Telepon</label>
                                                </div>
                                            </div>
                                            <!-- /.col-md-6 -->
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->alamat}}" name="alamat" id="usernama" aria-describedby="emailHelp">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="id_divisi" id="l13">
                                                @foreach ($divisi as $us )
                                                    <option value="{{$us['id']}}">{{$us['nama']}}</option>
                                                @endforeach
                                            </select>
                                            <label for="l38">Divisi</label>
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


@endsection