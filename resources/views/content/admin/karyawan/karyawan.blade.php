@extends('layouts.apps')

@section('sidebar')
    @include('includes.sidebar.admin')
@endsection

@section('content')
<div class="container p-5 bg-white">
    @if (Session::has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            <p class="mb-1">{{ Session::get('message') }}</p>
      </div>
    @endif
    <a href="#" data-toggle="modal" data-target="#modalShow"
                                class="mr-3 btn btn-outline-info">Tambah</a><br>
    <h5>Data karyawan</h5>
    
    <table class="table table-striped" style="width: width: 100%">
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Username</th>
              <th scope="col">Divisi</th>
              <th scope="col">Telepon</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $dt)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$dt->nama}}</td>
                <td>{{$dt->username}}</td>
                <td>{{$dt->divisi->nama}}</td>
                <td>{{$dt->telepon}}</td>
                <td>
                    <a href="{{route('karyawanDetail',$dt->id)}}" class="btn btn-primary btn-sm">Detail</a>
                    <a href="{{route('karyawanDelete',$dt->id)}}" class="btn btn-secondary btn-sm">Delete</a>
                </td>
            </tr> 
            @endforeach
          </tbody>
    </table>
</div>

<!-- /.modal create -->
<div class="modal modal-info fade bs-modal-md-primary" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-inverse">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myMediumModalLabel">Medium Modal Heading</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('karyawanStore')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="file" id="logo">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jenis kelamin</label><br>
                        <div class="container">
                            <div class="form-check form-check-inline mr-4">
                                <input class="form-check-input" type="radio" name="jenkel" value="l">
                                <label class="form-check-label" for="inlineRadio1">Laki -laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenkel" value="p">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Divisi</label>
                        <select class="form-control" name="id_divisi">
                        {{-- <select class="form-select" aria-label="Default select example" name="id_manager"> --}}
                            @foreach ($divisi as $us )
                                <option value="{{$us['id']}}">{{$us['nama']}}</option>
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


@endsection