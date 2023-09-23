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
            <form action="{{ route('caleg/update', $caleg->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="namacaleg" type="text" value="{{ $caleg->namacaleg }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="nama_koordinator">No urut</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="no_urut" type="text" value="{{ $caleg->no_urut }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Jenis Kelamin</label>
                        <div class="form-group">
                            <input id="nik" name="jk" type="text" value="{{ $caleg->jk }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kandidat</label>
                        <div class="form-group">
                            <input id="nik" name="kandidat" type="text" value="{{ $caleg->kandidat }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Status</label>
                        <div class="form-group">
                            <input id="nik" name="status" type="text" value="{{ $caleg->status }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Partai</label>
                        <select class="form-select" name="partai_id" aria-label="Default select example">
                            <option value="{{$caleg->partai_id}}">{{$caleg->partais->partai}}</option>
                                @foreach ($partai as $data)
                                    <option value="{{ $data->id }}">{{ $data->partai }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Photo</label>
                        <div class="form-group">
                            <input id="nik" name="photo" type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Dapil</label>
                        <select class="form-select" name="dapil_id" aria-label="Default select example">
                            <option value="{{$caleg->dapil_id}}">{{$caleg->dapils->wilayah}}</option>
                                @foreach ($dapil as $data)
                                    <option value="{{ $data->id }}">{{ $data->wilayah }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Foto Saat ini</label>
                        <br>
                        <img src="{{asset('uploads/' . $caleg->photo)}}" width="100">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
