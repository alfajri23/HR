@extends('layouts.apps')


@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
<style>
    .widget-bg{
        border-radius: 10px;
        border: 0.5px solid grey !important;
    }
</style>
<div class="widget-bg-transparent">

    
    

    <div class="container bg-white p-3">
        <h4 class="text-uppercase">{{$data->nama}}</h4>
                        <p>{{$data->deskripsi}}</p>
        <div class="tabs mr-t-10">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a href="#home-tab-bordered-1" class="nav-link active" data-toggle="tab" aria-expanded="true">OKR</a>
                </li>
                <li class="nav-item"><a href="#okr-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="true">Anggota</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home-tab-bordered-1">
                    <div class="container">
                        <a href="#" data-toggle="modal" data-target="#modalObj"
                                                    class="ml-4 mb-3 btn btn-success">Tambah OKR</a>
                        <div class="container-fluid d-flex flex-wrap" id="main-obj">
                            @foreach ($obj as $bj)
                            <div class="col-lg-12 col-md-12 widget-holder" id="obj-{{$bj->kode}}">
                                <div class="widget-bg">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="box-title" style="
                                                width: 70%;
                                                line-height: 20px;
                                            ">
                                                {{$bj->kode}} {{$bj->nama}}
                                            </h5>
                                            <span>
                                                
                                                <a href="javascript:void(0)" onclick="keyModalCreate({{$bj->id}})" class="btn btn-info btn-sm"><i class="fas fa-plus"></i></i></a>
                                                <a href="javascript:void(0)" onclick="objModalEdit({{$bj->id}})" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{route('objDelete',$bj->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                            </span>
                                        </div>
                                        
                                        <div class="todo-widget">
                                            <ol class="pl-5">
                                                @foreach ($bj->keyResult as $key )
                                                <li style="list-style-type:number;" class="my-1" data-checked="true">
                                                    <span class="d-flex justify-content-betweend-flex justify-content-between align-items-center">
                                                        <p class="mb-0" style="width: 90%"><strong>{{$key->kode}}</strong> {{$key->nama}}</p> 
                                                        <span>
                                                            <a href="javascript:void(0)" onclick="keyModalEdit({{$key->id}})"><i class="fas fa-pencil-alt"></i></a>
                                                            <a href="javascript:void(0)" onclick="deleteKey({{$key->id}})"><i class="fas fa-trash-alt"></i></a>
                                                        </span>
                                                    </span>
                                                </li>
                                                @endforeach
                                                
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="okr-tab-bordered-1">
                    <div class="widget-body clearfix p-3">
                        <h5 class="box-title">Daftar anggota</h5>
                        <ul class="list-unstyled widget-user-list mb-0">
                            @foreach ($member as $dt)
                                <li class="media"> 
                                    <div class="d-flex mr-3">
                                        <a href="#" class="user--online thumb-xs">
                                            <img src="{{asset($dt->foto)}}" class="rounded-circle" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            @hasrole('admin')
                                            <a href="{{route('karyawanDetail',$dt->id)}}">{{$dt->nama}}</a> 
                                            @endhasrole
                                            @hasrole('user')
                                            <a>{{$dt->nama}}</a> 
                                            @endhasrole
                                            <small>{{$dt->username}}</small>
                                        </h5>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.widget-user-list -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Obj-->
    <div class="modal modal-info fade bs-modal-md-primary" id="modalObj" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel">Objective</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('objStore')}}" method="POST" id="formObj">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="hidden" class="form-control" value="{{$data->id}}" name="id_divisi" id="id_divisi">
                            <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="desc">
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Modal Key-->
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
                            <input type="hidden" class="form-control" name="id" id="ids" aria-describedby="emailHelp">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="namas" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode Objective</label>
                            <input type="text" class="form-control" name="kode_obj" id="kodes" readonly>
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
</div>

<script>
    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          'Authorization': `Bearer {{Session::get('token')}}`
	      }
	});

    
    function objModalEdit(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('objShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#modalObj').modal('show');
                $('#id').val(data.data.id);
                $('#nama').val(data.data.nama);
                $('#kode').val(data.data.kode);
                $('#desc').val(data.data.deskripsi);
            }
        });
    }

    function keyModalCreate(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('objShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data.data);
                $('#modalKey').modal('show');
                $('#kode_obj').val(data.data.kode);
                $('#kodes').val(data.data.kode);
                $("#obj-"+id).load(" #obj-"+id);
            }
        });
    }

    function keyModalEdit(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('keyShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data.data);
                $('#modalKey').modal('show');
                $('#kode_obj').val(data.data.kode_obj);
                $('#ids').val(data.data.id);
                $('#namas').val(data.data.nama);
                $('#kodes').val(data.data.kode);
                $('#descs').val(data.data.deskripsi);
            }
        });
    }
    
    //Simpan key result
    $('#formKey').on('submit',function(){
		let data = $(this).serialize();
        $.ajax({
            type : 'POST',
            url  : "{{ route('keyStore') }}",
            data : data,
            dataType: 'json',
            success : (data)=>{
                $('#modalKey').modal('hide');
                let kot = $("#obj-"+data.code.kode);
                $("#obj-"+data.code.kode_obj).load(window.location + " #obj-"+data.code.kode_obj+">*","");
                $('#formKey').trigger("reset");
            }
        });
    });

    $('#modalKey').on('hidden.bs.modal', function(){
        $('#formKey').trigger("reset");
    });

    $('#modalObj').on('hidden.bs.modal', function(){
        $('#formObj').trigger("reset");
    });

    function deleteKey(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('keyDelete') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data);
                $("#obj-"+data.data).load(window.location + " #obj-"+data.data+">*","");
            }
        });
    }

    
</script>

@endsection