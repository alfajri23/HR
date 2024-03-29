@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.user')
@endsection

@section('content')
<div class="row">
    <div class="widget-holder col-md-12">
        <div class="widget-bg">
            <div class="widget-body">
                <h5 class="box-title">Perizinan sakit</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#izinModal">Ajukan izin sakit</button>
                </div>
                
                
                <div class="table-responsive">
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
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%">Aksi</th>
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
                                <td>
                                    @if ($iz->status == 0)
                                        <span class="badge badge-pill badge-warning">pending</span> 
                                    @elseif ($iz->status == 1)
                                        <span class="badge badge-pill badge-success">diterima</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    
                                    <a onclick="editModal({{$iz->id}})" class="btn btn-sm btn-success color-content">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @if ($iz->status != 1)
                                    <a onclick="deleteIzin({{$iz->id}})" class="btn btn-sm btn-danger color-content">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="izinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajukan izin sakit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('izinReq')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row pl-2">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Tanggal mulai</label>
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                        <input type="hidden" class="form-control" name="filter" value="sakit">
                    </div>
                    <div class="form-group col-md-6" id="inputAkhir" style="display:none">
                        <label for="inputPassword4">Tanggal akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="inputPassword4">Jenis</label>
                    <input type="text" class="form-control" name="jenis" id="jenis" value="sakit" readonly>
                </div>

                <div class="form-group col-md-12">
                    <label for="inputPassword4">Keterangan</label>
                    <input type="text" class="form-control" name="alasan" id="alasan">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Surat dokter</label>
                    <input type="file" class="form-control-file" name="bukti" id="exampleFormControlFile1">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check ml-4">
                            <input class="form-check-input" type="checkbox" value="1" name="hari">
                            <label class="form-check-label px-1" for="defaultCheck1">
                                Lebih dari 1 hari
                            </label>
                        </div>
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

    $('input[type=checkbox][name=hari]').change(function() {
        if ($('#inputAkhir').css('display') == 'none') {
            $('#inputAkhir').css('display', 'block');
        }
        else {
            $('#inputAkhir').css('display', 'none');
        }
    });

    $('input[type=checkbox][name=half]').change(function() {
        if ($('#jam').css('display') == 'none') {
            $('#jam').css('display', 'flex');
        }
        else {
            $('#jam').css('display', 'none');
        }
    });

    function editModal(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('izinShow') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                $('#izinModal').modal('show');
                console.log(data);
                $('#id').val(data.data.id);
                $('#tgl_mulai').val(data.data.tanggal_mulai);
                $('#tgl_akhir').val(data.data.tanggal_akhir);
                $('#jenis').val(data.data.tipe);
                $('#alasan').val(data.data.alasan);
            }
        });

    }

    function deleteIzin(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('izinDelete') }}",
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