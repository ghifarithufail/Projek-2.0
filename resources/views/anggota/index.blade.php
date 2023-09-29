@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}

    <style>

        @media screen and (max-width: 768px) {
        .data {
            width: 100%; /* Adjust the width as needed for smaller screens */
            overflow-x: scroll; /* Allow scrolling on smaller screens */
        }
    }
        </style>

    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">Konstituante</h3>
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 mt-2">
                                <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama" id="search_kelurahan">
                            </div>
                            <div class="col-sm-3 mt-2">
                                <input type="text" style="height: 40px" class="form-control" placeholder="kortps" name="kortps" id="search_kecamatan">
                            </div>
                            <div class="col-sm-4 mt-2">
                                <input type="text" style="height: 40px" class="form-control" placeholder="kelurahan atau kecamatan" name="kelurahan" id="search_kecamatan">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px" id="search_btn">Search</button>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </form>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a> 
							</div>
						</div>
					</div>
				</div>
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
                            @if (Auth::user()->role == '1')
                            <th scope="col" class="text-center">Action</th>
                            @endif
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
                                    {{-- <a href="https://cekdptonline.kpu.go.id/{{$data->nik}}" target="_blank"> --}}
                                    {{$data->nik}}
                                    {{-- </a> --}}
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
                                @if (Auth::user()->role == '1')
                                <td class="text-center">
                                    <a href="{{ route('anggota/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                    <form method="POST" action="{{ route('anggota/destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger edit m-1" style="width: 90px">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$anggota->links()}}

            </div>
        </div>
    </div>
@endsection
