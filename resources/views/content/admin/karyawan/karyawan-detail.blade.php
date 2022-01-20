@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
        <div class="container-fluid d-flex">

            @php
                $done = 0;
                $progres_tot = 0;
                foreach ($track as $tr){
                    //dd($tr);
                
                    $progres = 0;
                    $target = $tr->target;
                    $bobot = $tr->bobot;
                    $week = explode(",",$tr->week_1);
                    //dd($week);
                    foreach ($track as $tr){
                    $progres_tot += $tr->progres; 
                }

                if(count($track) == 0){
                    $progres_tot = 0;
                }else{
                    $progres_tot = round($progres_tot);
                }
                }

                if(count($track) == 0){
                    $progres_tot = 0;
                }else{
                    $progres_tot = $progres_tot/count($track);
                    $progres_tot = round($progres_tot);
                }
                    

            @endphp


           
            <div class="col-12 col-md-12 widget-holder">
                <div class="widget-bg">
                    <ul class="list-unstyled widget-user-list card-body">
                        <li class="media">
                            <div class="d-flex mr-3">
                                <a href="#" class="user--online thumb-xs">
                                    <img src="{{asset($data->foto)}}" class="rounded-circle" alt="">
                                </a>
                            </div>
                            <div class="media-body d-flex justify-content-between">        
                                <h5 class="media-heading">
                                    <a href="#">{{$data->nama}}</a> 
                                    <small>{{$data->username}}</small>
                                    <small>{{$data->divisi->nama}}</small>
                                </h5>
                                <span class="btn-group mr-b-20">
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{count($track)}}</p>
                                        <p class="mb-0">Key result</p>
                                    </button>
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{round($progres_tot)}}%</p>
                                        <p class="mb-0">Progres</p>
                                    </button>
                                    <button type="button" class="btn btn-outline-default ripple">
                                        <p class="mb-0">{{$done}}</p>
                                        <p class="mb-0">Done</p>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="widget-body clearfix">
                        <div class="tabs mr-t-10">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#home-tab-bordered-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Activity</a>
                                </li>
                                <li class="nav-item"><a href="#okr-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">OKR</a>
                                </li>
                                <li class="nav-item"><a href="#profile-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
                                <li class="nav-item"><a href="#edit-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Edit</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Progress -->
                                <div class="tab-pane active" id="home-tab-bordered-1">
                                    <div class="container bg-white p-3">
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
                                                    
                                                    @for($i = 0; $i < 5; $i++)
                                                        @if (empty($week[$i]))
                                                        <td>
                                                            
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
                                        </table>
                                    </div>
                                </div>
                                <!-- End Progress -->

                                {{-- OKR --}}
                                <div class="tab-pane" id="okr-tab-bordered-1">
                                    <h4>OKR</h4>
                                    <div class="row">
                                        @foreach ($bulan as $i => $bln)
                                        <a class="col-sm-3 mr-b-20" href="{{route('trackUser',['id' =>$data->id, 'm' => $loop->iteration])}}">
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
                                </div>

                                <!-- Detail -->
                                <div class="tab-pane" id="profile-tab-bordered-1">
                                    <div class="contact-details-profile pd-lr-30">
                                        <h4>Profile</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Nama</h6>
                                                <p class="mr-t-0">{{$data->nama}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Username</h6>
                                                <p class="mr-t-0">{{$data->username}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Alamat</h6>
                                                <p class="mr-t-0">{{$data->alamat}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon</h6>
                                                <p class="mr-t-0">{{$data->telepon}}</p>
                                            </div>
                                            
                                        </div>
                                        
                                        <hr class="mr-tb-50">

                                        <h4>Informasi</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tempat lahir</h6>
                                                <p class="mr-t-0">{{$data->tmpt_lahir}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tanggal lahir</h6>
                                                <p class="mr-t-0">{{$data->tgl_lahir}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Status</h6>
                                                <p class="mr-t-0">{{$data->status}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bank</h6>
                                                <p class="mr-t-0">{{$data->id_bank}}</p>
                                            </div>
                                        </div>
                                        <hr class="border-0 mr-tb-50">
                                    </div>
                                </div>
                                <!-- End Detail -->

                                <!-- Edit -->
                                <div class="tab-pane" id="edit-tab-bordered-1">
                                    <form class="form-material pt-3" action="{{route('karyawanUpdate')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="media align-items-center p-3 mb-4 bg-light-grey">
                                            <div class="d-flex mr-4 w-25 justify-content-end">
                                                <figure class="mb-0 thumb-md">
                                                    <img src="{{ asset($data->foto) }}" class="img-thumbnail">
                                                </figure>
                                            </div>
                                            <!-- /.d-flex -->
                                            <div class="media-body w-75">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="file" id="logo">
                                                    <label for="exampleInputFile">File input</label>
                                                </div>
                                            </div>
                                            <!-- /.media-body -->
                                        </div>
                                        <!-- /.media -->
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" value="{{$data->id}}" name="id" id="id" aria-describedby="emailHelp">
                                            <input type="text" class="form-control" value="{{$data->nama}}" name="nama" id="nama" aria-describedby="emailHelp">
                                            <label>Nama</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->username}}" name="username" id="usernama" aria-describedby="emailHelp">
                                            <label>Username</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" value="{{$data->nik}}" name="nik" id="usernama" aria-describedby="emailHelp">
                                            <label>NIK</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->kantor}}" name="kantor" id="usernama" aria-describedby="emailHelp">
                                            <label>Kantor</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->pangkat}}" name="pangkat" id="usernama" aria-describedby="emailHelp">
                                            <label>pangkat</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->jabatan}}" name="jabatan" id="usernama" aria-describedby="emailHelp">
                                            <label>jabatan</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->fungsi}}" name="fungsi" aria-describedby="emailHelp">
                                            <label>Fungsi</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->usia}}" name="usia" id="email">
                                                    <label for="example-email">Usia</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" name="status_kerja" value="{{$data->status_kerja}}" class="form-control form-control-line">
                                                    <label>Status kerja</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- date --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" class="form-control" value="{{$data->tgl_masuk_grup}}" name="tgl_masuk_grup" id="email">
                                                    <label for="example-email">Tanggal masuk grup</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="tgl_masuk" value="{{$data->tgl_masuk}}" class="form-control form-control-line">
                                                    <label>Tanggal masuk</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" class="form-control" value="{{$data->habis_kontrak}}" name="habis_kontrak" id="email">
                                                    <label for="example-email">Habis kontrak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="remider_habis_kontrak" value="{{$data->remider_habis_kontrak}}" class="form-control form-control-line">
                                                    <label>Reminder habis kontrak</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->tmpt_lahir}}" name="tmpt_lahir" id="email">
                                                    <label for="example-email">Tempat lahir</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input onfocus="(this.type='date')" type="text" name="tgl_lahir" value="{{$data->tgl_lahir}}" class="form-control form-control-line">
                                                    <label>Tanggal lahir</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- direktorat kota rekruit --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->direktorat}}" name="direktorat" id="email">
                                                    <label for="example-email">Direktorat</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="kota_rekrutmen" value="{{$data->kota_rekrutmen}}" class="form-control form-control-line">
                                                    <label>Kota rekrutmen</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- pendidikan sekolah --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->pendidikan}}" name="pendidikan" id="email">
                                                    <label for="example-email">Pendidikan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="sekolah" value="{{$data->sekolah}}" class="form-control form-control-line">
                                                    <label>Sekolah</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->jurusan}}" name="jurusan" id="email">
                                                    <label for="example-email">Jurusan</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- npwp kpj bpjs --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->npwp}}" name="npwp" id="email">
                                                    <label for="example-email">NPWP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="kpj" value="{{$data->kpj}}" class="form-control form-control-line">
                                                    <label>KPJ</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->bpjs}}" name="bpjs" id="email">
                                                    <label for="example-email">BPJS</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select id="keluarga" class="form-control" value="{{$data->status_keluarga}}" name="status_keluarga">
                                                        <option value="1">Menikah</option>
                                                        <option value="2">Belum menikah</option>
                                                    </select>
                                                    <label for="keluarga">Status keluarga</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <select id="jk" class="form-control" value="{{$data->jenkel}}" name="jenkel">
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                                <label for="jk">Jenis kelamin</label>
                                            </div>
                                            </div>
                                        </div>

                                        {{-- MK --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->MK_thn}}" name="MK_thn" id="email">
                                                    <label for="example-email">MK Tahun</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="number" name="MK_bln" value="{{$data->MK_bln}}" class="form-control form-control-line">
                                                    <label>MK bulan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select class="form-control" value="{{$data->edukasi_pekanan}}" name="edukasi_pekanan">
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak aktif</option>
                                                </select>
                                                <label for="l38">Edukasi pekanan</label>
                                            </div>
                                            </div>
                                        </div>

                                        {{-- email --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email">
                                                    <label for="example-email">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$data->email_2}}" name="email_2" id="email_2">
                                                    <label for="example-email">Email External</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon" value="{{$data->telepon}}" class="form-control form-control-line">
                                                    <label>Telepon</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- alamat --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->alamat}}" name="alamat" id="usernama" aria-describedby="emailHelp">
                                                    <label>Alamat</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->alamat_ktp}}" name="alamat_ktp" id="usernama" aria-describedby="emailHelp">
                                                    <label>Alamat KTP</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- alamat --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control" name="id_divisi" id="l13">
                                                        @foreach ($divisi as $us )
                                                            <option value="{{$us['id']}}">{{$us['nama']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="l38">Divisi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control" name="level" id="l13">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <label for="l38">Level</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="string" placeholder="123 456 7890" name="rekening" value="{{$data->rekening}}" class="form-control form-control-line">
                                                    <label>Rekening</label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="form-group">
                                            <button class="btn btn-success ripple">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Edit -->
                            </div>
                            <!-- End tab-content -->
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            <!-- End col-12 -->
            
        </div>
        
{{-- </div> --}}


@endsection