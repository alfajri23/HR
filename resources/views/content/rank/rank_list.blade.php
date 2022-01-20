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
<h4>Ranking bulan</h4>
<div class="row">
    
    @foreach ($bulan as $i => $bln)
    <a class="col-sm-3 mr-b-20" href="{{route('rankDetail',$i)}}">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title">{{$bln}}</h5>
                <i class="fas fa-medal fa-lg"></i>
                
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection