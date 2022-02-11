@extends('layouts.apps')

@section('sidebar')
    @hasrole('user|user_manager')
        @include('includes.sidebar.user')
    @endhasrole

    @hasrole('admin')
        @include('includes.sidebar.admin')
    @endhasrole
    
@endsection

@section('content')
{{-- <div class="widget-list"> --}}
        <div class="container-fluid d-flex">
            <!-- User Summary -->
            <div class="col-12 col-md-4 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        
                        {{-- Profile --}}
                        <div class="contact-info">
                            <header class="text-center">
                                
                                <!-- /.dropdown -->
                                <div class="text-center">
                                   
                                    <img class="" style="width: 90%; object-fit: cover;" src="{{ asset($data->foto) }}" alt="">
                                    
                                </div>
                                <h4 class="mt-1"><a href="#">{{$data->nama}}</a> <span class="badge text-uppercase badge-warning align-middle">Pro</span></h4>
                                <div class="contact-info-address"><i class="fas fa-map"></i>
                                    <p>{{$data->divisi->nama}}</p>
                                </div>
                            </header>
                            
                            @php
                                $done = 0;
                                $progres_tot = 0;
                                foreach ($track as $tr){
                                    $progres_tot += $tr->progres; 
                                }

                                if(count($track) == 0){
                                    $progres_tot = 0;
                                }else{
                                    $progres_tot = round($progres_tot);
                                }
                                   
         
                            @endphp

                            <section class="padded-reverse">
                                <h5>Detail <small class="float-right">Divisi: <strong>{{$data->divisi->nama}}</strong></small></h5>
                                <div class="row text-center">
                                    <div class="col-4"><span>{{count($track)}}</span>
                                        <br><small>Key Result</small>
                                    </div>
                                    <div class="col-4"><span>{{$progres_tot}}%</span>
                                        <br><small>Progress</small>
                                    </div>
                                    <div class="col-4"><span>{{$done}}</span>
                                        <br><small>Selesai</small>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!--Contact-End -->

                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>


           
            <div class="col-12 col-md-8 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="tabs mr-t-10">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#profile-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
                                <li class="nav-item"><a href="#edit-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Edit</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Detail -->
                                <div class="tab-pane active" id="profile-tab-bordered-1">
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
                                                <h6 class="text-muted text-uppercase">Jenis kelamin</h6>
                                                <p class="mr-t-0">{{$data->jenkel}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Alamat</h6>
                                                <p class="mr-t-0">{{$data->alamat}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Alamat KTP</h6>
                                                <p class="mr-t-0">{{$data->alamat_ktp}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon</h6>
                                                <p class="mr-t-0">{{$data->telepon}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Telepon WA</h6>
                                                <p class="mr-t-0">{{$data->telepon_wa}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tempat lahir</h6>
                                                <p class="mr-t-0">{{$data->tmpt_lahir}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Tanggal lahir</h6>
                                                <p class="mr-t-0">{{$data->tgl_lahir}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Usia</h6>
                                                <p class="mr-t-0">{{$data->usia}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">status_keluarga</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->status_keluarga)
                                                        @case(1)
                                                            Menikah
                                                            @break
                                                        @case(2)
                                                            Belum menikah
                                                            @break
                                                        
                                                        @default
                                                    @endswitch
                                            </div>
                                        
                                        <hr class="mr-tb-50">

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Sekolah</h6>
                                                <p class="mr-t-0">{{$data->sekolah}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Pendidikan</h6>
                                                <p class="mr-t-0">{{$data->pendidikan}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Jurusan</h6>
                                                <p class="mr-t-0">{{$data->jurusan}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Rekening</h6>
                                                <p class="mr-t-0">{{$data->rekening}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Npwp</h6>
                                                <p class="mr-t-0">{{$data->npwp}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bpjs tenaga kerja</h6>
                                                <p class="mr-t-0">{{$data->bpjs_tk}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Bpjs kesehatan</h6>
                                                <p class="mr-t-0">{{$data->bpjs_kes}}</p>
                                            </div>

                                        </div>
                                        
                                        <hr class="mr-tb-50">

                                        <h4>Informasi</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Pangkat</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->pangkat)
                                                        @case(1)
                                                            Direktur
                                                            @break
                                                        @case(2)
                                                            Manager
                                                            @break
                                                        @case(3)
                                                            Supervisor
                                                            @break
                                                        @case(4)
                                                            Officer
                                                            @break
                                                    
                                                        @default
                                                        
                                                    @endswitch
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Level</h6>
                                                <p class="mr-t-0">{{$data->level}}
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Divisi</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->id_divisi)
                                                        @case(1)
                                                            HR
                                                            @break
                                                        @case(2)
                                                            Budimark
                                                            @break
                                                        @case(3)
                                                            MySch
                                                            @break
                                                        @case(4)
                                                            Makin mahir
                                                            @break
                                                        @case(5)
                                                            Dev
                                                            @break
                                                        @default
                                                    @endswitch
                                                
                                                    
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Jabatan</h6>
                                                <p class="mr-t-0">{{$data->jabatan}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted text-uppercase">Status kerja</h6>
                                                <p class="mr-t-0">
                                                    @switch($data->status_kerja)
                                                        @case(1)
                                                            Karyawan tetap
                                                            @break
                                                        @case(2)
                                                            Karyawan tidak tetap
                                                            @break
                                                        @case(3)
                                                            Karyawan kontrak
                                                            @break
                                                        @case(4)
                                                            Karyawan freelancer
                                                            @break
                                                        @case(5)
                                                            Training
                                                            @break
                                                        @case(6)
                                                            Magang
                                                            @break
                                                        @default
                                                    @endswitch
                                                </p>
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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="{{$data->id}}" name="id" id="id" aria-describedby="emailHelp">
                                                    <input type="text" class="form-control" value="{{$data->nama}}" name="nama" id="nama" aria-describedby="emailHelp">
                                                    <label>Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password" id="nama" aria-describedby="emailHelp">
                                                    <label>Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->username}}" name="username" id="usernama" aria-describedby="emailHelp" readonly>
                                                    <label>Username</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->nik}}" name="nik" id="usernama" aria-describedby="emailHelp">
                                                    <label>NIK</label>
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

                                        {{-- tmpt tgl lahir --}}
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

                                        {{-- email --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="BCA 123 456 7890" name="rekening" value="{{$data->rekening}}" class="form-control form-control-line">
                                                    <label>Rekening</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email">
                                                    <label for="example-email">Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- telepon --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon_wa" value="{{$data->telepon_wa}}" class="form-control form-control-line">
                                                    <label>Telepon WA</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" placeholder="123 456 7890" name="telepon" value="{{$data->telepon}}" class="form-control form-control-line">
                                                    <label>Telepon</label>
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

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select id="keluarga" class="form-control" value="{{$data->status_keluarga}}" name="status_keluarga">
                                                        <option value="{{$data->status_keluarga}}">Pilih</option>
                                                        <option value="1">Menikah</option>
                                                        <option value="2">Belum menikah</option>
                                                    </select>
                                                    <label for="keluarga">Status keluarga</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select id="jk" class="form-control" value="{{$data->jenkel}}" name="jenkel">
                                                    <option value="{{$data->jenkel}}">Pilih</option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                                <label for="jk">Jenis kelamin</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$data->usia}}" name="usia" id="email">
                                                    <label for="example-email">Usia</label>
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
                                                    <input type="text" name="bpjs_kes" value="{{$data->bpjs_kes}}" class="form-control form-control-line">
                                                    <label>BPJS Kes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$data->bpjs_tk}}" name="bpjs_tk" id="email">
                                                    <label for="example-email">BPJS TK</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$data->jabatan}}" name="jabatan" id="usernama" aria-describedby="emailHelp">
                                            <label>Jabatan</label>
                                        </div>
                                        
                                        <div class="row">  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="status_kerja" value="{{$data->status_kerja}}">
                                                        <option value="{{$data->status_kerja}}">Pilih</option>
                                                        <option value="1">Karyawan tetap</option>
                                                        <option value="2">Karyawan tidak tetap</option>
                                                        <option value="3">Karyawan kontrak</option>
                                                        <option value="4">Karyawan freelancer</option>
                                                        <option value="5">Training</option>
                                                        <option value="6">Magang</option>
                                                    </select>
                                                    <label for="l38">Status kerja</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="pangkat" value="{{$data->pangkat}}">
                                                        <option value="{{$data->pangkat}}">Pilih</option>
                                                        <option value="1">Direktur</option>
                                                        <option value="2">Manager</option>
                                                        <option value="3">Supervisor</option>
                                                        <option value="4">Officer</option>
                                                    </select>
                                                    <label for="l38">Pangkat</label>
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

                                        {{-- alamat --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="id_divisi" id="l13">
                                                        <option value="{{$data->id_divisi}}">Pilih</option>
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
                                                        <option value="{{$data->level}}">Pilih</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <label for="l38">Level</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control" value="{{$data->edukasi_pekanan}}" name="edukasi_pekanan">
                                                        <option value="{{$data->edukasi_pekanan}}">Pilih</option>
                                                        <option value="1">Aktif</option>
                                                        <option value="2">Tidak aktif</option>
                                                    </select>
                                                    <label for="l38">Edukasi pekanan</label>
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