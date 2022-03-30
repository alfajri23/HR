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
    
    
    <h4>{{$user->nama}}<br><small>{{$bulan}}</small></h4>
    
    <div class="container-fluid bg-white p-3">
        @hasrole('admin')

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" data-toggle="modal" data-target="#modalTrack"
                    class="mb-3 btn btn-success btn-sm">Tambah Key Result 
                </a>

                {{-- Copy OKR --}}
                <button type="button" class="mb-3 btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Copy OKR
                </button>

            </div>

            <div>
                <div class="dropdown">
                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>Setting
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      @if($user->multi_okr != 0 )
                      <a class="dropdown-item" href="{{route('subdivIndex')}}">Tambah Subdivisi</a>
                      @endif
                      <a href="" type="button" class="dropdown-item" data-toggle="modal" data-target="#modalKey">
                        Tambah keyresult baru
                      </a>
                    </div>
                  </div>
                
            </div>
        </div>
        
        
        <!-- Modal Copy OKR-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Copy OKR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('trackCopy')}}" method="GET">
                    @csrf
                    
                    <label for="exampleFormControlSelect1">Bulan</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="bulan" id="bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>

                    <input type="hidden" name="user" value="{{$user->id}}">
                    <input type="hidden" name="bulan_ini" value="{{Request::segment(4)}}">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Copy</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!--Modal tambah Key ke db-->
        <div class="modal modal-info fade bs-modal-md-primary" id="modalKey" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myMediumModalLabel">Key</h5>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="formKey">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="namas" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Objective</label>
                                <select class="form-control" id="addObj" name="kode_obj">
                                    @foreach ($key as $ky )
                                        <option value="{{$ky['kode']}}">{{$ky['kode']}} {{$ky['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kode Key Result</label>
                                <input type="text" class="form-control" name="kode" id="kode_obj">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" id="descs">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        @endhasrole

        {{-- Total kumulatif multi OKR dangan bobot tertentu --}}
        {{-- @if(!empty($bobotMulti))
        <div>
            <h4>Okr Tracking</h4>
            <table class="table table-bordered" style="width:40%">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="width:15%">Bobot</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($bobotMulti as $bob)
                  <tr>
                    <form action="{{route('editMultiBobot')}}" method="post">
                    @csrf
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        {{$bob->subdivisi}}
                    </td>
                    <td>
                        <div class="show-{{$bob->id}}">{{$bob->bobot}}</div> 
                        <div class="input-{{$bob->id}}" style="display: none">
                            <input type="hidden" value="{{$bob->id}}" name="id" class="form-control">
                            <input type="text" value="{{$bob->bobot}}" name="bobot" class="form-control">
                        </div> 
                    </td>
                    <td style="width:20%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button onclick="edits({{$bob->id}})" type="button" class="btn btn-success btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="{{route('deleteMultiBobot',$bob->id)}}" type="button" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <button type="submit" class="btn btn-success btnSave-{{$bob->id}} btn-sm" style="display: none">Save</button>
                        </div>
                    </td>
                    </form>
                  </tr>
                      
                  @empty
                      
                  @endforelse
                  <tr>
                      <td colspan="2">Total </td>
                      <td></td>
                  </tr>
                </tbody>
              </table>
        </div>
        @endif --}}

        {{-- Total kumulatif multi OKR dangan detail --}}
        @if(!empty($multi))
        <div>
            <h5>Okr Tracking</h5>
            <table class="table table-bordered" style="width:50%">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="width:15%">Bobot</th>
                    <th scope="col">Hasil</th>
                    <th scope="col">Total</th>
                    <th scope="col" style="width:20%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $totalProgres = 0;
                  @endphp
                  @forelse ($multi as $bob)
                  @php
                      $totalProgres += $bob['total'];
                  @endphp
                  <tr>
                    <form action="{{route('editMultiBobot')}}" method="post">
                    @csrf
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        {{$bob['subdivisi']}}
                    </td>
                    <td>
                        <div class="show-{{$bob['id']}}">{{$bob['bobot']}}</div> 
                        <div class="input-{{$bob['id']}}" style="display: none">
                            <input type="hidden" value="{{$bob['id']}}" name="id" class="form-control">
                            <input type="text" value="{{$bob['bobot']}}" name="bobot" class="form-control">
                        </div> 
                    </td>
                    <td>
                        {{$bob['hasil']}}
                    </td>
                    <td>
                        {{$bob['total']}}
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if($bob['id'] != 0)
                            <button onclick="edits({{$bob['id']}})" type="button" class="btn btn-success btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            @else
                            
                            <a onclick="addBobot('{{$bob['subdivisi']}}')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-cog" style="color:white"></i>
                            </a>
                            @endif
                            <a href="{{route('deleteMultiBobot',$bob['id'])}}" type="button" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <button type="submit" class="btn btn-success btnSave-{{$bob['id']}} btn-sm" style="display: none">Save</button>
                        </div>
                    </td>
                    </form>
                  </tr>
                      
                  @empty
                      
                  @endforelse
                  <tr>
                      <td colspan="4">Total </td>
                      <td>{{$totalProgres}}</td>
                  </tr>
                </tbody>
              </table>
        </div>
        @endif

        

        @forelse ($tracks as $e => $track)  
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">

                <h5>{{$e}}</h5>
            </div>
         
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 2px">No</th>
                    {{-- <th>Obj</th> --}}
                    <th>Kode</th>
                    <th style="width: 25%">Key result</th>
                    <th>Bobot</th>
                    <th>Target</th>
                    <th>Start</th>
                    <th>Pekan 1</th>
                    <th>Pekan 2</th>
                    <th>Pekan 3</th>
                    <th>Pekan 4</th>
                    <th>Pekan 5</th>
                    <th>Total</th>
                    <th>Progres</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tot_progres = 0;
                    $tot_bobot = 0;
                    $dtBefore = '';
                    $nomor_obj = 1;
                @endphp

                @foreach ($track as  $tr )
                @if ($dtBefore != $tr->keyResult->kode_obj)
                <tr>
                    <td>{{$nomor_obj++}}</td>
                    <td class="font-weight-bold">{{$tr->keyResult->kode_obj}}</td>
                    <td class="font-weight-bold">{{$tr->keyResult->objective->nama}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @else
                @endif

                <tr>
                    <td></td>
                    <td>{{$tr->kode_key}}</td>
                    <td>{{$tr->keyResult->nama}}</td>
                    <td class="text-center">{{$tr->bobot}}</td>
                    <td class="text-center">{{number_format($tr->target)}}</td>
                    <td class="text-center">{{$tr->start}}</td>
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
                        <td  class="text-center">{{floor(($week[$i]*100))/100}}</td>
                        @endif
                    @endfor
                    <td>{{$tr->total}}</td>
                    <td>
                        <p class="my-0">{{$tr->progres}}%</p>
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="okrEdit({{$tr->id}})" class="btn btn-info btn-sm"><i class="fas fa-dot-circle"></i></a>
                        <a href="javascript:void(0)" onclick="trackModalEdit({{$tr->id}})" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <a href="{{route('trackDelete',$tr->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    
                </tr>

                @php
                    $dtBefore = $tr->keyResult->kode_obj;
                    $tot_bobot += $tr->bobot;
                    $tot_progres += $tr->progres;
                @endphp

                @endforeach
                <tr>
                    <td colspan="4" class="text-center">Bobot</td>
                    <td colspan="1"  class="text-center">{{$tot_bobot}}</td>
                    <td colspan="8" class="text-center">Total progres</td>
                    <td colspan="1">
                        <p class="my-0">{{$tot_progres}}%</p>
                        <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                            </div>
                        </div>
                    </td>
                    <td colspan="1"></td>
                    
                </tr>
            </tbody>
        </table>
        @empty    

        @endforelse

        {{-- TIDAK JADI --}}
        {{-- jika ada multi --}}
        {{-- @if (!empty($multi))
            <h4>Total</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 2px">No</th>
                        <th>Kode</th>
                        <th style="width: 300px;">Key result</th>
                        <th>Pekan 1</th>
                        <th>Pekan 2</th>
                        <th>Pekan 3</th>
                        <th>Pekan 4</th>
                        <th>Pekan 5</th>
                        <th>Progres</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tot_progres = 0;
                    @endphp
                    @foreach ($multi as $tr )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$tr['kode_key']}}</td>
                        <td>{{$tr['nama']}}</td>
                        @for($i = 0; $i < count($tr['data_pekan']); $i++)
                            @if (empty($tr['data_pekan'][$i]))
                            <td>
                                
                            </td>
                            @else
                            <td class="text-center">{{number_format($tr['data_pekan'][$i])}}</td>
                            @endif
                            
                        @endfor
                        <td>
                            <p class="my-0">{{$tr['progres']}}%</p>
                            <div class="progress" data-toggle="tooltip" title="{{$tr['progres']}}%">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr['progres']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr['progres']}}%"><span class="sr-only">{{$tr['progres']}}%</span>
                                </div>
                            </div>
                        </td>
                        @php
                
                            $tot_progres += $tr['progres'];
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="8" class="text-center">Total progres</td>
                        <td colspan="1">
                            <p class="my-0">{{$tot_progres}}%</p>
                            <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                                </div>
                            </div></td>
                    </tr>
                </tbody>
            </table>
        @endif --}}
        
    </div>

    <!--Modal OKR-->
    <div class="modal modal-info fade bs-modal-md-primary" id="modalTrack" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel">Key Result</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('trackStore')}}" method="POST" id="formObj">
                        @csrf
                        <div class="mb-3" id="objSection">
                            <label for="exampleInputPassword1" class="form-label">Objective</label>
                            <select class="form-control" id="selectObj">
                                @foreach ($key as $ky )
                                    <option value="{{$ky['kode']}}">{{$ky['kode']}} {{$ky['nama']}}</option>
                                @endforeach
                            </select>
                        </div>  

                        {{-- list key --}}
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Key result</label>
                            <select class="form-control" name="key" id="keyList">

                            </select>
                        </div>

                        {{-- menampilkan sub divisi  --}}
                        @if($user->multi_okr != 0 )
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Divisi</label>
                            <select class="form-control" name="multi" id="multi">
                                @foreach ($subs as $sub)
                                    <option value="{{$sub->nama}}">{{$sub->nama}}</option>
                                @endforeach
                            </select>
                        </div>  
  
                        @endif    

                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                            {{-- <input type="hidden" class="form-control" value="{{date('m')}}" name="bulan" id="bulan"> --}}
                            <input type="hidden" class="form-control" value="{{$user->id}}" name="id_user" id="id_user">
                            <input type="hidden" value="{{Request::segment(4)}}" name="bulan">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="exampleFormControlSelect1">Bulan</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="bulan" id="bulan">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Target</label>
                            <input type="number" step="0.01" class="form-control" name="target" id="target">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Bobot</label>
                            <input type="number" step="0.01" class="form-control" name="bobot" id="bobot">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Start</label>
                            <input type="number" step="0.01" class="form-control" name="start" id="start">
                        </div>
                        
                        <button type="submit" id="btnOkr" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Edit data pekan OKR --}}
    <div class="modal modal-info fade bs-modal-md-primary" id="modalOkr" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel">Edit data pekan</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('trackUpdate')}}" method="POST" id="formObj">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" id="total">
                            <input type="hidden" class="form-control" name="id" id="id_okr">
                        </div>
                        <div id="okrList"></div>
                        <button type="submit" id="btnOkr" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit bobot multi --}}
    <div class="modal modal-info fade bs-modal-md-primary" id="modalSetBobot" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel">Setting bobot sub divisi</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('storeMultiBobot')}}" method="POST" id="formObj">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama</label>
                            <input type="hidden" class="form-control" name="id" id="id_bobot" readonly>
                            <input type="text" class="form-control" name="subdivisi" id="namaSub" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Bobot</label>
                            <input type="number" class="form-control" name="bobot">
                        </div>
                        <input type="hidden" class="form-control" value="{{$user->id}}" name="id_user">
                        <input type="hidden" value="{{Request::segment(4)}}" name="bulan">


                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>

    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          'Authorization': `Bearer {{Session::get('token')}}`
	      }
	});

    $(document).ready(function(){
        $('#modalTrack').on('hidden.bs.modal', function (e) {
            $('#objSection').show();
            
        });
    });

    function trackModalEdit(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('trackShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data.data);
                $('#modalTrack').modal('show');
                $('#id').val(data.data.id);
                $('#target').val(data.data.target);
                $('#bobot').val(data.data.bobot);
                $('#start').val(data.data.start);
                $('#keyList').html(`
                    <option value="${data.data.kode_key}">${data.data.kode_key}</option>
                `);
                $('#btnOkr').html("Edit");
                 $('#objSection').hide();
            }
        });
    }

    function okrEdit(id){
        let inputWeek = ``;
        let input = '';

        function loop(no,index){
            input += `
            <div class="col-12 mb-3">
            <label for="exampleInputPassword1" class="form-label">Pekan ${index+1}</label>
            <input class="form-control" name="week_no[]" value="${index}" type="hidden">
            <input type="text" class="form-control" value="${no}" name="week_val[]">
            </div>
            `;
        }

        $.ajax({
            type : 'GET',
            url  : "{{ route('trackShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data.data);
                
                $('#id_okr').val(data.data.id);
                $('#total').val(data.data.total);
                let week = data.data.week_1;
                week = week.split(',');
                week.forEach(loop);
                //console.log(input);

                $('#okrList').html(input);
                $('#modalOkr').modal('show');

            }
        });
    }

    function addBobot(nama){
        console.log(nama);
        $('#namaSub').val(nama);
        $('#modalSetBobot').modal('show');
    }

    function editBobot(id){

    }


    //menampilkan key sesuai obj 
    $('#selectObj').on('change', function() {
        $.ajax({
            type : 'GET',
            url  : "{{ route('keyObj') }}",
            data : {
                key : this.value
            },
            dataType: 'json',
            success : (data)=>{
                let datas = data.data;
                let keyList = '';
                datas.forEach((e)=>{
                    keyList += `
                        <option value="${e['kode']}">${e['kode']} ${e['nama']}</option>
                    `;
                })
                $('#keyList').html(keyList);
            }
        });
    });

    //untuk menambah key result
    $('#addObj').on('change', function() {
        $.ajax({
            type : 'GET',
            url  : "{{ route('keyObj') }}",
            data : {
                key : this.value
            },
            dataType: 'json',
            success : (data)=>{
                let datas = data.data;

                //ambil kode terakhir
                let str = datas.slice(-1)[0].kode;
                let length = str.length;

                //tambah dengan 1 dibelakang
                let angkaBaru = parseInt(str[length-1]) + 1;

                //ubah
                str = str.split('');
                str[length-1] = angkaBaru;
                str = str.join('');

                $('#kode_obj').val(str);
            }
        });
    })

    $('#formKey').on('submit',function(){
		let data = $(this).serialize();
        console.log(data);
        $.ajax({
            type : 'POST',
            url  : "{{ route('keyStore') }}",
            data : data,
            dataType: 'json',
            success : (data)=>{
                $('#modalKey').modal('hide');
            }
        });
    });

    function edits(id){
        $('.input-'+id).toggle();
        $('.show-'+id).toggle();
        $('.btnSave-'+id).toggle();
    }

    
</script>
@endsection 