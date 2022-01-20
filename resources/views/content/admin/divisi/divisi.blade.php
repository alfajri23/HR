@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
<div class="widget-bg-transparent">
    
    
    <div class="widget-body bg-white py-3">
        <div class="container d-flex justify-content-between">
            <h5 class="">Daftar divisi</h5>
            <a href="#" data-toggle="modal" data-target="#modalShow"
                                class="ml-4 my-3 btn btn-outline-info">Tambah</a>
        </div>
        
        <div class="container d-flex flex-wrap">
            @foreach ($data as $dt)
            <div class="col-md-4 mr-b-30">
                <div class="card">
                    <img class="card-img-top" src="{{$dt['logo']}}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{$dt['nama']}}</h4>
                        <p class="card-text"></p>
                        <p class="card-text">{{$dt['deskripsi']}}</p>
                    </div>
                    <div class="card-action">
                        <a href="javascript:void(0)" onclick="modalShow({{$dt['id']}})" class="card-link text-uppercase fw-500"><i class="fas fa-info-circle mr-1"></i>Edit</a>
                        <a href="{{route('divisiDelete',$dt['id'])}}" class="card-link text-uppercase fw-500"><i class="fas fa-trash mr-1"></i>Delete</a>
                        <a href="{{route('divisiDetail',$dt['id'])}}" class="card-link text-uppercase fw-500"><i class="fas fa-pencil-alt mr-1"></i>Detail</a>
                    </div>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
    <!-- /.widget-body -->
</div>

{{-- modal --}}
<!-- /.modal -->
<div class="modal modal-info fade bs-modal-md-primary" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-inverse">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myMediumModalLabel">Medium Modal Heading</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('divisiStore')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="desc">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Manager</label>
                        <select class="form-control" name="id_manager">
                        {{-- <select class="form-select" aria-label="Default select example" name="id_manager"> --}}
                            <option value="3" selected>Feri</option>
                            @foreach ($user as $us )
                                <option value="{{$us['id']}}" {{ $us['id'] == $dt['id_manager'] ? 'selected' : ''}}>{{$us['nama']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="file" id="logo">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">


	$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          'Authorization': `Bearer {{Session::get('token')}}`
	      }
	});

    function modalShow(id){
        $.ajax({
			type : 'GET',
			url  : "{{ route('divisiShow') }}",
			data : {
				id : id
			},
			dataType: 'json',
			success : (data)=>{
                $('#modalShow').modal('show');
                $('#id').val(data.data.id);
                $('#nama').val(data.data.nama);
                $('#desc').val(data.data.deskripsi);

                console.log(data);
            }
        });
    }

    

    

</script>

@endsection