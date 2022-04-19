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

        <div id="okrInput" >
        {{-- Total kumulatif multi OKR dangan detail --}}
        @if(!empty($multi))
        <div>
            <h4>Okr Tracking</h4>
            <table class="table table-bordered" style="width:40%">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="width:15%">Bobot</th>
                    <th scope="col">Hasil</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalProgres = 0;
                @endphp
                @forelse ($multi as $bob)
                @php
                    $totalProgres += $bob['total'];
                @endphp
                <tr>
                    <form action="{{route('editMultiBobot')}}" method="post">
                    @csrf
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        {{$bob['subdivisi']}}
                    </td>
                    <td>
                        <div class="show-{{$bob['id']}}">{{$bob['bobot']}}</div> 
                    </td>
                    <td>
                        {{$bob['hasil']}}
                    </td>
                    <td>
                        {{$bob['total']}}
                    </td>
                    </form>
                </tr>
                    
                @empty
                    
                @endforelse
                <tr>
                    <td colspan="4">Total </td>
                    <td>{{$totalProgres}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        @endif

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
                        $dtBefore = '';
                        $nomor_obj = 1;
                    @endphp
                    @forelse ($track as $tr )
                    @if ($dtBefore != $tr->keyResult->kode_obj)
                    <tr style="background-color:aliceblue">
                        <td>{{$nomor_obj++}}</td>
                        <td class="font-weight-bold">{{$tr->keyResult->kode_obj}}</td>
                        <td class="font-weight-bold">{{$tr->keyResult->objective->nama}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @else
                    @endif

                    <tr>
                        <td></td>
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
                                <input type="text" onkeyup="currencyFormat(this)" class="form-control" name="week_val[]" style="
                                    width: 100px;
                                    padding: 8px 2px;
                                    border: 1px solid black;
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
                                    border: 1px solid black;
                            ">
                            <small id="emailHelp" class="form-text text-muted">Isi terakhir</small>
                            @else
                            <input type="number" class="form-control" name="total" value="{{$tr->total}}" readonly style="
                                    width: 100px;
                                    padding: 8px 2px;
                                    border: 1px solid black;
                            ">
                            @endif
                        </td>
                        <td>
                            <p class="my-0">{{$tr->progres}}%</p>
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
        <div class="row justify-content-end">
            <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg?w=740" alt="">
        </div>
        @endforelse
        </div>

    @else
        <div class="row flex-column align-items-center">
            <h4>Mohon input evaluasi ibadah Anda dulu</h4>
            <a href="{{route('ibadahInput')}}" class="btn btn-primary btn-sm">Input ibadah</a>
        </div>
        
    @endif

    {{-- button next prev --}}
    <div class="row justify-content-between">
        @if(date('m') != 1)
        <a href="{{route('trackKaryawan',['m' => date('m')-1])}}" type="button" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Prev
        </a>
        @endif

        @if(date('m') != 12)
        <a href="{{route('trackKaryawan',['m' => date('m')+1])}}" type="button" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-alt-circle-right"></i>
            Next
        </a>
        @endif
    </div>

    
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


@endsection