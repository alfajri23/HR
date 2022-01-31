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
                <h5 class="box-title">Riwayat perizinan {{$bulan}}</h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                      Bulan
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 1]) }}">Januari</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 2]) }}">Februari</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 3]) }}">Maret</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 4]) }}">April</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 5]) }}">Mei</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 6]) }}">Juni</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 7]) }}">Juli</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 8]) }}">Agustus</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 9]) }}">September</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 10]) }}">Oktober</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 11]) }}">November</a>
                        <a class="dropdown-item" href="{{ route('izinHistori',['bulan'=> 12]) }}">Desember</a>
                    </div>
                  </div>
                </div>
                
                    

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 3%">No</th>
                            <th style="width: 11%">Nama</th>
                            <th style="width: 11%">Tanggal mulai</th>
                            <th style="width: 11%">Tanggal akhir</th>
                            <th style="width: 10%">Tipe</th>
                            <th>Alasan</th>
                            <th style="width: 5%">Hari</th>
                            <th style="width: 5%">Ganti jam</th>
                            <th style="width: 10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($izin as $iz )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$iz->user->nama}}</td>
                                <td>{{$iz->tanggal_mulai}}</td>
                                <td>{{$iz->tanggal_akhir}}</td>
                                <td>{{$iz->tipe}}</td>
                                <td>{{$iz->alasan}}</td>
                                <td>{{$iz->hari}}</td>
                                <td>{{$iz->ganti_jam == 1 ? 'ya' : 'tidak'}}</td>
                                <td>
                                    @if ($iz->status == 0)
                                        <span class="badge badge-pill badge-warning">pending</span> 
                                    @elseif ($iz->status == 1)
                                        <span class="badge badge-pill badge-success">diterima</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center"> tidak ada data</td>
                        </tr>
                            
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>


</div>




@endsection