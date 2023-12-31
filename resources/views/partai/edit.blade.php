@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah Parrtai</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('partai/update', $partai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama" type="text" value="{{ $partai->nama }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Partai</label>
                        <div class="form-group">
                            <input id="nik" name="partai" type="text" value="{{ $partai->partai }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="nama_koordinator">Foto</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="foto" type="file"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Foto Saat ini</label>
                        <br>
                        <img src="{{asset('uploads/' . $partai->foto)}}" width="100">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
