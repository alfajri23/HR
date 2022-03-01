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
<style>
    p{
        margin: 0;
    }
</style>

<div class="container-fluid bg-white p-3">
    <div class="row">
        <div class="col-2">
            <p>Divisi</p>
            <p>Nama</p>
            <p class="mb-2">Jabatan</p>
        </div>
        <div class="col-8">
            <p>: {{$data->divisi->nama}}</p>
            <p>: {{$data->nama}}</p>
            <p class="mb-2">: {{$data->jabatan}}</p>
        </div>
        <div class="col-2">
            <h4 class="mt-0">{{$bulan}}</h4>
        </div>
    </div>
    
    @forelse ($tracks as $e => $track)
    <h4>{{$e}}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 2px">No</th>
                <th>Kode</th>
                <th>Key result</th>
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
            @endphp
            @foreach ($track as $tr )
            <tr>
                <td>{{$loop->iteration}}</td>
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
                <form action="{{route('trackUpdate')}}" method="POST">
                    @csrf
                @for($i = 0; $i < 5; $i++)
                    @if (empty($week[$i]))
                    <td>
                        <input class="form-control" name="id" value="{{$tr->id}}" type="hidden">
                        <input class="form-control" name="week_no[]" value="{{$i}}" type="hidden">
                        <input type="text" class="form-control" name="week_val[]" style="
                            width: 100px;
                            padding: 8px 2px;
                        ">
                    </td>
                    @else
                    <td class="text-center">{{floor(($week[$i]*100))/100}}</td>
                    @endif
                    
                @endfor
                {{-- total --}}
                <td>
                    @if (empty($tr->total))
                    <input type="number" class="form-control" name="total" style="
                            width: 100px;
                            padding: 8px 2px;
                    ">
                    <small id="emailHelp" class="form-text text-muted">Isi terakhir</small>
                    @else
                    <input type="number" class="form-control" name="total" value="{{$tr->total}}" readonly style="
                            width: 100px;
                            padding: 8px 2px;
                    ">
                    @endif
                    
                </td>
                <td>
                    <p class="my-0">{{$tr->progres}}%</p>
                    <div class="progress" data-toggle="tooltip" title="{{$tr->progres}}%">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr->progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr->progres}}%"><span class="sr-only">{{$tr->progres}}%</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="javascript:void(0)" onclick="okrEdit({{$tr->id}})" class="btn btn-success btn-sm">Edit</a>
                        <button type="submit" class="btn btn-primary btn-sm mt-1">Update</button>
                    </div>
                </td>
                </form>
            </tr>
            @php
                $tot_progres += $tr->progres;
                $tot_bobot += $tr->bobot;
            @endphp
            @endforeach
            <tr>
                <td colspan="3" class="text-center">Bobot</td>
                <td colspan="1">{{$tot_bobot}}</td>
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

    @if (!empty($multi))
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
                    <td>
                        <p class="my-0">{{$tot_progres}}%</p>
                        <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                            </div>
                        </div></td>

                </tr>
            </tbody>
        </table>
    @endif

</div>

{{-- Edit OKR --}}
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

<script>

    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          'Authorization': `Bearer {{Session::get('token')}}`
	      }
	});

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

</script>



{{-- <a href="#" class="color-content"><i class="material-icons md-18">settings</i> </a><a href="#" class="color-content"><i class="material-icons md-18">clear</i></a> --}}

@endsection