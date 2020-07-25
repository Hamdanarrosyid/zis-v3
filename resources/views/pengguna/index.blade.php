@extends('layouts.dashboard')
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="active">Pengguna</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content"style="margin-bottom: 200px">
        <div class="animated fadeIn">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong class="card-title m-0">
                        <i class="fa fa-users"></i>
                        Table Pengguna
                    </strong>

                </div>
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role/Sebagai</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $data)
                            <tr>
                                <td class="serial">{{$loop->iteration}}</td>
                                <td> {{$data->name}}</td>
                                <td class="text-lowercase">{{$data->email}}</td>
                                <td>{{$data->role}}</td>
                                <td>
                                    <a href="#"  class="badge badge-complete " data-toggle="modal" data-target="#edit-user-{{ $data->id }}">Edit
                                    </a>
                                    <a href="{{route('pengguna.destroy',['pengguna'=>$data->id])}}" onclick="event.preventDefault();document.getElementById('formhapus-{{ $data->id }}').submit();" class="badge badge-pending">
                                        Hapus
                                    </a>
                                    <form action="{{route('pengguna.destroy',['pengguna'=>$data->id])}}" id="formhapus-{{ $data->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div> <!-- /.table-stats -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    @if($user->count())
        @foreach ( $user as $data )
            <div class="modal fade" id="edit-user-{{ $data->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalCenterTitle">Edit Pengguna</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-10">

                                    <form method="POST"
                                          action="{{ route('pengguna.update', ['pengguna' => $data->id]) }}">
                                        @method('PATCH')
                                        @csrf
                                        <div class="input-group flex-nowrap mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"
                                                      id="addon-wrapping">Nama :  </span>
                                            </div>
                                            <input type="text" value="{{ $data->name }}"
                                                   class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                   placeholder="Masukan Nama Pengguna" name="name">
                                        </div>
                                        <div class="input-group flex-nowrap mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"
                                                      id="addon-wrapping">Email :  </span>
                                            </div>
                                            <input type="text" value="{{ $data->email }}"
                                                   class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                   placeholder="Masukan Nama Pengguna" name="email">
                                        </div>
                                        <div class="input-group flex-nowrap mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"
                                                      id="addon-wrapping">Sebagai :</span>
                                            </div>
                                            <div>
                                                <select name="role" class="custom-select" required>
                                                        <option value="{{$data->role = 'Admin'}}">Admin</option>
                                                        <option value="{{$data->role = 'Ketua'}}">Ketua</option>
                                                        <option value="{{$data->role = 'Bendahara'}}">Bendahara</option>
                                                        <option value="{{$data->role = 'Sekertaris'}}">Sekertaris</option>
                                                        <option value="{{$data->role = 'Jamaah'}}">Jamaah</option>
                                                </select>
                                            </div>

                                        </div>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
