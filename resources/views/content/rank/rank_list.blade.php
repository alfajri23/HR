@extends('layouts.apps')

@section('sidebar')
    @hasrole('admin')
    @include('includes.sidebar.admin')
    @endhasrole
    @hasrole('user|user_manager')
    @include('includes.sidebar.user')
    @endhasrole
@endsection

@section('content')
<style>
    .card:hover{
        background-color: aliceblue;
    }
</style>
<h4>Ranking</h4>
<div class="row">
    
    @foreach ($bulan as $i => $bln)
    <a class="col-sm-3 mr-b-20" href="{{route('rankDetail',$i)}}">
        <div class="card">
            <div class="card-body d-flex justify-content-between" style="
                height: 100px;
            ">
                <span>
                    <h5 class="card-title">{{$bln}}</h5>
                    {{-- <i class="fas fa-medal fa-lg"></i>  --}}
                </span>
                <span class="d-flex flex-column align-items-center">
                    
                    @if ($i > count($top))
                    <h6></h6>
                    @else
                    <div href="#" class="user--online thumb-xs">
                        <img src="{{asset($top[$i - 1]->user->foto)}}" class="rounded-circle" alt="">
                    </div>
                    <h6 class="mb-0 mt-1">{{$top[$i - 1]->user->nama}} <i class="fas fa-medal fa-lg" style="color: gold"></i></h6>
                    @endif
                </span>
                
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection