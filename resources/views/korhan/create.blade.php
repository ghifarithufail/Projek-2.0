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

            <h3 style="text-align: center;">Tambah Koordinator Kelurahan</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('korhan/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="nama_koordinator">Nama Koordinator</label>
                        <div class="form-group">
                            <input id="nama_koordinator" name="nama_koordinator" type="text" value="{{ old('nama_koordinator') }}" class="form-control">
                        </div>
                        @error('nama_koordinator')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="phone">Phone</label>
                        <div class="form-group">
                            <input id="phone" name="phone" type="number" value="{{ old('phone') }}" class="form-control" minlength="2" required>
                        </div>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nik">Nomor KTP</label>
                        <div class="form-group">
                            <input id="nik" name="nik" type="number" value="{{ old('nik') }}" class="form-control">
                        </div>
                        @error('nik')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Nomor KK</label>
                        <div class="form-group">
                            <input id="nokk" name="nokk" type="number" value="{{ old('nokk') }}" class="form-control">
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
                            <input id="alamat" name="alamat" type="text" value="{{ old('alamat') }}" class="form-control">
                        </div>
                        @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">RT</label>
                        <div class="form-group">
                            <input id="rt" name="rt" type="number" value="{{ old('rt') }}" class="form-control">
                        </div>
                        @error('rt')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="rw">RW</label>
                        <div class="form-group">
                            <input id="rw" name="rw" type="number" value="{{ old('rw') }}" class="form-control">
                        </div>
                        @error('rw')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kelurahan</label>
                        <div class="form-group">
                            <select class="kelurahan_id form-select" name="kelurahan_id" id="kelurahan_id" aria-label="Default select example">
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
                        <label for="tpshan_id">Di tugaskan di TPS</label>
                        <div class="form-group">
                            <select class="tpsrw_id form-select" name="tpshan_id[]" id="tps_id" aria-label="Default select example" multiple="multiple">
                            </select>
                        </div>
                        @error('tpshan_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="nama_koordinator">Koordinator Kecamatan</label>
                        <div class="form-group">
                            <select class="tpsrw_id form-select" name="korcam_id" id="korcam_id" aria-label="Default select example">
                                {{-- <option selected>Pilih TPS</option> --}}
                                {{-- @foreach ($tps as $data)
                                    <option value="{{ $data->id }}">{{$data->tps}} {{ $data->kelurahans->nama_kelurahan }} - {{ $data->kelurahans->kecamatan }} - {{ $data->kelurahans->kabkota }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        @error('korcam_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Kota Lahir</label>
                        <select class="form-select" name="kabkota_id" id="kabkota_id" aria-label="Default select example">
                            <option selected>Pilih Kota</option>
                        </select>
                        @error('kabkota_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="status">Status</label>
                        <div class="form-group">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="">Pilih Status</option>
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
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#korcam_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('getKorcam') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nama_koordinator
                                }
                            })
                        };
                    },
                },
            });
        });
        $(document).ready(function () {
            $('#kabkota_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('getKabkota') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nama_kabkota + ' - ' + item.prov 
                                }
                            })
                        };
                    },
                },
            });
        });
            $(document).ready(function () {
            $('#kelurahan_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('get-kelurahan') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nama_kelurahan + ' - ' + item.kecamatan + ' - ' + item.kabkota
                                }
                            })
                        };
                    },
                },
            });
        });

        $(document).ready(function () {
            $('#tps_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('get-tps') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.tps  + ' - ' + item.kelurahans.nama_kelurahan 
                                }
                            })
                        };
                    },
                },
            });
        });
    </script>

@endsection
