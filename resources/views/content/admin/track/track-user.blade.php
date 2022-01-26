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

    @php                    //besok dicopas dari detail.php jika data tidak ada gunakan dibawah
        $done = 0;
        $progres_tot = 0;
        foreach ($track as $tr){

            $progres = 0;
            $target = $tr->target;
            $week = explode(",",$tr->week_1);
            foreach($week as $tr ){
                $progres += (int)$tr;
            }
            
            $progres = $progres/$target * 100;
            if($progres == 100){
                $done += 1;
            } 
            $progres_tot += $progres; 
        }
        if(count($track) == 0){
            $progres_tot = 0;
        }else{
            $progres_tot = $progres_tot/count($track);
        }
    @endphp
    <h4>{{$user->nama}}<br><small>{{$bulan}}</small></h4>
    
    <div class="container-fluid bg-white p-3">
        @hasrole('admin')
        <a href="#" data-toggle="modal" data-target="#modalTrack"
                                class="mb-3 btn btn-success btn-sm">Tambah Objective</a>
        @endhasrole
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
                    <th>Progres</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tot_progres = 0;
                @endphp
                @foreach ($track as $tr )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$tr->kode_key}}</td>
                    <td>{{$tr->keyResult->nama}}</td>
                    <td>{{$tr->bobot}}</td>
                    <td>{{$tr->target}}</td>
                    <td>{{$tr->start}}</td>
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
                        <td>{{$week[$i]}}</td>
                        @endif
                        
                    @endfor
                    <td>
                        <p class="my-0">{{$tr->progres}}%</p>
                        <div class="progress" data-toggle="tooltip" title="{{$tr->progres}}%">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr->progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr->progres}}%"><span class="sr-only">{{$tr->progres}}%</span>
                            </div>
                        </div>
                        </td>
                    <td>
                        <a href="javascript:void(0)" onclick="trackModalEdit({{$tr->id}})" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <a href="{{route('trackDelete',$tr->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    
                </tr>
                @php
                    
                    $tot_progres += $tr->progres;
                @endphp
                @endforeach
                <tr>
                    <td colspan="11" class="text-center">Total progres</td>
                    <td>
                        <p class="my-0">{{$tot_progres}}%</p>
                        <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                            </div>
                        </div></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!--Modal OKR-->
    <div class="modal modal-info fade bs-modal-md-primary" id="modalTrack" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myMediumModalLabel">Objective</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('trackStore')}}" method="POST" id="formObj">
                        @csrf
                        <div class="mb-3" id="inputKey">
                            <label for="exampleInputPassword1" class="form-label">Key result</label>
                            <select class="form-control" name="key" id="key">
                                @foreach ($key as $ky )
                                    <option value="{{$ky['kode']}}">{{$ky['kode']}} {{$ky['nama']}}</option>
                                @endforeach
                            </select>
                        </div>      
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                            <input type="hidden" class="form-control" value="{{date('m')}}" name="bulan" id="bulan">
                            <input type="hidden" class="form-control" value="{{$user->id}}" name="id_user" id="id_user">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Target</label>
                            <input type="number" class="form-control" name="target" id="target">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Bobot</label>
                            <input type="number" class="form-control" name="bobot" id="bobot">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Start</label>
                            <input type="number" class="form-control" name="start" id="start">
                        </div>
                        
                        <button type="submit" id="btnOkr" class="btn btn-primary">Tambah</button>
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


    $('#modalTrack').on('hidden.bs.modal', function () {
        $('#inputKey').show();
        console.log("hallo");
    });

    function show(){
        $('#inputKey').show();
    }

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
                $('#key').val(data.data.kode_key);
                $('#btnOkr').html("Edit");
                // $('#inputKey').hide();
            }
        });
    }
</script>
@endsection 