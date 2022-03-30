@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
<div class="row">
    <h4 class="font-weight-bold mb-2 ml-4">Daftar Notifikasi</h4><br>
    <div class="col-12">

        <ul class="list-group list-group-flush">
            @forelse ($data as $dt)
            <li class="list-group-item">
                <p class="mb-0">{{$dt->nama}}</p>
                <small>{{$dt->created_at}}</small>
                
            </li>      
            @empty
                
            @endforelse
          </ul>
    </div>
</div>


@endsection