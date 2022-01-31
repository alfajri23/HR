@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.user')
@endsection

@section('content')
    <div class="row">
        {{-- <div class="col-md-3 col-sm-6 widget-holder widget-full-height">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <div class="widget-counter">
                        <h6>Hutang jam<small></small></h6>
                        <h3 class="h1">
                            <span class="counter">{{$jam}} jam</span>
                        </h3>
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="widget-holder col-md-12">
            <div class="widget-bg">
                <div class="widget-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="box-title">Ganti jam</h5>

                    
                        <span class="btn-group mr-b-20">
                            <button type="button" class="btn btn-outline-default ripple">
                                <p class="mb-0">{{$ijin}}</p>
                                <p class="mb-0">Jam izin</p>
                            </button>
                            <button type="button" class="btn btn-outline-default ripple">
                                <p class="mb-0">{{$lemburs}}</p>
                                <p class="mb-0">Jam lembur</p>
                            </button>
                            <button type="button" class="btn btn-outline-default ripple">
                                <p class="mb-0">
                                    @if($jam_total < 1)
                                        Lebih {{$jam_total*-1}} jam
                                    </p>
                                    @else
                                        {{$jam_total}}
                                    </p>
                                    <p class="mb-0">Hutang jam</p>
                                    @endif
                                
                            </button>
                        </span>
                    </div>
                    @empty(!$ganti)
                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#izinModal"><i class="far fa-plus-square"></i>Ganti jam</button>
                    @endempty
                    
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%">No</th>
                                <th style="width: 11%">Tanggal</th>
                                <th style="width: 5%">Jam</th>
                                <th style="width: 2%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $jams = $jam;
                                $jam_ganti =0;
                            @endphp
                            @forelse ($ganti as $iz )
                                @php
                                    $jams = $jams - $iz->jam;
                                    $jam_ganti = $jam_ganti + $iz->jam;
                                @endphp
                                <tr>
                                    <td>{{$loop->iteration}}</td>
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
                            <tr>
                                <td colspan="2" class="text-center">Jumlah ganti jam</td>
                                <td>{{$jam_ganti}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">Jam izin</td>
                                <td>-{{$ijin}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">Jam lembur</td>
                                <td>{{$lemburs}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">Hutang jam</td>
                                <td>
                                    @if($jams < 1)
                                        Anda lebih {{$jams*-1}} jam
                                    @else
                                        {{$jams}}
                                    @endif
                                </td>
                            </tr>
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