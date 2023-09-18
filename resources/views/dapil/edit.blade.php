@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Edit Dapil</h3>
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
            {{-- {{ route('korcam/edit', $data->id) }} --}}
            <form action="{{ route('dapil/update', $dapil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label for="nama_koordinator">Nama</label>
                        <div class="form-group">
                            <input id="nama_dapil" name="nama_dapil" type="text" value="{{ $dapil->nama_dapil }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Wilayah</label>
                        <div class="form-group">
                            <input id="wilayah" name="wilayah" type="text" value="{{ $dapil->wilayah }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="nama_koordinator">Keterangan</label>
                        <div class="form-group">
                            <input id="keterangan" name="keterangan" type="text" value="{{ $dapil->keterangan }}" class="form-control">
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
