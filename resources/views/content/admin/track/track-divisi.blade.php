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
<div class="row">
    <div class="col-md-5 widget-holder widget-full-height">
        <div class="widget-bg">
            <div class="widget-body clearfix">
                <h5 class="box-title">Ranking Divisi {{$divisi->nama}}</h5>
                <ul class="list-unstyled widget-user-list mb-0">
                    @foreach ($data as $dt)
                    
                        <li class="media"> 
                            <div class="d-flex mr-3">
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($dt['user']->foto)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body"><a href="#" class="btn btn-outline-{{ ($dt['progres'] >= 70) ? "success" : (($dt['progres'] < 70 && $dt['progres'] >= 40)  ? "secondary" : "danger") }}">{{$dt['progres']}}%</a>
                                <h5 class="media-heading">
                                    @hasrole('admin')
                                    <a href="{{route('karyawanDetail',$dt['user']->id)}}">{{$dt['user']->nama}}</a> 
                                    @endhasrole
                                    @hasrole('user')
                                    <a >{{$dt['user']->nama}}</a> 
                                    @endhasrole
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
</div>

@endsection 