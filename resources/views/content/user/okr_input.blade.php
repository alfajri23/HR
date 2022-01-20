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
<style>
    p{
        margin: 0;
    }
</style>
<div class="container-fluid bg-white p-3">
    <div class="row">
        <div class="col-2">
            <p>Divisi</p>
            <p>Nama</p>
            <p class="mb-2">Jabatan</p>
        </div>
        <div class="col-8">
            <p>: {{$data->divisi->nama}}</p>
            <p>: {{$data->nama}}</p>
            <p class="mb-2">: {{$data->jabatan}}</p>
        </div>
        <div class="col-2">
            <h4 class="mt-0">{{$bulan}}</h4>
        </div>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 2px">No</th>
                <th>Kode</th>
                <th>Key result</th>
                <th>Bobot</th>
                <th>Target</th>
                <th>Start</th>
                <th>Pekan 1</th>
                <th>Pekan 2</th>
                <th>Pekan 3</th>
                <th>Pekan 4</th>
                <th>Pekan 5</th>
                <th>Progres</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tot_progres = 0;
            @endphp
            @foreach ($track as $tr )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$tr->kode_key}}</td>
                <td>{{$tr->keyResult->nama}}</td>
                <td>{{$tr->bobot}}</td>
                <td>{{$tr->target}}</td>
                <td>{{$tr->start}}</td>
                @php
                    if($tr->week_1 != null){
                        $week = explode(",",$tr->week_1);
                    }else {
                        $week = [];
                    }  
                @endphp
                <form action="{{route('trackUpdate')}}" method="POST">
                    @csrf
                @for($i = 0; $i < 5; $i++)
                    @if (empty($week[$i]))
                    <td>
                        <input class="form-control" name="id" value="{{$tr->id}}" type="hidden">
                        <input class="form-control" name="week_no[]" value="{{$i}}" type="hidden">
                        <input type="text" class="form-control" name="week_val[]" style="
                            width: 100px;
                            padding: 8px 2px;
                        ">
                    </td>
                    @else
                    <td>{{$week[$i]}}</td>
                    @endif
                    
                @endfor
                <td>
                    <p class="my-0">{{$tr->progres}}%</p>
                    <div class="progress" data-toggle="tooltip" title="{{$tr->progres}}%">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr->progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr->progres}}%"><span class="sr-only">{{$tr->progres}}%</span>
                        </div>
                    </div>
                    </td>
                <td>{{$tr->status}}</td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </td>
                </form>
            </tr>
            @php
                
                $tot_progres += $tr->progres;
            @endphp
            @endforeach
            <tr>
                <td colspan="11" class="text-center">Total progres</td>
                <td>
                    <p class="my-0">{{$tot_progres}}%</p>
                    <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                        </div>
                    </div></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
</div>





{{-- <a href="#" class="color-content"><i class="material-icons md-18">settings</i> </a><a href="#" class="color-content"><i class="material-icons md-18">clear</i></a> --}}

@endsection