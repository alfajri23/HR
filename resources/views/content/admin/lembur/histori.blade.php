@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
    <div class="row">
        <div class="widget-holder col-md-12">
            <div class="widget-bg">
                <div class="widget-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="box-title">Riwayat lembur {{$bulan}}</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                              Bulan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 1]) }}">Januari</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 2]) }}">Februari</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 3]) }}">Maret</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 4]) }}">April</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 5]) }}">Mei</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 6]) }}">Juni</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 7]) }}">Juli</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 8]) }}">Agustus</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 9]) }}">September</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 10]) }}">Oktober</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 11]) }}">November</a>
                                <a class="dropdown-item" href="{{ route('lemburHistori',['bulan'=> 12]) }}">Desember</a>
                            </div>
                          </div>
                        </div>
                    </div>
                   

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%">No</th>
                                <th style="width: 11%">Nama</th>
                                <th style="width: 11%">Tanggal</th>
                                <th>Alasan</th>
                                <th style="width: 5%">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $jams = 0;
                            @endphp
                            @forelse ($lembur as $iz )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$iz->user->nama}}</td>
                                    <td>{{$iz->hari}}</td>
                                    <td>{{$iz->alasan}}</td>
                                    <td>{{$iz->jam}}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center"> tidak ada data</td>
                            </tr>
                                
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection