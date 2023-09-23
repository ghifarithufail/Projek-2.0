@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Edit Kelurahan</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('kelurahan/update', $kelurahan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kelurahan</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama_kelurahan" type="text" value="{{ $kelurahan->nama_kelurahan }}" class="form-control">
                        </div>
                        @error('nama_kelurahan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kecamatan</label>
                        <div class="form-group">
                            <input id="nik" name="kecamatan" type="text" value="{{ $kelurahan->kecamatan }}" class="form-control">
                        </div>
                        @error('kecamatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Dapil</label>
                        <div class="form-group">
                            <input id="nik" name="dapil" type="text" value="{{ $kelurahan->dapil }}" class="form-control">
                        </div>
                        @error('dapil')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kabupaten/Kota</label>
                        <div class="form-group">
                            <input id="nik" name="kabkota" type="text" value="{{ $kelurahan->kabkota }}" class="form-control">
                        </div>
                        @error('kabkota')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Provinsi</label>
                        <div class="form-group">
                            <input id="nik" name="provinsi" type="text" value="{{ $kelurahan->provinsi }}" class="form-control">
                        </div>
                        @error('provinsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kode Kelurahan</label>
                        <div class="form-group">
                            <input id="nik" name="kode_kel" type="text" value="{{ $kelurahan->kode_kel }}" class="form-control">
                        </div>
                        @error('kode_kel')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
