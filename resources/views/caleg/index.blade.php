@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Caleg</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('caleg/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
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
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama </th>
                            <th scope="col">No urut</th>
                            <th scope="col">Dapil</th>
                            <th scope="col">Partai</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Kandidat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Photo</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($caleg  as $data)
                            <tr>
                                <td>{{$data->namacaleg}}</td>
                                <td>{{$data->no_urut}}</td>
                                <td>
                                    <b>{{$data->dapils->wilayah}} </b>
                                    <div>
                                        {{$data->dapils->nama_dapil}}
                                    </div>
                                </td>
                                <td>{{$data->partais->partai}}</td>
                                <td>{{$data->jk}}</td>
                                <td>{{$data->kandidat}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->photo}}</td>
                                <td class="text-center">
                                    <a href="{{ route('caleg/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                        <a href="#"
                                        class="btn btn-danger edit m-1" style="width: 90px">Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
