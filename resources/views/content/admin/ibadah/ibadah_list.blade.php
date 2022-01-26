@extends('layouts.apps')

@section('sidebar')
    
    @include('includes.sidebar.admin')
    
@endsection

@section('content')
<div class="container p-5 bg-white">
    @if (Session::has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            <p class="mb-1">{{ Session::get('message') }}</p>
      </div>
    @endif
    <a href="#" data-toggle="modal" data-target="#modalShow"
                                class="mr-3 btn btn-outline-info">Tambah</a><br>
    <h5>Data Ibadah</h5>
    
    <table class="table table-striped" id="tableIbadah" style="width: 100%">
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col" style="width: 10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $dt)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$dt->nama}}</td>
                <td>
                    <a onclick="ibadahModalEdit({{$dt->id}})" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt" style="color: white"></i></a>
                    <a onclick="deleteIbadah({{$dt->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash" style="color: white"></i></a>
                </td>
            </tr> 
            @endforeach
          </tbody>
    </table>
</div>

<!-- /.modal create -->
<div class="modal modal-info fade bs-modal-md-primary" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-inverse">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myMediumModalLabel">Tambah ibadah</h5>
            </div>
            <div class="modal-body">
                <form id="formIbadah" action="javascript:void(0)">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          'Authorization': `Bearer {{Session::get('token')}}`
	      }
	});

    function ibadahModalEdit(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('ibadahShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#modalShow').modal('show');
                $('#id').val(data.data.id);
                $('#nama').val(data.data.nama);
            }
        });
    }

    function deleteIbadah(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('ibadahDelete') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#tableIbadah').load(window.location + " #tableIbadah"+">*","");
            }
        });
    }

    $(function() {
        $('#modalShow').on('hidden.bs.modal', function (e) {
            $('#formIbadah').trigger("reset");
        })
    });

    $('#formIbadah').on('submit',function(){
		let data = $(this).serialize();
        console.log
        $.ajax({
            type : 'POST',
            url  : "{{ route('ibadahStore') }}",
            data : data,
            dataType: 'json',
            success : (data)=>{
                console.log(data);
                $('#formIbadah').trigger("reset");
                $('#modalShow').modal('hide');
                $('#tableIbadah').load(window.location + " #tableIbadah"+">*","");
                $('#formIbadah').trigger("reset");
            }
        });
    });

    

    function reset(){
        //$('#formIbadah').trigger("reset");
        //$("#formIbadah").get(0).reset();
    }

</script>

@endsection