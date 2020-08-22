@extends('layouts.dashboard')
@section('content')
    <div class="p-5">
        <div class="card d-flex m-auto col-lg-9">
            <form action="{{route('jamaah.store')}}" method="post">
                @csrf
                <div class="row">
                    <!-- Form Sizing -->
                    <div class="col-lg-12">
                        {{--                        <div class="align-content-center d-flex justify-content-center">--}}
                        {{--                        <div class="card-header d-flex flex-column align-content-center">--}}
                        <div class="d-flex justify-content-center align-content-center">
                            {{--                                <img src="https://source.unsplash.com/random" alt="profile" class="width-90 height-93">--}}
                            <h6 class=" font-weight-bold text-primary mb-0" style="font-size: 20px">Data Jamaah</h6>
                        </div>
                    </div>
                    {{--                        </div>--}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap Jamaah*</label>
                            <input name="nama" type="text" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   placeholder="Masukan nama lengkap">
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin*</label>
                            <select class="select2-single form-control @error('jenis_kelamin') is-invalid @enderror"
                                    name="jenis_kelamin" id="email">
                                <option value="{{null}}">Select..</option>
                                @foreach($jenisKelamin as $data)
                                    <option value="{{$data->id}}">{{$data->jenis_kelamin}}</option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <label for="tempat">Tempat*</label>
                                <input name="tempat" type="text" id="tempat"
                                       class="form-control @error('tempat') is-invalid @enderror"
                                       placeholder="Masukan nama tempat">
                                @error('tempat')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-7">
                                <label for="tanggal">Tanggal Lahir*</label>
                                <input required name="tanggal" type="date"
                                       class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dasa Wisma*</label>
                            <select name="nama_dasa_wisma"
                                    class="form-control @error('nama_dasa_wisma') is-invalid @enderror">
                                <option value="{{null}}">Select..</option>
                                @foreach($dasaWisma as $data)
                                    <option value="{{$data->id}}">{{$data->nama_dasa_wisma}}</option>
                                @endforeach
                            </select>
                            @error('nama_dasa_wisma')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_rt">RT*</label>
                            <select name="nomor_rt" class="form-control  @error('nomor_rt') is-invalid @enderror">
                                <option value="{{null}}">Select..</option>
                                @foreach($rt as $data)
                                    <option value="{{$data->id}}">{{$data->nomor_rt}}</option>
                                @endforeach
                            </select>
                            @error('nomor_rt')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="warga">Warga*</label>
                            <select name="warga" class="form-control  @error('warga') is-invalid @enderror">
                                <option value="{{null}}">Select..</option>
                                @foreach($warga as $data)
                                    <option value="{{$data->id}}">{{$data->status_warga}}</option>
                                @endforeach
                            </select>
                            @error('warga')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="golongan_darah">Gol Darah*</label>
                            <select name="golongan_darah"
                                    class="form-control  @error('golongan_darah') is-invalid @enderror">
                                <option value="{{null}}">Select..</option>
                                @foreach($golonganDarah as $data)
                                    <option value="{{$data->id}}">{{$data->golongan_darah}}</option>
                                @endforeach
                            </select>
                            @error('golongan_darah')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan*</label>
                            <textarea name="keterangan" id="keterangan"
                                      class="form-control  @error('keterangan') is-invalid @enderror"
                                      placeholder="Masukan keterangan"></textarea>
                            @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" name="reset" value="reset" class="btn btn-danger">Batal</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
