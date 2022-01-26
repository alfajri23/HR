@extends('layouts.apps')

@section('sidebar')
@hasanyrole('user|user_manager')
@include('includes.sidebar.user')
@endhasrole

@hasrole('admin')
@include('includes.sidebar.admin')
@endhasrole
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-4 widget-holder">
        <div class="widget-bg">
            <div class="widget-body clearfix">
                <div class="contact-info">
                    <header class="text-center">
                        <div class="text-center">
                            <img class="rounded-circle img-thumbnail" src="{{ asset($divisi->logo) }}" alt="">   
                        </div>
                        <h4 class="mt-1"><a href="#">{{$divisi->nama}}</a> <span class="badge text-uppercase badge-warning align-middle">Pro</span></h4>
                        
                    </header>
                    <section class="padded-reverse">
                        <h5>Detail <small class="float-right">Divisi: <strong>{{$divisi->nama}}</strong></small></h5>
                        <div class="row text-center">
                            <div class="col-12"><span>{{count($divisi->objectives)}}</span>
                                <br><small>Objective</small>
                            </div>
                            {{-- <div class="col-4"><span></span>
                                <br><small>Progress</small>
                            </div>
                            <div class="col-4"><span></span>
                                <br><small>Selesai</small>
                            </div> --}}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 widget-holder widget-full-height">
        <div class="widget-bg">
            <div class="widget-body clearfix">
                <h5 class="box-title">Ranking OKR Divisi {{$divisi->nama}}</h5>
                <ul class="list-unstyled widget-user-list mb-0">
                    @foreach ($data as $dt)
                    <li class="media d-flex align-items-center"> 
                        <h5 class="mr-2 my-0">{{$loop->iteration}}</h5>
                        <div class="d-flex mr-3">
                            <a href="#" class="user--online thumb-xs">
                                <img src="{{asset($dt['user']->foto)}}" class="rounded-circle" alt="">
                            </a>
                        </div>
                        <div class="media-body d-flex justify-content-between">
                            <h5 class="media-heading">
                                @hasanyrole('admin|user_manager')
                                <a href="{{route('karyawanDetail',$dt['user']->id)}}">{{$dt['user']->nama}}</a> 
                                @endhasrole
                                @hasanyrole('user')
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
</div>

@endsection 