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
                                <li class="active">Barang Zis</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-bottom: 200px">
        <div class="card mb-1">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong class="card-title m-0" v-if="headerText"><i class="mr-2 fa ti-agenda"></i>Barang Zis</strong>
                <a href="#" data-toggle="modal" data-target="#createmodal" class="badge badge-primary ">
                    <i class="fa fa-plus"></i>
                    Tambah Data
                </a>
            </div>

            <ul class="list-group">
                @foreach($bentukzis as $data)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{$data->bentuk}}
                        <div>
                            <a href="#" type="button" class="badge badge-success " data-toggle="modal" data-target="#editmodal-{{$data->id}}">Edit</a>
                            <form action="{{route('bentukzis.destroy',['bentukzis'=>$data->id])}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit"  class="badge badge-danger " style="cursor: pointer">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            @elseif(session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{ $bentukzis->links() }}
    </div>

{{--    <!-- Button trigger modal -->--}}
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--        Launch demo modal--}}
{{--    </button>--}}

    <!-- Modal hapus-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{--Create Modal--}}
    <div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Barang ZIS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('bentukzis.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping">Barang Zis : </span>
                            </div>
                            <input type="text" name="bentuk" class="form-control" placeholder="Masukan barang zis"
                                    aria-describedby="addon-wrapping">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Modal Edit--}}
    @foreach ( $bentukzis as $data )
        <div class="modal fade" id="editmodal-{{ $data->id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalCenterTitle">Edit Barang Zis</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">

                                <form method="POST"
                                      action="{{ route('bentukzis.update', ['bentukzis' => $data->id]) }}">
                                    @method('PATCH')
                                    @csrf

                                    <div class="input-group flex-nowrap mb-2">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"
                                                      id="addon-wrapping">Barang Zis :</span>
                                        </div>
                                        <div>
                                            <input type="text" value="{{ $data->bentuk }}"
                                                   class="form-control @error('bentuk') is-invalid @enderror" id="bentuk"
                                                   placeholder="Masukan Nama Barang Zis" name="bentuk">
                                        </div>

                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
