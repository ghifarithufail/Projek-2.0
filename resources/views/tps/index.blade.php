@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Data TPS</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a>
                                {{-- </a> <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a> --}}
							</div>
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
                <table class="table" style="zoom: 0.8">
                    <thead>
                        <tr>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Tps </th>
                            <th scope="col">Total DPT</th>
                            <th scope="col">Total Pria</th>
                            <th scope="col">Total Wanita</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Anggota</th>
                            {{-- <th scope="col" class="text-center">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tps  as $data)
                            <tr>
                                <td>{{$data->kelurahans->nama_kelurahan}}</td>
                                <td>
                                    <a href="{{ route('kortps/detail', $data->id) }}">
                                        {{$data->tps}}
                                    </a>
                                </td>
                                <td>{{$data->totdpt}}</td>
                                <td>{{$data->dptl}}</td>
                                <td>{{$data->dptp}}</td>
                                <td>{{$data->lokasi}}</td>
                                <td class="text-center">{{$data->anggotas_count}}</td>
                                {{-- <td class="text-center">
                                    <a href="{{ route('dapil/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                        <a href="#"
                                        class="btn btn-danger edit m-1" style="width: 90px">Delete
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$tps->links()}}
            </div>
        </div>
    </div>
@endsection
