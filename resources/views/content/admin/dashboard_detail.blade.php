@extends('layouts.apps')

@section('sidebar')
    @hasrole('admin')
    @include('includes.sidebar.admin')
    @endhasrole
    @hasanyrole('user|user_manager')
    @include('includes.sidebar.user')
    @endhasrole
@endsection

@section('content')
<style>
    .rounded-circle{
            object-fit: cover;
            background-image: cover;
            width: 45px !important;
            height:45px !important;
    }
</style>
    <div class="row flex-wrap">
        <div class="col-md-6 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking OKR </h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($data_pekan as $dt)
                        
                            <li class="media d-flex align-items-center"> 
                                <h5 class="mr-2 my-0">{{$loop->iteration}}</h5>
                                <div class="d-flex mr-3">
                                    <a href="#" class="user--online thumb-xs">
                                        <img src="{{asset($dt['user']->foto)}}" class="rounded-circle" alt="">
                                    </a>
                                </div>
                                <div class="media-body d-flex justify-content-between">
                                    <h5 class="media-heading">
                                        @hasrole('admin')
                                        <a href="{{route('karyawanDetail',$dt['user']->id)}}">{{$dt['user']->nama}}</a> 
                                        @endhasrole
                                        @hasanyrole('user|user_manager')
                                        <a>{{$dt['user']->nama}}</a> 
                                        @endhasrole
                                        
                                        <small> 
                                            <a>{{$dt['user']->jabatan}}</a> <br>
                                            @switch($dt['user']->divisi->id)
                                                @case(1)
                                                    <i style="color:rgb(166, 173, 68)" class="fas fa-male fa-lg mr-1"></i>
                                                    @break
                                                @case(2)
                                                    @break
                                                @case(3)
                                                    <i style="color:rgb(81, 165, 165)" class="fas fa-graduation-cap fa-lg mr-1"></i>
                                                    @break
                                                @case(4)
                                                    <i style="color:rgb(49, 113, 233)" class="fab fa-monero fa-lg mr-1"></i>
                                                    @break
                                                @case(5)
                                                    <i style="color:rgb(218, 94, 207)" class="fab fa-dev fa-lg mr-1"></i>
                                                    @break
                                                @default
                                            @endswitch
                                            
                                            {{$dt['user']->divisi->nama}}
                                        </small>
                                    </h5>
                                    
                                    <div class="d-flex align-items-center" style="width:60%">
                                        
                                        
                                        <div class="progress progress-md" style="width: 100%">
                                            <div class="progress-bar bg-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "warning" : "danger") }}" style="width: {{$dt['progres']}}%" role="progressbar">{{$dt['progres']}}%</div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.widget-user-list -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>

        <div class="col-md-3 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking ibadah</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($ibadah as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <h5 class="mr-2">{{$loop->iteration}}</h5>
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt->user->foto)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body"><a href="#" class="btn btn-outline-default px-2">{{$dt->point}}</a>
                                <h5 class="media-heading"><a href="#">{{$dt->user->nama}}</a> <small>{{$dt->user->username}}</small></h5>
                            </div>
                            
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking absensi</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($absensi as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <h5 class="mr-2">{{$loop->iteration}}</h5>
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt->user->foto)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body"><a href="#" class="btn btn-outline-default px-2">{{$dt->hasil}}</a>
                                <h5 class="media-heading"><a href="{{route('karyawanDetail',$dt->user->id)}}">{{$dt->user->nama}}</a> <small>{{$dt->user->username}}</small></h5>
                            </div>
                            
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection 