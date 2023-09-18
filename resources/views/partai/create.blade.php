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
            {{-- <div class="head"> --}}
            {{-- <div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
								<button type="button" class="btn btn-success">Tambah +</button>
							</div>
						</div>
					</div>
					<div class="head">
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">PDF</a></li>
								<li><a href="#">Excel</a></li>
							</ul>
						</div>
					</div>
				</div> --}}

            {{-- </div> --}}
            <form action="{{ route('partai/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="namacaleg" type="text" value="{{ old('foto') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama" type="text" value="{{ old('nama') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Partai</label>
                        <div class="form-group">
                            <input id="nik" name="partai" type="text" value="{{ old('partai') }}" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
