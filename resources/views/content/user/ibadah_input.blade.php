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
    <div class="container bg-white p-3">
        
        
        @if ($status == 1)
            <h4 class="text-center mb-4">Evaluasi amal harian pekan {{$pekan}}</h4>
            <a href="{{route('ibadahHistory')}}" class="btn btn-primary btn-input btn-sm mb-2">Riwayat</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th style="width: 5%">Ya</th>
                        <th style="width: 5%">Tidak</th>
                    </tr>
                </thead>
                <form action="{{route('ibadahInputStore')}}" method="POST">
                @csrf
                <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{$dt->nama}}</td>
                        <td>
                            <div class="clearfix">
                            <input class="form-check-input ml-0" type="radio" name="gridRadios-{{$loop->iteration}}" id="gridRadios-{{$loop->iteration}}" value="1">
                            </div>
                        </td>
                        <td>
                            <div>
                            <input class="form-check-input ml-0" type="radio" name="gridRadios-{{$loop->iteration}}" id="gridRadios-{{$loop->iteration}}" value="0">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
                
            </table>
            <span class="clearfix">
                <button type="submit" class="btn btn-success btn-md float-right">Kirim</button>
            </span>
                
            </form>
        @else
        <div class="row flex-column align-items-center">
            <h4>Input evaluasi amal harian hanya</h4>
            <h4>dibuka hari jumat dan sabtu</h4>
        </div>
            
        @endif
        

    </div>

@endsection