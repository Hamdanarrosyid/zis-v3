@extends('layouts.dashboard')
@section('content')
    <div class="p-5">
        <div class="card d-flex m-auto col-lg-9">
            <form action="{{route('jamaah.update',['jamaah'=>$jamaah->id])}}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <!-- Form Sizing -->
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-column justify-content-center align-items-center pt-4">
                                <img
                                    src="https://secondchancetinyhomes.org/wp-content/uploads/2016/09/empty-profile.png"
                                    alt="profile" class="rounded-circle w-75 h-100">
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap Jamaah*</label>
                                <input name="nama" type="text" id="nama" required
                                       class="form-control @error('nama') is-invalid @enderror"
                                       placeholder="Masukan nama lengkap" value="{{$jamaah->nama}}">
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin_id">Jenis Kelamin*</label>
                                <select
                                    class="select2-single form-control @error('jenis_kelamin_id') is-invalid @enderror"
                                    name="jenis_kelamin_id" id="email">
                                    <option value="{{null}}">Select..</option>
                                    @foreach($jenisKelamin as $data)
                                        <option
                                            @if($jamaah->jenis_kelamin_id == $data->id)
                                            selected value="{{$data->id}}">{{$data->jenis_kelamin}}
                                            @else
                                                value="{{$data->id}}">{{$data->jenis_kelamin}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_kelamin_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="tempat_lahir">Tempat*</label>
                                    <input name="tempat_lahir" type="text" required id="tempat_lahir" value="{{$jamaah->tempat_lahir}}"
                                           class="form-control @error('tempat_lahir') is-invalid @enderror"
                                           placeholder="Masukan nama tempat_lahir">
                                    @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-7">
                                    <label for="tanggal_lahir">Tanggal Lahir*</label>
                                    <input required name="tanggal_lahir" type="date" value="{{$jamaah->tanggal_lahir}}"
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                    @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dasa Wisma*</label>
                                <select name="dasa_wisma_id"
                                        class="form-control @error('dasa_wisma_id') is-invalid @enderror">
                                    <option value="{{null}}">Select..</option>
                                    @foreach($dasaWisma as $data)
                                        <option
                                            @if($jamaah->dasa_wisma_id == $data->id)
                                            selected
                                            value="{{$data->id}}">{{$data->nama_dasa_wisma}}
                                            @else
                                                value="{{$data->id}}">{{$data->nama_dasa_wisma}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('dasa_wisma_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rt_id">RT*</label>
                                <select name="rt_id" class="form-control  @error('rt_id') is-invalid @enderror">
                                    <option value="{{null}}">Select..</option>
                                    @foreach($rt as $data)
                                        <option
                                            @if($jamaah->rt_id == $data->id)
                                            selected
                                            value="{{$data->id}}">{{$data->nomor_rt}}
                                            @else
                                                value="{{$data->id}}">{{$data->nomor_rt}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('rt_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="warga_id">Warga*</label>
                                <select name="warga_id" class="form-control  @error('warga_id') is-invalid @enderror">
                                    <option value="{{null}}">Select..</option>
                                    @foreach($warga as $data)
                                        <option
                                            @if($jamaah->warga_id == $data->id)
                                            selected
                                            value="{{$data->id}}">{{$data->status_warga}}
                                            @else
                                                value="{{$data->id}}">{{$data->status_warga}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('warga_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah_id">Gol Darah*</label>
                                <select name="golongan_darah_id"
                                        class="form-control  @error('golongan_darah_id') is-invalid @enderror">
                                    <option value="{{null}}">Select..</option>
                                    @foreach($golonganDarah as $data)
                                        <option
                                            @if($jamaah->golongan_darah_id == $data->id)
                                            selected
                                            value="{{$data->id}}">{{$data->golongan_darah}}
                                            @else
                                                value="{{$data->id}}">{{$data->golongan_darah}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('golongan_darah_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan*</label>
                                <textarea name="keterangan" id="keterangan" required
                                          class="form-control  @error('keterangan') is-invalid @enderror"
                                          placeholder="Masukan keterangan">{{$jamaah->keterangan}}</textarea>
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
