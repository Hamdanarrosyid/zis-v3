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
                                <li class="active"> Detail Zis</li>
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
                <div class="col-md-12 mb-0">
                    <div class="card py-2">
                        <nav class="nav nav-pills d-flex justify-content-center">
                            <a class="text-sm-center btn btn-outline-success mx-lg-4 active" href="{{route('laporan.masuk.show',['jenis'=>$jenis->id])}}">Pemasukan</a>
                            <a class="text-sm-center btn btn-outline-primary nav-link mx-lg-4" href="{{route('laporan.keluar.show',['jenis'=>$jenis->id])}}">Pengeluaran</a>
                        </nav>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">
                                <i class="fa fa-money"></i>
                                Detail Pengeluaran Zis
                            </strong>
                        </div>

                        <div class="card-body">
                            <form class="form-inline mb-3" action="{{route('pemasukan.filter')}}" method="GET">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter Data</label>
                                <input type="month" name="filter"
                                       class="my-1 mr-sm-2 form-control @error('filter') is-invalid @enderror"
                                       {{--                                       max="{{}}"--}}
                                       id="inlineForm">
                                @error('filter')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </input>
                                <button type="submit" class="btn btn-outline-success">filter</button>
                                <a href="{{route('pemasukan.index')}}" class="mx-3 btn btn-outline-primary ">All</a>
                                {{--                                @foreach($param as $data)--}}
                                {{--                                    <a href="{{route('pemasukan.pdf',['filter'=>$data])}}"--}}
                                {{--                                       class="btn btn-outline-danger">Download PDF</a>--}}
                                {{--                                @endforeach--}}
                            </form>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@sortablelink('jenis_id','Jenis Zis')</th>
                                    <th>@sortablelink('tanggal')</th>
                                    <th>@sortablelink('nominal')</th>
                                    <th>@sortablelink('note','Keterangan')</th>
                                    <th>@sortablelink('user_id','User')</th>
                                    <th>Bukti Pengeluaran</th>
                                    {{--                                    <th>Aksi</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                {{$no = 1}}--}}
                                @foreach($pengeluaran as $index => $data)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>{{$data->jeniszis->jenis}}</td>
                                        <td>{{$data->tanggal->format('d-m-Y')}}</td>
                                        <td>{{number_format($data->nominal)}}</td>
                                        <td>{{$data->note}}</td>
                                        <td>{{$data->user->name}}</td>
                                        @if($data->image == true)
                                            <td>
                                                <a style="cursor: pointer" data-toggle="modal"
                                                   data-target="#view-nota-{{$data->id}}">
                                                    <img width="200px" height="43px"
                                                         src="{{asset('uploads/nota/pemasukan/'.$data->image)}}"
                                                         alt="Nota"></a>
                                                <a id="download"
                                                   href="{{route('pemasukan.show',['pemasukan'=>$data->id])}}"
                                                   class="font-weight-light "><i class="fa fa-download"></i></a>
                                            </td>
                                        @else
                                            <td>Tidak ada nota</td>
                                        @endif
                                        {{--                                        <td>--}}
                                        {{--                                            <a href="{{route('pemasukan.edit',['pemasukan'=>$data->id])}}"><i--}}
                                        {{--                                                    class="fa ti-pencil text-info"></i> </a>--}}
                                        {{--                                            <a href="{{route('pemasukan.destroy',['pemasukan'=>$data->id])}}"--}}
                                        {{--                                               onclick="event.preventDefault();document.getElementById('formdelete-{{$data->id}}').submit();"><i--}}
                                        {{--                                                    class="fa ti-trash ml-2 text-danger"></i></a>--}}
                                        {{--                                            <form id="formdelete-{{$data->id}}"--}}
                                        {{--                                                  action="{{route('pemasukan.destroy',['pemasukan'=>$data->id])}}"--}}
                                        {{--                                                  method="POST" class="d-inline">--}}
                                        {{--                                                @method('delete')--}}
                                        {{--                                                @csrf--}}
                                        {{--                                            </form>--}}
                                        {{--                                        </td>--}}

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            {{--                            {{ $pemasukan->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!-- Modal View Nota -->
    @foreach($pengeluaran     as $data)
        <div class="modal fade modal-xl" id="view-nota-{{$data->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img width="1140" src="{{asset('uploads/nota/pemasukan/'.$data->image)}}"
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

