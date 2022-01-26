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
<h5>Daftar key result yang pernah kamu ambil</h5>
<div class="row">
    
    @foreach ($key_result as $key)
    <a class="col-3 mx-1 bg-white" href="{{route('resultDetail',$key->id)}}">
        <div class="clearfix">
            <h6 class="mb-0">Nama : {{$key->nama}}</h6>
            <h6 class="mt-1 mb-3">Kode : {{$key->kode}}</h6>
        </div>
    </a>
    @endforeach
    
</div>

@endsection