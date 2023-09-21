@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Koordinator {{$kortps->nama_koordinator}}</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
                <div class="menu d-flex justify-content-end">
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <a href="{{ route('kortps/excel', ['id' => $kortps->id]) }}">
                                    <button type="button" class="btn btn-success" style="zoom: 0.7; width: 100px">EXCEL</button>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <a href="{{ route('kortps/pdf', ['id' => $kortps->id]) }}" target="_blank">
                                    <button type="button" class="btn btn-danger" style="zoom: 0.7; width: 100px">PDF</button>
                                </a>
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
                        <b>Korcam : {{$kortps->korhans->koordinators->nama_koordinator}}</b>
                    </div>
                    <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                        <b>Korhan : {{$kortps->korhans->nama_koordinator}}</b>
                    </div>
                    <div style="display: inline-block;">
                        <b>Konstituante : {{$jumlahAnggota}}</b>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $data)
                            <tr>
                                <td>
                                    <b>{{$data->nama_anggota}}</b>
                                    <div>
                                        <small>{{$data->phone}}</small>
                                    </div>
                                </td>
                                <td>
                                    <a href="https://cekdptonline.kpu.go.id/{{$data->nik}}" target="_blank">
                                    {{$data->nik}}
                                    </a>
                                </td>
                                <td>
                                    <b>{{$data->kabkotas->nama_kabkota}}</b>
                                    <div>
                                        <small>{{$data->tgl_lahir}}</small>
                                    </div>
                                </td>
                                <td>{{$data->alamat}}</td>
                                <td>{{$data->rt}} / {{$data->rw}}</td>
                                <td>
                                    <b>{{$data->tps->tps}} {{$data->tps->kelurahans->nama_kelurahan}}</b>
                                    <div>
                                        <small>{{$data->tps->kelurahans->kecamatan}}</small>
                                    </div>
                                </td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$anggota->links()}}
            </div>
        </div>
    </div>
@endsection
