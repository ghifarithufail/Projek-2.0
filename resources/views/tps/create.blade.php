@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah TPS</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <form action="{{ route('tps/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Kelurahan</label>
                        <div class="form-group">
                            <select class="kelurahan_id form-select" name="kelurahan_id" id="kelurahan_id"
                                aria-label="Default select example">

                            </select>
                        </div>
                        @error('kelurahan_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">TPS</label>
                        <div class="form-group">
                            <input id="nik" name="tps" type="text" value="{{ old('tps') }}" class="form-control">
                        </div>
                        @error('tps')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Total DPT</label>
                        <div class="form-group">
                            <input id="nik" name="totdpt" type="text" value="{{ old('totdpt') }}" class="form-control">
                        </div>
                        @error('totdpt')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">DPT Laki-Laki</label>
                        <div class="form-group">
                            <input id="nik" name="dptl" type="text" value="{{ old('dptl') }}" class="form-control">
                        </div>
                        @error('dptl')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">DPT Perempuan</label>
                        <div class="form-group">
                            <input id="nik" name="dptp" type="text" value="{{ old('dptp') }}" class="form-control">
                        </div>
                        @error('dptp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Lokasi</label>
                        <div class="form-group">
                            <input id="nik" name="lokasi" type="text" value="{{ old('lokasi') }}" class="form-control">
                        </div>
                        @error('lokasi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="nama_koordinator">Target</label>
                        <div class="form-group">
                            <input id="nik" name="target" type="text" value="{{ old('target') }}" class="form-control">
                        </div>
                        @error('target')
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
    </script>
@endsection
