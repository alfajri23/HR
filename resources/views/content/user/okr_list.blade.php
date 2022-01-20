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
    @foreach ($bulan as $i => $bln)
    <a class="col-sm-3 mr-b-20" href="{{route('trackKaryawan',['m' => $loop->iteration])}}">
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

@endsection