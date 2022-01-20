@extends('layouts.apps')

@section('sidebar')
    @hasrole('admin')
    @include('includes.sidebar.admin')
    @endhasrole
    @hasrole('user')
    @include('includes.sidebar.user')
    @endhasrole
@endsection

@section('content')
    <div class="row flex-wrap">
        <div class="col-12 mb-2">
            <h3>{{$bulan}} {{date('Y')}}</h3>
        </div>
        
        <div class="col-md-12 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking Karyawan</h5>
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
                                        @hasrole('user')
                                        <a>{{$dt['user']->nama}}</a> 
                                        @endhasrole
                                        <small>{{$dt['user']->divisi->nama}}</small>
                                    </h5>
                                    <div class="clearfix" style="width: 80%">
                                        <div class="progress progress-md">
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

        <div class="col-md-12 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking Divisi</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($divisi_data as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <h5 class="mr-2">{{$loop->iteration}}</h5>
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt['divisi']->logo)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body d-flex justify-content-between">
                                {{-- <a href="#" class="btn btn-outline-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "secondary" : "danger") }}">{{$dt['progres']}}</a> --}}
                                <h5 class="media-heading"><a href="{{route('trackDivisi',$dt['divisi']->id)}}">{{$dt['divisi']->nama}}</a> <small>{{$dt['divisi']->nama}}</small></h5>
                                <div class="clearfix" style="width: 80%">
                                    <div class="progress progress-md">
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
    </div>
@endsection 