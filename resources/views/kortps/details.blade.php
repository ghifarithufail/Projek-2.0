@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            @if ($anggota->isNotEmpty())
                <h3 style="text-align: center;">KOORDINATOR TPS {{ $anggota->first()->tps->tps }}
                    {{ $anggota->first()->tps->kelurahans->nama_kelurahan }} : {{ strtoupper($kortps->nama_koordinator) }} 
                </h3>
            @else
                <h3 style="text-align: center;">Koordinator {{ strtoupper($kortps->nama_koordinator) }} </h3>
            @endif
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama"
                                id="search_kelurahan">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="NIK" name="nik"
                                id="search_kecamatan">
                        </div>
                        <div class="col-sm-3 mt-2">
                            <select class="form-select" name="verifikasi" aria-label="Default select example">
                                <option selected value="">Status Verifikasi</option>
                                <option value="0">Belum</option>
                                <option value="1">Berhasil</option>
                                <option value="2">Gagal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px"
                            id="search_btn">Search</button>
                        {{-- <button type="button" class="btn btn-warning rounded text-white" id="reset_btn" style="background-color: #d9d682; margin-left: 20px">Reset</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            <div class="menu d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            @if ($anggota->isNotEmpty() && $anggota->first()->tps)
                            <a href="{{ route('kortps/excel', ['id' => $kortps->id, 'tps' => $anggota->first()->tps->id]) }}">
                                <button type="button" class="btn btn-success"
                                    style="zoom: 0.7; width: 100px">EXCEL</button>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            @if ($anggota->isNotEmpty() && $anggota->first()->tps)
                                <a href="{{ route('kortps/pdf', ['id' => $kortps->id, 'tps' => $anggota->first()->tps->id]) }}"
                                    target="_blank" id="pdfLink">
                                    <button type="button" class="btn btn-danger"
                                        style="zoom: 0.7; width: 100px">PDF</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
            <div>
                {{-- <div>
                    <a href="{{ route('kortps/download', ['id' => $kortps->id]) }}">
                        <button>
                            pdf
                        </button>
                    </a>
                </div> --}}
                <div>
                    <div style="display: inline-block; margin-right: 20px;">
                        <b>Korcam : {{ $kortps->korhans->koordinators->nama_koordinator }}</b>
                    </div>
                    <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                        <b>Korhan : {{ $kortps->korhans->nama_koordinator }}</b>
                    </div>
                    <div style="display: inline-block; margin-right: 20px;">
                        <b>Konstituante : {{ $jumlahAnggota }}</b>
                    </div>
                    <div style="display: inline-block;  margin-right: 20px;">
                        <b>Terverifikasi : {{ $verifiedCount }}</b>
                    </div>
                    <div style="display: inline-block;">
                        @if ($anggota->isNotEmpty())
                            <b>Target : {{ $anggota->first()->tps->target }}</b>
                        @else
                            <b>Target : </b>
                        @endif
                    </div>
                </div>

                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP/KK</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Tps</th>
                            {{-- <th scope="col">Bertugas</th>  --}}
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Relawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $data)
                            <tr>
                                <td>
                                    <b>{{ $data->nama_anggota }}</b>
                                    <div>
                                        <small>{{ $data->phone }}</small>
                                    </div>
                                </td>
                                <td>
                                    <a href="https://cekdptonline.kpu.go.id/{{ $data->nik }}" target="_blank">
                                        {{ $data->nik }}
                                    </a>
                                </td>
                                <td>
                                    <b>{{ $data->kabkotas->nama_kabkota }}</b>
                                    <div>
                                        <small>{{ $data->tgl_lahir }}</small>
                                    </div>
                                </td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->rt }} / {{ $data->rw }}</td>
                                <td>
                                    <b>{{ $data->tps->tps }} {{ $data->tps->kelurahans->nama_kelurahan }}</b>
                                    <div>
                                        <small>{{ $data->tps->kelurahans->kecamatan }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if ($data->status == '0')
                                        Aktif
                                    @elseif($data->status == '1')
                                        Tidak Aktif
                                    @elseif($data->status == '2')
                                        Keluar
                                    @endif
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    @if ($data->verified == 0)
                                        Belum Diverifikasi
                                    @elseif($data->verified == 1)
                                        Berhasil Verifikasi
                                    @elseif($data->verified == 2)
                                        Gagal Verifikasi
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $anggota->links() }}
            </div>
        </div>
    </div>
    <script>
        document.getElementById('pdfLink').addEventListener('click', function(e) {
            e.preventDefault();
            const pdfUrl = this.getAttribute('href');

            const newWindow = window.open(pdfUrl, '_blank');

            newWindow.addEventListener('load', function() {
                newWindow.print();
            });
        });
    </script>
@endsection
