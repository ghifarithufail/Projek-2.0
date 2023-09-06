@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Edit Koordinator</h3>
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
            <form action="{{route('korcam/edit', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nama_koordinator">Nama Koordinator</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama_koordinator" type="text" value="{{ $data->nama_koordinator }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="phone">Phone</label>
                        <div class="form-group">
                            <input id="phone" name="phone" type="text" value="{{ $data->phone }}" class="form-control" minlength="2" required>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Nomor KTP</label>
                        <div class="form-group">
                            <input id="nik" name="nik" type="text" value="{{ $data->nik }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Nomor KK</label>
                        <div class="form-group">
                            <input id="nokk" name="nokk" type="text" value="{{ $data->nokk }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="form-group">
                            <input id="tgl_lahir" name="tgl_lahir" type="date" value="{{ $data->tgl_lahir }}"
                            class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="nama_koordinator">Alamat</label>
                        <div class="form-group">
                            <input id="alamat" name="alamat" type="text" value="{{ $data->alamat }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">RT</label>
                        <div class="form-group">
                            <input id="rt" name="rt" type="text" value="{{ $data->rt }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="rw">RW</label>
                        <div class="form-group">
                            <input id="rw" name="rw" type="text" value="{{ $data->rw }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <label for="status">Status</label>
                        <div class="form-group">
                            <select class="form-select" name="status" aria-label="Default select example">
                                {{-- <option selected>Pilih Status</option> --}}
                                <option value="{{$data->status}}">
                                    @if ($data->status == 0)
                                        Aktif
                                    @elseif ($data->status == 1)
                                        Tidak Aktif
                                    @endif
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kota Lahir</label>
                        <select class="form-select" name="kabkota_id">
                            <option selected>Pilih Kota</option>
                                <option value="{{ $data->kabkota_id }}" selected > -- {{ $data->kabkotas->prov }} --</option>
                            @foreach ($kota as $kotaData)
                                <option value="{{ $kotaData->id }}">{{ $kotaData->nama_kabkota }} - {{ $kotaData->prov }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kelurahan</label>
                        <div class="form-group">
                            <select class="form-select" name="kelurahan_id" aria-label="Default select example">
                                <option >Pilih Kelurahan</option>
                                <option value="{{ $data->kabkota_id }}" selected > -- {{ $data->kabkotas->prov }} --</option>

                                <option value="{{ $data->kelurahan_id }}" selected > -- {{ $data->kelurahans->nama_kelurahan }} --</option>
                                @foreach ($kelurahan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kelurahan }} - {{ $data->kecamatan }} - {{ $data->kabkota }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Keterangan</label>
                        <div class="form-group">
                            <input id="Keterangan" name="keterangan" value="{{ $data->keterangan }}" type="text" class="form-control">
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
