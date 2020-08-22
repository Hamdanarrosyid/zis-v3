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
                                <li class="active">Dasa Wisma</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-bottom: 200px">
        <div class="animated fadeIn">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong class="card-title m-0">
                        <i class="fa fa-users"></i>
                        Table Dasa Wisma
                    </strong>
                    <a href="#" data-toggle="modal" data-target="#createmodal" class="badge badge-primary ">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </a>

                </div>
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Nama Dasa Wisma</th>
                            <th>Jumlah KRT</th>
                            <th>Jumlah KK</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dasaWisma as $data)
                            <tr>
                                <td class="serial">{{$loop->iteration}}</td>
                                <td> {{$data->nama_dasa_wisma}}</td>
                                <td> {{$data->jumlah_krt}}</td>
                                <td> {{$data->jumlah_kk}}</td>
                                <td>
                                    <a href="#" class="badge badge-complete " data-toggle="modal"
                                       data-target="#editmodal-{{ $data->id }}">Edit
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modal-delete"
                                       class="badge badge-pending">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            <form id="deleteform" method="POST" action="{{route('dasa_wisma.destroy',['dasa_wisma'=>$data->id])}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </table>
                </div> <!-- /.table-stats -->
            </div>
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{ $dasaWisma->links() }}
        </div>
    </div>
    {{--    create-modal--}}
    <div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{route('dasa_wisma.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title" id="exampleModalCenterTitle">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama_dasa_wisma" class="col-sm-4 col-form-label">Nama Dasa Wisma</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_dasa_wisma"
                                       class="form-control @error('nama_dasa_wisma') is-invalid @enderror"
                                       id="nama_dasa_wisma"
                                       placeholder="nama dasa wisma">
                                @error('nama_dasa_wisma')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="jumlah_krt" class="col-sm-4 col-form-label">Jumlah KRT</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="jumlah_krt"
                                       class="form-control @error('jumlah_krt') is-invalid @enderror"
                                       id="jumlah_krt">
                                @error('jumlah_krt')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah_kk" class="col-sm-4 col-form-label">Jumlah KK</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="jumlah_kk"
                                       class="form-control @error('jumlah_kk') is-invalid @enderror"
                                       id="jumlah_kk">
                                @error('jumlah_kk')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--Edit Modal--}}
    @foreach($dasaWisma as $data)
        <div class="modal fade" id="editmodal-{{$data->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('dasa_wisma.update',['dasa_wisma'=>$data->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="nama_dasa_wisma" class="col-sm-4 col-form-label">Nama Dasa Wisma</label>
                                <div class="col-sm-8">
                                    <input value="{{$data->nama_dasa_wisma}}" type="text" name="nama_dasa_wisma"
                                           class="form-control @error('nama_dasa_wisma') is-invalid @enderror"
                                           id="dasa_wisma"
                                           placeholder="nama dasa wisma">
                                    @error('nama_dasa_wisma')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah_krt" class="col-sm-4 col-form-label">Jumlah KRT</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" value="{{$data->jumlah_krt}}" name="jumlah_krt"
                                           class="form-control @error('jumlah_krt') is-invalid @enderror"
                                           id="jumlah_krt">
                                    @error('jumlah_krt')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah_kk" class="col-sm-4 col-form-label">Jumlah KK</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" value="{{$data->jumlah_kk}}" name="jumlah_kk"
                                           class="form-control @error('jumlah_kk') is-invalid @enderror"
                                           id="jumlah_kk">
                                    @error('jumlah_kk')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="d-flex justify-content-center">
                    <div>
                        <h1 style="font-size: 100px;color: #efbd67" class="fa fa-exclamation-circle mt-4"></h1>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <h2 class="text-gray-900">Apa anda yakin?</h2>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h4 class="text-gray-700">Data anda tidak bisa dikembalikan!</h4>
                    </div>
                </div>
                <div class="pb-4 d-flex justify-content-center">
                    <button type="button" class="btn btn-primary mr-2" onclick="event.preventDefault();document.getElementById('deleteform').submit();">Ya Hapus</button>
                    <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    @if(session('error-create'))
        <script type="text/javascript">
            $(document).ready(function () {
                $('#createmodal').modal('show')
            })
        </script>
    @endif
    @if(session('error-update'))
        <script type="text/javascript">
            $(document).ready(function () {
                $('#editmodal-{{session('id')}}').modal('show')
            })
        </script>
    @endif
@endsection
