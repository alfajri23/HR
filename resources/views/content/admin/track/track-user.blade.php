@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
    <span class="row justify-content-between px-3">
        <h4>{{$user->nama}}</h4>
        @hasrole('admin')
        <a href="#" data-toggle="modal" data-target="#modalTrack"
                                class="ml-4 mb-3 btn btn-success">Tambah Objective</a>
        @endhasrole
    </span>
    
    <div class="accordion accordion-minimal" id="accordion-5" role="tablist" aria-multiselectable="true">
        @foreach ($track as $tr)
            <div class="card my-3">
                <div class="card-header" role="tab" id="heading13">
                    <h5 class="m-0">
                        <a role="button" class="p-3" data-toggle="collapse" data-parent="#accordion-5" href="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}">{{$tr->kode_key}} - {{$tr->keyResult->nama}}</a>
                    </h5>
                </div>
                <div id="collapse{{$loop->iteration}}" class="card-collapse collapse show" role="tabpanel" aria-labelledby="heading13">
                    <div class="card-body">
                        @hasrole('admin')
                        <span style="position: relative;
                        left: 90%;">
                            <a href="javascript:void(0)" onclick="trackModalEdit({{$tr->id}})" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{route('trackDelete',$tr->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                        </span>
                        @endhasrole
                        <section class="container">
                            <h5>Target {{$tr->target}} <small class="float-right">Bobot: <strong>{{$tr->bobot}}</strong></small></h5>
                            
                            @php
                                $progres = 0;
                                $target = $tr->target;
                                $week = explode(",",$tr->week_1);
                                foreach($week as $tr ){
                                    $progres += (int)$tr;
                                }
                                
                                $progres = $progres/$target * 100;
                            
                            @endphp
                            <div class="row text-center">
                                @foreach ($week as $wk )
                                    <div class="col-2"><span>{{$wk}}</span>
                                        <br><small>Minggu {{$loop->iteration}}</small>
                                    </div>
                            
                                @endforeach
                                
                            </div>

                            <div class="progress progress-md mt-4">
                                <div class="progress-bar bg-success" style="width: {{round($progres)}}%" role="progressbar">{{round($progres)}}%</div>
                            </div>
                            
                        </section>
                    </div>
                </div>
            </div>
        @endforeach
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
                        <div class="mb-3" id="inputKey">
                            <label for="exampleInputPassword1" class="form-label">Key result</label>
                            <select class="form-control" name="key" id="key">
                                @foreach ($key as $ky )
                                    <option value="{{$ky['kode']}}">{{$ky['kode']}} {{$ky['nama']}}</option>
                                @endforeach
                            </select>
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
                $('#inputKey').hide();
            }
        });
    }
</script>
@endsection 