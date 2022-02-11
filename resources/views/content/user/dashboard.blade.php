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
            background-image: cover;
            width: 45px !important;
            height:45px !important;
    }
</style>

    <div class="row flex-wrap">
        
        <div class="col-md-12 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking OKR Divisi Pekan Ini</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($divisi_data as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <h5 class="mr-2">{{$loop->iteration}}</h5>
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt['divisi']->logo)}}" class="rounded-circle" style="object-fit: cover;" alt="">
                                </a>
                            </div>
                            <div class="media-body d-flex justify-content-between">
                                {{-- <a href="#" class="btn btn-outline-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "secondary" : "danger") }}">{{$dt['progres']}}</a> --}}
                                <h5 class="media-heading"><a href="{{route('trackDivisi',$dt['divisi']->id)}}">{{$dt['divisi']->nama}}</a> <small>{{$dt['divisi']->nama}}</small></h5>
                                <div class="clearfix" style="width: 60%">
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "warning" : "danger") }}" style="width: {{$dt['progres']}}%" role="progressbar">{{$dt['progres']}}%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <div class="d-flex justify-content-between">
                        <h5 class="box-title">Ranking </h5>
                        <h6><i class="fas fa-info-circle" style="color: #51d2b7"></i>
                            <a href="{{route('dashboardDetail',date('m'))}}">Detail</a>
                        </h6>
                    </div>
                    
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($rank as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <h5 class="mr-2">{{$loop->iteration}}</h5>
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt['user']->foto)}}"  style="object-fit: cover;" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body d-flex justify-content-between">
                                
                                <h5 class="media-heading">
                                        @hasanyrole('admin|user_manager')
                                        <a href="{{route('karyawanDetail',$dt['user']->id)}}">{{$dt['user']->nama}}</a> 
                                        @endhasrole
                                        @hasrole('user')
                                        <a>{{$dt['user']->nama}}</a> 
                                        @endhasrole
                                    <small> 
                                        <a>{{$dt['user']->jabatan}}</a> <br>
                                        @switch($dt['user']->divisi->id)
                                            @case(1)
                                                <i style="color:rgb(166, 173, 68)" class="fas fa-male fa-lg mr-1"></i>
                                                @break
                                            @case(2)
                                                <img style="width: 20px"  src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/32/000000/external-owl-animals-dreamstale-lineal-dreamstale-1.png"/>
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
                                        <div class="progress-bar bg-{{ ($dt['hasil'] >= 70) ? "success" : (($dt['hasil'] < 70 && $dt['hasil'] >= 40)  ? "warning" : "danger") }}" style="width: {{$dt['hasil']}}%" role="progressbar">{{$dt['hasil']}}%</div>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        
    </div>
@endsection 