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
            <h4 class="text-center mb-4">Evaluasi amal harian pekan {{$pekan}} <br> Bulan {{$bulan}}</h4>
            
            <div class="dropdown">
                <button class="btn btn-outline-dark btn-sm dropdown-toggle mb-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    Pilihan bulan
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 1] ) }}">Januari</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 2] ) }}">Februari</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 3] ) }}">Maret</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 4] ) }}">April</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 5] ) }}">Mei</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 6] ) }}">Juni</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 7] ) }}">Juli</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 8] ) }}">Agustus</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 9] ) }}">September</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 1] ) }}">Oktober</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 1] ) }}">November</a>
                    <a class="dropdown-item" href="{{route('ibadahInput',['bulan'=> 1] ) }}">Desember</a>
                </div>
            </div>

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
                <div class=" float-right">
                    <a href="{{route('ibadahHistory')}}" class="btn btn-primary btn-input btn-sm mb-2">Riwayat</a>
                    <button type="submit" class="btn btn-success btn-md">Kirim</button>
                </div>
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