@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
    <div class="row">
        <div class="widget-holder col-md-12">
            <div class="widget-bg">
                <div class="widget-body">
                    <h5 class="box-title">Lembur bulan ini</h5>
                   
                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#izinModal"><i class="far fa-plus-square mr-1"></i>Tambah lembur</button>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%">No</th>
                                <th style="width: 11%">Nama</th>
                                <th style="width: 11%">Tanggal</th>
                                <th>Alasan</th>
                                <th style="width: 5%">Jam</th>
                                <th style="width: 10%">Aksi</th>
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
                                    <td>
                                        <a onclick="editModal({{$iz->id}})" class="btn btn-sm btn-success color-content">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a onclick="deleteLembur({{$iz->id}})" class="btn btn-sm btn-danger color-content">
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah lembur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('lemburStore')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="disabledSelect">Karyawan</label>
                    <select id="disabledSelect" class="form-control" name="id_user" id="id_user">
                      @foreach ($user as $us)
                        <option value="{{$us->id}}">{{$us->nama}}</option>
                      @endforeach 
                    </select>
                  </div>
                
                <div class="form-group col-md-12">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <label for="inputPassword4">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" id="keterangan">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4">Tanggal</label>
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
            url  : "{{ route('lemburShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#izinModal').modal('show');
                $('#id').val(data.data.id);
                $('#tgl').val(data.data.hari);
                $('#jam').val(data.data.jam);
                $('#keterangan').val(data.data.alasan);
            }
        });

    }

    function deleteLembur(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('lemburDelete') }}",
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