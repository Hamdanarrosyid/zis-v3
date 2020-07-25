@extends('layouts.dashboard')

@section('title','ZIS')

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
                            <ol class="breadcrumb text-right ">
                                <li><a href="{{route('home')}}">Dashboard</a></li>
                                <li><a href="{{route('pengeluaran-bentuk.index')}}">Pengeluaran Barang ZIS</a></li>
                                <li class="active">Edit Pengeluaran Barang ZIS</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{route('pengeluaran-bentuk.index')}}"><i class="fa ti-arrow-circle-left"></i> </a>
                            <strong>Edit Pengeluaran Barang ZIS</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{route('pengeluaran-bentuk.update',['pengeluaran_bentuk'=>$pengeluaran->id])}}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label class=" form-control-label">Keperluan</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-train"></i></div>
                                        <input value="{{$pengeluaran->keperluan}}" placeholder="Masukan keperluan" required class="form-control" type="text"
                                               name="keperluan">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Barang Zis</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-file-archive-o"></i></div>
                                        <select name="bentuk_id" class="custom-select" required>
                                            @foreach( $bentukzis as $data )
                                                @if($data->bentuk == $pengeluaran->bentukzis->bentuk)
                                                    <option selected value="{{$pengeluaran->bentukzis->id}}">{{$pengeluaran->bentukzis->bentuk}}</option>
                                                @else
                                                    <option value="{{$data->id}}">{{$data->bentuk}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Tanggal</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input required class="form-control" value="{{ $pengeluaran->tanggal->format('Y-m-d') }}"  type="date" name="tanggal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Keterangan</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation-circle"></i></div>
                                        <input type="text" name="note" class="form-control"value="{{$pengeluaran->note}}" placeholder="Masukan keterangan" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Nama User</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <select name="user_id" class="custom-select" required>
                                            @if(auth()->user()->role != 'Admin')
                                                <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                                            @else
                                                @foreach( $users as $user )
                                                    @if($user->name == $pengeluaran->user->name)
                                                        <option selected value="{{$pengeluaran->user->id}}">{{$pengeluaran->user->name}}</option>
                                                    @else
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
