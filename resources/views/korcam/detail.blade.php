@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">Koordinator Kecamatan : {{ $korcam->nama_koordinator }}</h3>
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-5 mt-2">
                            {{-- <label for="date1">Kelurahan:</label> --}}
                            <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama"
                                id="search_kelurahan">
                        </div>
                        <div class="col-sm-5 mt-2">
                            {{-- <label for="date1">Kecamatan:</label> --}}
                            <input type="text" style="height: 40px" class="form-control"
                                placeholder="kelurahan atau kecamatan" name="kelurahan" id="search_kecamatan">
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
                            <a href="{{ route('korcam/excel', ['id' => $korcam->id]) }}">
                                <button type="button" class="btn btn-success"
                                    style="zoom: 0.7; width: 100px">EXCEL</button>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <a href="{{ route('korcam/pdf', ['id' => $korcam->id]) }}" target="_blank" id="pdfLink">
                                <button type="button" class="btn btn-danger" style="zoom: 0.7; width: 100px">PDF</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                    <b>Koordinator Kelurahan :{{ $jumlahKorhan }}</b>
                </div>
                <div style="display: inline-block;">
                    <b>Konstituante : {{$jumlahKonstituante}}</b>
                </div>
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Kelurahan / Kecamatan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col" class="text-center">TPS</th>
                            <th scope="col" class="text-center">Kostituante</th>
                            {{-- <th scope="col" class="text-center">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($korhan as $item)
                            <tr>
                                <td>
                                    {{ $item->nama_koordinator }}
                                    <div>
                                        <small>{{ $item->phone }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->nik }}</td>
                                <td>
                                    {{ $item->kabkotas->nama_kabkota }}
                                    <div>
                                        <small>{{ $item->tgl_lahir }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->rt }} / {{ $item->rw }}</td>
                                <td>
                                    <b>
                                        {{ $item->kelurahans->nama_kelurahan }}
                                    </b>
                                    <div>
                                        <small>{{ $item->kelurahans->kecamatan }} -
                                            {{ $item->kelurahans->kabkota }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if ($item->status == '0')
                                        Aktif
                                    @elseif($item->status == '1')
                                        Tidak Aktif
                                    @elseif($item->status == '2')
                                        Keluar
                                    @endif
                                </td>
                                <td>
                                    @if ($item->user_id == '1')
                                        Ghifari
                                    @endif
                                <td>
                                    <ul>
                                        @foreach ($item->pivot_korhans as $row)
                                            <li>{{ $row->tps }} {{ $row->kelurahans->nama_kelurahan }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item->anggota_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
