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
							{{-- <div class="text-right">
                                <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a> <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a>
							</div> --}}
						</div>
					</div>
					{{-- <div class="head">
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">PDF</a></li>
								<li><a href="#">Excel</a></li>
							</ul>
						</div>
					</div> --}}
				</div>
				
            {{-- </div> --}}
            <div>
                <div class="mb-3">
                    <b>Konstituante : {{$jumlahAnggota}}</b>
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
                            <th scope="col">Phone</th>
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
                                <td>{{$data->phone}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
