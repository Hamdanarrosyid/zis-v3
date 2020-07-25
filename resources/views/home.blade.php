@extends('layouts.dashboard')

@section('content')
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text">
                                            Rp{{number_format($pemasukan)}}
                                        </div>
                                        <div class="stat-heading">Pemasukan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text">Rp{{number_format($pengeluaran)}}</div>
                                        <div class="stat-heading">Pengeluaran</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-browser"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{$jeniszis}}</span></div>
                                        <div class="stat-heading">Jenis Zis</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--@auth()--}}
{{--                <div class="col-lg-4 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="stat-widget-five">--}}
{{--                                <div class="stat-icon dib flat-color-4">--}}
{{--                                    <i class="pe-7s-users"></i>--}}
{{--                                </div>--}}
{{--                                <div class="stat-content">--}}
{{--                                    <div class="text-left dib">--}}
{{--                                        <div class="stat-text"><span class="count">{{$user}}</span></div>--}}
{{--                                        <div class="stat-heading">Users</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endauth--}}
            <!-- /Widgets -->


            <!-- Calender Chart Weather  -->
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="box-title">Chandler</h4> -->
                            <div class="calender-cont widget-calender">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /Calender Chart Weather -->
            <!-- Modal - Calendar - Add New Event -->
            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Tambahkan Acara</strong></h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Tambah
                                Acara
                            </button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                    data-dismiss="modal">Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#event-modal -->
            <!-- Modal - Calendar - Add Category -->
            <div class="modal fade none-border" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Tambahkan Kategori </strong></h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Masukan Nama Acara</label>
                                        <input class="form-control form-white" placeholder="Masukan nama" type="text"
                                               name="category-name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Pilih warna</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..."
                                                name="category-color">
                                            <option value="success">Hijau</option>
                                            <option value="danger">Merah</option>
                                            <option value="info">Biru Muda</option>
                                            <option value="pink">Pink</option>
                                            <option value="primary">Biru Tua</option>
                                            <option value="warning">Kuning</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                                    data-dismiss="modal">Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#add-category -->
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->
@endsection
