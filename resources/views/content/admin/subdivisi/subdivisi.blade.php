@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
<div class="container-fluid bg-white p-3">
    <h4>Subdivisi </h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#exampleModal">
        Tambah
    </button>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($subdiv as $sub )
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$sub->nama}}</td>
                <td>
                    <button onclick="modalEdit({{$sub->id}})" class="btn btn-success btn-sm">Edit</button>
                    <a href="{{route('subdivDelete',$sub->id)}}" class="btn btn-danger btn-sm">Hapus</a>
                </td>
              </tr>
            @empty
                
            @endforelse
          
        </tbody>
      </table>
</div>

  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Subdivisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('subdivStore')}}" method="POST" id="formObj">
            @csrf
            <div class="form-group">
                <label for="exampleInputPassword1">Nama</label>
                <input type="hidden" class="form-control" name="id" id="id">
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
        </form>
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

    function modalEdit(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('subdivShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#exampleModal').modal('show');
                $('#id').val(data.data.id);
                $('#nama').val(data.data.nama);
            }
        });
    }


</script>

@endsection