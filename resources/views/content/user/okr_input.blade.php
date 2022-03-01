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
<div class="container-fluid bg-white p-5">
    @if ($status == 1)
        <div class="row">
            <div class="col-2">
                <p>Divisi</p>
                <p>Nama</p>
                <p class="mb-2">Jabatan</p>
            </div>
            <div class="col-sm-8 col-6">
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
        <div class="table-responsive">
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
                    @forelse ($track as $tr )
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
                                <input type="text"  onkeyup="currencyFormat(this)" class="form-control" name="week_val[]" style="
                                    width: 100px;
                                    padding: 8px 2px;
                                ">
                            </td>
                            @else
                            <td class="text-center">{{number_format($week[$i])}}</td>
                            @endif
                            
                        @endfor
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
                            {{-- <div class="progress" data-toggle="tooltip" title="{{$tr->progres}}%">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tr->progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tr->progres}}%"><span class="sr-only">{{$tr->progres}}%</span>
                                </div>
                            </div> --}}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </td>
                        </form>
                    </tr>
                    @php                    
                        $tot_progres += $tr->progres;
                        $tot_bobot += $tr->bobot;
                    @endphp

                    @empty

                    @endforelse
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
        </div>
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
                        <td colspan="1">
                            <p class="my-0">{{$tot_progres}}%</p>
                            <div class="progress" data-toggle="tooltip" title="{{$tot_progres}}%">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$tot_progres}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tot_progres}}%"><span class="sr-only">{{$tot_progres}}%</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif


    @else
        <div class="row flex-column align-items-center">
            <h4>Mohon input evaluasi ibadah Anda dulu</h4>
            <a href="{{route('ibadahInput')}}" class="btn btn-primary btn-sm">Input ibadah</a>
        </div>
        
    @endif
    
</div>


<script>
    String.prototype.reverse = function() {
        return this.split("").reverse().join("");
    }

    window.currencyFormat = function reformatText(input) {
        var x = input.value;
        x = x.replace(/,/g, ""); // Strip out all commas
        x = x.reverse();
        x = x.replace(/.../g, function(e) {
            return e + ",";
        }); // Insert new commas
        x = x.reverse();
        x = x.replace(/^,/, ""); // Remove leading comma
        input.value = x;
    }
</script>


{{-- <a href="#" class="color-content"><i class="material-icons md-18">settings</i> </a><a href="#" class="color-content"><i class="material-icons md-18">clear</i></a> --}}

@endsection