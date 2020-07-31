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
                                <li class="active" Pengeluaran Zis
                                </li>
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
                                <i class="fa ti-shopping-cart"></i>
                                Pengeluaran Zis
                            </strong>
                            <a href="{{route('pengeluaran.create')}}" class="font-weight-bold">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <form class="form-inline mb-3" action="{{route('pengeluaran.filter')}}" method="GET">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter Data</label>
                                <select name="filter" class="custom-select my-1 mr-sm-2 @error('filter') is-invalid @enderror"
                                        id="inlineFormCustomSelectPref">
                                    <option value="{{null}}">Select...</option>
                                    @foreach($jeniszis as $data)
                                        @if($data->id == $filter)
                                            <option selected value="{{$data->id}}">{{$data->jenis}}</option>
                                        @else
                                            <option value="{{$data->id}}">{{$data->jenis}}</option>
                                        @endif
                                    @endforeach
                                    @error('filter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </select>
                                <button type="submit" class="btn btn-outline-success">filter</button>
                                <a href="{{route('pengeluaran.index')}}" class="mx-3 btn btn-outline-primary ">All</a>

                                @foreach($param as $data)
                                    <a href="{{route('pengeluaran.pdf',['filter'=>$data])}}"
                                       class="btn btn-outline-danger">Download PDF</a>
                                @endforeach

                            </form>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@sortablelink('keperluan')</th>
                                    <th>@sortablelink('jenis_id','Diambil Dari')</th>
                                    <th>@sortablelink('tanggal')</th>
                                    <th>@sortablelink('nominal')</th>
                                    <th>@sortablelink('note','Keterangan')</th>
                                    <th>@sortablelink('user_id','User')</th>
                                    <th>Bukti Pengeluaran</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pengeluaran as $key => $data)
                                    <tr>
                                        <td>{{$key + $pengeluaran->firstItem()}}</td>
                                        <td>{{$data->keperluan}}</td>
                                        <td>{{$data->jeniszis->jenis}}</td>
                                        <td>{{$data->tanggal->format('d-m-Y')}}</td>
                                        <td>{{number_format($data->nominal)}}</td>
                                        <td>{{$data->note}}</td>
                                        <td>{{$data->user->name}}</td>
                                        @if($data->image == true)
                                            <td>
                                                <a id="image" style="cursor: pointer" data-toggle="modal"
                                                   data-target="#view-nota-{{$data->id}}">
                                                    <img width="190px" height="43px"
                                                         src="{{asset('uploads/nota/pengeluaran/'.$data->image)}}"
                                                         alt="Nota"></a>
                                                <a id="download"
                                                   href="{{route('pengeluaran.show',['pengeluaran'=>$data->id])}}"
                                                   class="font-weight-light "><i class="fa fa-download"></i></a>
                                            </td>
                                        @else
                                            <td>Tidak ada nota</td>
                                        @endif
                                        <td>
                                            <a href="{{route('pengeluaran.edit',['pengeluaran'=>$data->id])}}"><i
                                                    class="fa ti-pencil text-info"></i> </a>
                                            <a href="{{route('pengeluaran.destroy',['pengeluaran'=>$data->id])}}"
                                               onclick="event.preventDefault();document.getElementById('formdelete').submit();"><i
                                                    class="fa ti-trash ml-2 text-danger"></i></a>
                                            <form id="formdelete"
                                                  action="{{route('pengeluaran.destroy',['pengeluaran'=>$data->id])}}"
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
                            {{ $pengeluaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!-- Modal View Nota -->
    @foreach($pengeluaran as $data)
        <div class="modal fade modal-xl" id="view-nota-{{$data->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img width="1140" src="{{asset('uploads/nota/pengeluaran/'.$data->image)}}"
                             alt="Nota">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <style>
        @media (min-width: 768px) {
            .modal-xl {
                margin: auto;
                width: 100%;
                max-width: 1200px;
            }
        }
    </style>

@endsection

