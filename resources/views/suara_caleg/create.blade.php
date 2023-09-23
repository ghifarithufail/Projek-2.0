@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah Suara Caleg</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('suara/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Caleg</label>
                        <select class="form-select" name="caleg_id" aria-label="Default select example">
                            <option selected>Caleg</option>
                                @foreach ($caleg as $data)
                                    <option value="{{ $data->id }}">{{ $data->namacaleg }}</option>
                                @endforeach
                        </select>
                        @error('caleg_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label">Partai</label>
                        <select class="form-select" name="partai_id" aria-label="Default select example">
                            <option selected>Partai</option>
                                @foreach ($partai as $data)
                                    <option value="{{ $data->id }}">{{ $data->partai }}</option>
                                @endforeach
                        </select>
                        @error('partai_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-4">
                        <label for="tpshan_id">TPS</label>
                        <div class="form-group">
                            <select class="tpsrw_id form-select" name="tpsrw_id" id="tps_id" aria-label="Default select example">
                            </select>
                        </div>
                        @error('tpsrw_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Suara Caleg</label>
                        <div class="form-group">
                            <input id="dpr_ri" name="suara_caleg" type="text" value="{{ old('suara_caleg') }}" class="form-control">
                        </div>
                        @error('suara_caleg')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">DPR RI</label>
                        <div class="form-group">
                            <input id="dpr_ri" name="dpr_ri" type="text" value="{{ old('dpr_ri') }}" class="form-control">
                        </div>
                        @error('dpr_ri')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">DPR PROV</label>
                        <div class="form-group">
                            <input id="nik" name="dpr_prov" type="text" value="{{ old('dpr_prov') }}" class="form-control">
                        </div>
                        @error('dpr_prov')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Keterangan</label>
                        <div class="form-group">
                            <input id="dpr_ri" name="keterangan" type="text" value="{{ old('keterangan') }}" class="form-control">
                        </div>
                        @error('dpr_ri')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">DPRD</label>
                        <div class="form-group">
                            <input id="nik" name="dprd" type="text" value="{{ old('dpr_prov') }}" class="form-control">
                        </div>
                        @error('dprd')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Photo</label>
                        <div class="form-group">
                            <input id="nik" name="photo" type="file" value="{{ old('photo') }}" class="form-control">
                        </div>
                        @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
            </form>
        </div>
    </div>

    <script>
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
