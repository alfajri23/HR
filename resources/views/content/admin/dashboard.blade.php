@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking Karyawan Pekan Ini</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($data_pekan as $dt)
                        
                            <li class="media"> 
                                <div class="d-flex mr-3">
                                    <a href="#" class="user--online thumb-xs">
                                        <img src="{{asset($dt['user']->foto)}}" class="rounded-circle" alt="">
                                    </a>
                                </div>
                                <div class="media-body"><a href="#" class="btn btn-outline-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "secondary" : "danger") }}">{{$dt['progres']}}%</a>
                                    <h5 class="media-heading">
                                        <a href="{{route('trackUser',['id' =>$dt['user']->id, 'm' => date('m')])}}">{{$dt['user']->nama}}</a> 
                                        <small>{{$dt['user']->divisi->nama}}</small>
                                    </h5>
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

        <div class="col-md-5 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Ranking Divisi Pekan Ini</h5>
                    <ul class="list-unstyled widget-user-list mb-0">
                        @foreach ($divisi_data as $dt)
                        <li class="media">
                            <div class="d-flex mr-3">
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt['divisi']->logo)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body"><a href="#" class="btn btn-outline-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "secondary" : "danger") }}">{{$dt['progres']}}</a>
                                <h5 class="media-heading"><a href="{{route('trackDivisi',$dt['divisi']->id)}}">{{$dt['divisi']->nama}}</a> <small>{{$dt['divisi']->nama}}</small></h5>
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