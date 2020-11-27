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
                                <li class="active">Pencapaian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-bottom: 200px">
        <div class="d-flex justify-content-center mb-3">
            @foreach($tingkatbaca as $data)
                {{--                <form action="" method="GET" class="mx-2">--}}
                <a href="{{route('pencapaian.filter',['id'=>$data->id])}}"
                   class="btn btn-outline-dark mx-2 ">{{$data->tingkat_baca}}</a>
                {{--                </form>--}}
            @endforeach
        </div>
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong class="card-title m-0">
                        <i class="fa fa-users"></i>
                        Table Pencapaian
                    </strong>
                    <a href="#" data-toggle="modal" data-target="#createmodal" class="badge badge-primary ">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </a>

                </div>
                    @if($pencapaian->count() == 0)
                        <div class="d-flex justify-content-center">
                                <p class="mt-3">Pastikan sudah memilih pencapaian yang ada</p>
                        </div>
                    @else
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <tr>
                            <th class="serial">#</th>
                            {{--                            <th>Tingkat bacaan Pencapaian</th>--}}
                            <th>Pencapaian</th>
                            <th>Aksi</th>
                        </tr>

                        @foreach($pencapaian as $data)
                            <tr>
                                <td class="serial">{{$loop->iteration}}</td>
                                <td>
                                    {{$data->tingkatbaca->nama_tingkatan}} {{$data->nomor_pencapaian}}
                                </td>
                                {{--                                <td> {{$data->nama_pencapaian}}</td>--}}
                                <td>
                                    <a href="#" class="badge badge-complete " data-toggle="modal"
                                       data-target="#editmodal-{{ $data->id }}">Edit
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modal-delete-{{$data->id}}"
                                       class="badge badge-pending">
                                        Hapus
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </table>
                </div> <!-- /.table-stats -->
                    @endif
            </div>
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{ $pencapaian->links() }}
        </div>
    </div>
    {{--    create-modal--}}
    <div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{route('pencapaian.store')}}" method="post">
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
                            <label for="tingkatbaca_id" class="col-sm-4 col-form-label">Tingkat Pencapaian</label>
                            <div class="col-sm-8">
                                <select name="tingkatbaca_id" id="tingkatbaca"
                                        class="form-control  @error('tingkatbaca_id') is-invalid @enderror">
                                    <option value="">Select...</option>
                                    @foreach($tingkatbaca as $data)
                                        <option value="{{$data->id}}">{{$data->tingkat_baca}}</option>
                                    @endforeach
                                </select>
                                @error('tingkatbaca_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="nomor_pencapaian" class="col-sm-4 col-form-label">Pencapaian</label>
                            <div class="col-sm-8">
                                <input type="number" placeholder="Pencapaian" name="nomor_pencapaian"
                                       class="form-control @error('nomor_pencapaian') is-invalid @enderror"
                                       id="nomor_pencapaian">
                                @error('nomor_pencapaian')
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
    @foreach($pencapaian as $data)
        <div class="modal fade" id="editmodal-{{$data->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('pencapaian.update',['pencapaian'=>$data->id])}}" method="post">
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
                                <label for="tingkatbaca_id" class="col-sm-4 col-form-label">Tingkat Baca</label>
                                <div class="col-sm-8">
                                    <input value="{{$data->tingkatbaca_id}}" type="text" name="tingkatbaca_id"
                                           class="form-control @error('tingkatbaca_id') is-invalid @enderror"
                                           id="tingkaybaca_id"
                                           placeholder="nama dasa wisma">
                                    @error('tingkatbaca_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pencapaian" class="col-sm-4 col-form-label">Pencapaian</label>
                                <div class="col-sm-8">
                                    <input type="text" value="{{$data->nomor_pencapaian}}" name="nomor_pencapaian"
                                           class="form-control @error('nomor_pencapaian') is-invalid @enderror"
                                           placeholder="Nama pencapaian"
                                           id="nomor_pencapaian">
                                    @error('nomor_pencapaian')
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

    @foreach($pencapaian as $data)
        <div class="modal fade" id="modal-delete-{{$data->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <form id="deleteform" method="POST"
                          action="{{route('pencapaian.destroy',['pencapaian'=>$data->id])}}">
                        @csrf
                        @method('DELETE')
                        <div class="pb-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-2">Ya Hapus</button>
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

