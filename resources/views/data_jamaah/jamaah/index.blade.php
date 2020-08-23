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
                                <li class="active">Jamaah</li>
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
                        Table Jamaah
                    </strong>
                    <a href="{{route('jamaah.create')}}" class="badge badge-primary ">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </a>

                </div>
                <div class="table-stats order-table ov-h">
                    <table class="table ">
{{--                        <thead>--}}
                        <tr>
                            <th class="serial">#</th>
                            <th>Nama Jamaah</th>
                            <th>Jenis Kelamin</th>
                            <th>Dasa Wisma</th>
                            <th>RT</th>
                            <th>Warga</th>
                            <th>Aksi</th>
                        </tr>
{{--                        </thead>--}}
{{--                        <tbody>--}}
                        @foreach($jamaah as $data)
                            <tr>
                                <td class="serial">{{$loop->iteration}}</td>
                                <td> {{$data->nama}}</td>
                                <td> {{$data->jenisKelamin->jenis_kelamin}}</td>
                                <td> {{$data->dasaWisma->nama_dasa_wisma}}</td>
                                <td> {{$data->rt->nomor_rt}}</td>
                                <td> {{$data->warga->status_warga}}</td>
                                <td>
                                    <a href="{{route('jamaah.show',['jamaah'=>$data->id])}}" class="badge badge-complete ">Show & Edit</a>
                                    <a href="#" data-toggle="modal" data-target="#modal-delete-{{$data->id}}"
                                       class="badge badge-pending">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
{{--                        </tbody>--}}

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
            {{ $jamaah->links() }}
        </div>
    </div>

    @foreach($jamaah as $data)
    <div class="modal fade" id="modal-delete-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <form id="deleteform" method="POST" action="{{route('dasa_wisma.destroy',['dasa_wisma'=>$data->id])}}">
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

