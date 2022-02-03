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
                        <h5 class="box-title">Ganti jam</h5>
                    </div>
                    @empty(!$ganti)
                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#izinModal"><i class="far fa-plus-square"></i>Ganti jam</button>
                    @endempty
                    <a href="{{route('gantiHistori')}}" class="btn mb-2 btn-secondary btn-sm ">Riwayat</a>
                    
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%">No</th>
                                <th style="width: 10%">Nama</th>
                                <th style="width: 11%">Tanggal</th>
                                <th style="width: 5%">Jam</th>
                                <th style="width: 2%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ganti as $iz )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$iz->user->nama}}</td>
                                    <td>{{$iz->hari}}</td>
                                    <td>{{$iz->jam}}</td>
                                    <td>
                                        <a onclick="editModal({{$iz->id}})" class="btn btn-sm btn-success color-content">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a onclick="deleteJam({{$iz->id}})" class="btn btn-sm btn-danger color-content">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="izinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajukan ganti jam</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('gantiStore')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="disabledSelect">Karyawan</label>
                    <select id="disabledSelect" class="form-control" name="id_user" id="id_user">
                      @foreach ($user as $us)
                        <option value="{{$us->id}}">{{$us->nama}}</option>
                      @endforeach 
                    </select>
                  </div>
                
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4">Tanggal</label>
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="date" class="form-control" id="tgl" name="tgl">
                    </div>
                    <div class="form-group col-md-4" id="inputAkhir">
                        <label for="inputPassword4">Jam</label>
                        <input type="number" class="form-control" id="jam" name="jam">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Kirim</button>
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

    function editModal(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('gantiShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#izinModal').modal('show');
                $('#id').val(data.data.id);
                $('#tgl').val(data.data.hari);
                $('#jam').val(data.data.jam);
            }
        });
    }

    function deleteJam(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('gantiDelete') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $(".table").load(location.href+" .table>*","");
                
            }
        });
    }
</script>

@endsection