@extends('layouts.dashboard')
@section('content')
    <style>
        .custom-cursor{
            cursor: pointer;
        }
    </style>
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
                                <li class="active">Laporan ZIS</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content " style="margin-bottom: 200px">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Grafik Laporan Zis</h4>
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">
                                <i class="ti ti-envelope"></i>
                                Table Laporan ZIS
                            </strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis ZIS</th>
                                    <th>Pemasukan</th>
                                    <th>Pengeluaran</th>
                                    <th>Saldo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pemasukan as $nama_jenis_zis => $nominal)
                                    <tr class="custom-cursor">
                                        <td>{{$pemasukan->firstItem() + $no++}}</td>
                                        <td>{{ $nama_jenis_zis }}</td>
                                        <td>Rp {{number_format($nominal['pemasukan'])}}</td>
                                        <td>Rp {{number_format($nominal['pengeluaran']) }}</td>
                                        <td>Rp {{number_format($nominal['saldo']) }}</td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td>Rp {{number_format($totalm)}}</td>
                                    <td>Rp {{number_format($totalk)}}</td>
                                    <td>Rp {{number_format($totals)}}</td>
                                </tr>
                                </tbody>
                            </table>
                            {{ $pemasukan->links() }}
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>--}}
{{--    <script src="assets/js/init/chartjs-init.js"></script>--}}
@endsection

