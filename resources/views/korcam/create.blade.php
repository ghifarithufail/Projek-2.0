@extends('layout.index')
@section('content')

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
            integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Select2 JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah Koordinator</h3>
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
            {{-- <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
            <form action="{{ route('korcam/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nama_koordinator">Nama Koordinator</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama_koordinator" type="text"
                                value="{{ old('nama_koordinator') }}" class="form-control">
                        </div>
                        @error('nama_koordinator')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="phone">Phone</label>
                        <div class="form-group">
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                                class="form-control" minlength="2" required>
                        </div>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nik">Nomor KTP</label>
                        <div class="form-group">
                            <input id="nik" name="nik" type="text" value="{{ old('nik') }}"
                                class="form-control">
                        </div>
                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nokk">Nomor KK</label>
                        <div class="form-group">
                            <input id="nokk" name="nokk" type="text" value="{{ old('nokk') }}"
                                class="form-control">
                        </div>
                        @error('nokk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="form-group">
                            <input id="tgl_lahir" name="tgl_lahir" type="date" value="{{ old('tgl_lahir') }}"
                                class="form-control" required>
                        </div>
                        @error('tgl_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="nama_koordinator">Alamat</label>
                        <div class="form-group">
                            <input id="alamat" name="alamat" type="text" value="{{ old('alamat') }}"
                                class="form-control">
                        </div>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">RT</label>
                        <div class="form-group">
                            <input id="rt" name="rt" type="text" value="{{ old('rt') }}"
                                class="form-control">
                        </div>
                        @error('rt')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="rw">RW</label>
                        <div class="form-group">
                            <input id="rw" name="rw" type="text" value="{{ old('rw') }}"
                                class="form-control">
                        </div>
                        @error('rw')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kelurahan</label>
                        <div class="form-group">
                            <select class="kelurahan_id form-select" name="kelurahan_id" id="kelurahan_id"
                                aria-label="Default select example" required>
                                {{-- <option selected>Pilih Kelurahan</option> --}}

                                {{-- @foreach ($kelurahan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kelurahan }} - {{ $data->kecamatan }} - {{ $data->kabkota }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        @error('kelurahan_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="tpsrw_id">Di tugaskan di TPS</label>
                        <div class="form-group">
                            <select class="tpsrw_id form-select" name="tpsrw_id[]" id="tpsrw_id"
                                aria-label="Default select example" multiple="multiple" required>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kota Lahir</label>
                        <select class="form-select" name="kabkota_id" id="kabkota_id"
                            aria-label="Default select example" required>
                            {{-- <option selected>Pilih Kota</option>
                                @foreach ($kota as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kabkota }} - {{ $data->prov }}</option>
                                @endforeach --}}
                        </select>
                        @error('kabkota_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="status">Status</label>
                        <div class="form-group">
                            <select class="form-select" name="status" aria-label="Default select example" required>
                                <option selected>Pilih Status</option>
                                <option value="0">Aktif</option>
                                <option value="1">Non Aktif</option>
                                <option value="2">Keluar</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Keterangan</label>
                        <div class="form-group">
                            <input id="Keterangan" name="keterangan" type="text" class="form-control">
                        </div>
                        @error('keterangan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#kelurahan_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('get-kelurahan') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.nama_kelurahan + ' - ' + item.kecamatan + ' - ' +
                                        item.kabkota
                                }
                            })
                        };
                    },
                },
            });
        });

        $(document).ready(function() {
            $('#kabkota_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('getKabkota') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.nama_kabkota
                                }
                            })
                        };
                    },
                },
            });
        });

        $(document).ready(function() {
            $('#tpsrw_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('get-tps') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.tps + ' - ' + item.kelurahans.nama_kelurahan
                                }
                            })
                        };
                    },
                },
            });
        });
    </script>
@endsection
