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
        <h4>Riwayat ibadah anda</h4>
        
        
        <div class="container-fluid bg-white p-0">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Bulan</th>
                @for ($i=1;$i<6;$i++)
                    <td>Pekan {{$i}}</td>
                @endfor
                {{-- @forelse ($week as $key => $pekans)
                    <th scope="col">Pekan {{$key}}</th>
                @empty
                    
                @endforelse --}}
                <th scope="col">Point</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($ibadah as $key => $ibadahs)
              @php
                $week = explode(",",$ibadahs[0]['pekan']);
              @endphp
              <tr>
                <th scope="row">{{$key}}</th>
                @for ($i=0;$i<5;$i++)
                    @if(empty($week[$i]))
                        <td></td>
                    @else
                        <td>{{$week[$i]}}</td>
                    @endif
                    
                @endfor
                {{-- @forelse ($week as $pekan)
                    <td>{{$pekan}}</td>
                @empty
                    
                @endforelse --}}
                    <td>{{$ibadahs[0]['point']}}</td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="editModal({{$ibadahs[0]['id']}})">
                            <i class="fas fa-pencil-alt"></i>
                            edit
                        </button>
                    </td>
              </tr>
              @empty
                    
              @endforelse
            </tbody>
        </table>
        </div>
        

<div class="modal fade" id="ibadahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit point ibadah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('ibadahUpdate')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id">
                <div id="formIbadah"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit</button>
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
        let inputWeek = ``;
        let input = '';

        function loop(no,index){
            input += `
            <div class="col-12 mb-3">
            <label for="exampleInputPassword1" class="form-label">Pekan ${index+1}</label>
            <input class="form-control" name="pekan_no[]" value="${index}" type="hidden">
            <input type="text" class="form-control" value="${no}" name="pekan_val[]">
            </div>
            `;
        }
        $.ajax({
            type : 'GET',
            url  : "{{ route('ibadahEdit') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                
                console.log(data);
                $('#id').val(data.data.id);
                let week = data.data.pekan;
                week = week.split(',');
                week.forEach(loop);
                $('#formIbadah').html(input);
                $('#ibadahModal').modal('show');
            }
        });

    }

</script>

@endsection