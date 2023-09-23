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

        <title>Hello, world!</title>
    </head>

    <div class="data">
        <div class="content-data">
            <div class="container">
                <h1 class="text-center">Pelajar</h1>
                <form action="{{ route('korcam/edit', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama_koordinator">Nama Koordinator</label>
                            <div class="form-group">
                                <input id="nama_koordinator" name="nama_koordinator" type="text"
                                    value="{{ $data->nama_koordinator }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="nama_koordinator">Phone</label>
                            <div class="form-group">
                                <input id="nama_koordinator" name="phone" type="text" value="{{ $data->phone }}"
                                    class="form-control" minlength="2" required>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="nama_koordinator">Nomor KTP</label>
                            <div class="form-group">
                                <input id="nik" name="nik" type="text" value="{{ $data->nik }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="nama_koordinator">Nomor KK</label>
                            <div class="form-group">
                                <input id="nokk" name="nokk" type="text" value="{{ $data->nokk }}"
                                    class="form-control">
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
                                <input id="alamat" name="alamat" type="text" value="{{ $data->alamat }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="nama_koordinator">RT</label>
                            <div class="form-group">
                                <input id="rt" name="rt" type="text" value="{{ $data->rt }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="rw">RW</label>
                            <div class="form-group">
                                <input id="rw" name="rw" type="text" value="{{ $data->rw }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label class="form-label">Kelurahan</label>
                            <div class="form-group">
                                <select class="kelurahan_id form-select" name="kelurahan_id" id="kelurahan_id"
                                    aria-label="Default select example">
                                    <option value="{{ $data->kelurahan_id }}" selected> --
                                        {{ $data->kelurahans->nama_kelurahan }} --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label class="form-label">Kota Lahir</label>
                            <select class="form-select" name="kabkota_id" id="kabkota_id">
                                <option selected>Pilih Kota</option>
                                <option value="{{ $data->kabkota_id }}" selected> -- {{ $data->kabkotas->prov }} --</option>
                            </select>
                        </div>

                        <div class="col-sm-6 mt-3 mb-3">
                            <label class="form-label">TPS</label>
                            <select class="form-select mt-3 mb-3" id="tpsrw_id" name="tpsrw_id[]" multiple="multiple">
                                @foreach ($tps as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, old('tpsrw_id', $data->tpsrws->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $item->tps }} - {{ $item->kelurahans->nama_kelurahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label for="status">Status</label>
                            <div class="form-group">
                                <select class="form-select" name="status" aria-label="Default select example">
                                    {{-- <option selected>Pilih Status</option> --}}
                                    <option value="{{ $data->status }}">
                                        @if ($data->status == 0)
                                            Aktif
                                        @elseif ($data->status == 1)
                                            Tidak Aktif
                                        @endif
                                    </option>
                                    <option value="0">Aktif</option>
                                    <option value="1">Tidak Aktif</option>
                                    <option value="2">Keluar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="nama_koordinator">Keterangan</label>
                            <div class="form-group">
                                <input id="Keterangan" name="keterangan" value="{{ $data->keterangan }}" type="text"
                                    class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </form>
            </div>
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
        $(document).ready(function() {
            $('#tpsrw_id').select2({
                placeholder: 'Select',
                allowClear: true,
                ajax: {
                    url: "{{ route('get-tps') }}",
                    type: "post",
                    delay: 150,
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

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
