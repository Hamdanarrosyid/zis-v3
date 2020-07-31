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
                            <ol class="breadcrumb text-right ">
                                <li><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="active"> Pemasukan Barang Zis</li>
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">
                                <i class="fa fa-money"></i>
                                Pemasukan Barang Zis
                            </strong>
                            <a href="{{route('pemasukan-bentuk.create')}}" class="font-weight-bold">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <form class="form-inline mb-3" action="{{route('pemasukan-bentuk.filter')}}" method="GET">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter Data</label>
                                <select name="filter" class="custom-select my-1 mr-sm-2 @error('filter') is-invalid @enderror"
                                        id="inlineFormCustomSelectPref">
                                        <option value="{{null}}">Select...</option>
                                    @foreach($bentukzis as $data)
                                        @if($data->id == $filter)
                                            <option selected value="{{$data->id}}">{{$data->bentuk}}</option>
                                        @else
                                            <option value="{{$data->id}}">{{$data->bentuk}}</option>
                                        @endif
                                    @endforeach
                                    @error('filter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </select>
                                <button type="submit" class="btn btn-outline-success">filter</button>
                                <a href="{{route('pemasukan-bentuk.index')}}" class="mx-3 btn btn-outline-primary ">All</a>
                                @foreach($param as $data)
                                    <a href="{{route('pemasukan-bentuk.pdf',['filter'=>$data])}}"
                                       class="btn btn-outline-danger">Download PDF</a>
                                @endforeach
                            </form>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@sortablelink('bentuk_id','Barang Zis')</th>
                                    <th>@sortablelink('tanggal')</th>
                                    <th>@sortablelink('note','Keterangan')</th>
                                    <th>@sortablelink('user_id','User')</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pemasukan as $key => $data)
                                    <tr>
                                        <td>{{$key + $pemasukan->firstItem()}}</td>
                                        <td>{{$data->bentukzis->bentuk}}</td>
                                        <td>{{$data->tanggal->format('d-m-Y')}}</td>
                                        <td>{{$data->note}}</td>
                                        <td>{{$data->user->name}}</td>
                                        <td>
                                            <a href="{{route('pemasukan-bentuk.edit',['pemasukan_bentuk'=>$data->id])}}"><i
                                                    class="fa ti-pencil text-info"></i> </a>
                                            <a href="{{route('pemasukan-bentuk.destroy',['pemasukan_bentuk'=>$data->id])}}"
                                               onclick="event.preventDefault();document.getElementById('formdelete-{{$data->id}}').submit();"><i
                                                    class="fa ti-trash ml-2 text-danger"></i></a>
                                            <form id="formdelete-{{$data->id}}"
                                                  action="{{route('pemasukan-bentuk.destroy',['pemasukan_bentuk'=>$data->id])}}"
                                                  method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            {{ $pemasukan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

