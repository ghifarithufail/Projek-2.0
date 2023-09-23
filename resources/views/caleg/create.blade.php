@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah Caleg</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('caleg/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="namacaleg" type="text" value="{{ old('namacaleg') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="nama_koordinator">No urut</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="no_urut" type="text" value="{{ old('no_urut') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Jenis Kelamin</label>
                        <div class="form-group">
                            <input id="nik" name="jk" type="text" value="{{ old('jk') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kandidat</label>
                        <div class="form-group">
                            <input id="nik" name="kandidat" type="text" value="{{ old('kandidat') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Status</label>
                        <div class="form-group">
                            <input id="nik" name="status" type="text" value="{{ old('status') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Partai</label>
                        <select class="form-select" name="partai_id" aria-label="Default select example">
                            <option selected>Partai</option>
                                @foreach ($partai as $data)
                                    <option value="{{ $data->id }}">{{ $data->partai }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Dapil</label>
                        <select class="form-select" name="dapil_id" aria-label="Default select example">
                            <option selected>Pilih Dapil</option>
                                @foreach ($dapil as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_dapil }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Photo</label>
                        <div class="form-group">
                            <input id="nik" name="photo" type="file" value="{{ old('photo') }}" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
