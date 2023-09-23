@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Verifikasi Konstituante</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
				{{-- <div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a> 
							</div>
						</div>
					</div>
				</div> --}}
            <div>
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
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Kor-Tps</th>
                            <th scope="col" class="text-center">Verifikasi</th>
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
                                <td>{{$data->phone}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->keterangan}}</td>
                                <td>{{$data->koordinators->nama_koordinator}}</td>
                                <td>
                                    @if ($data->verified == 0)
                                        <form method="POST" action="{{ route('anggota/verifTrue', $data->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success edit m-1"
                                                style="width: 90px">Berhasil</button>
                                        </form>
                                        <form method="POST" action="{{ route('anggota/verifFalse', $data->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger edit m-1"
                                                style="width: 90px">Gagal</button>
                                        </form>
                                    @elseif($data->verified == 1)
                                        Berhasil
                                    @elseif($data->verified == 2)
                                        Gagal
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$anggota->links()}}

            </div>
        </div>
    </div>
@endsection
