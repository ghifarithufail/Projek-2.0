@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">kelurahan</h3>
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-5 mt-2">
                            {{-- <label for="date1">Kelurahan:</label> --}}
                            <input type="text" style="height: 40px" class="form-control" placeholder="Kelurahan Name" name="kelurahan" id="search_kelurahan">
                        </div>
                        <div class="col-sm-6 mt-2">
                            {{-- <label for="date1">Kecamatan:</label> --}}
                            <input type="text" style="height: 40px" class="form-control" placeholder="Kecamatan Name" name="kecamatan" id="search_kecamatan">
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px" id="search_btn" >Search</button>
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
							<div class="text-right">
                                <a href="{{ route('kelurahan/create') }}">
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
                            <th scope="col">Kecamatan </th>
                            <th scope="col">Dapil</th>
                            <th scope="col">Kabupaten/Kota</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kode Kelurahan</th>
                            <th scope="col">Konstituante</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelurahan  as $data)
                            <tr>
                                <td>
                                    <a href="{{ route('kelurahan/detail', $data->id) }}">
                                        {{$data->kelurahan}}
                                    </a>
                                </td>
                                <td>{{$data->kecamatan}}</td>
                                <td>{{$data->dapil}}</td>
                                <td>{{$data->kabkota}}</td>
                                <td>{{$data->provinsi}}</td>
                                <td>{{$data->kode_kel}}</td>
                                <td>{{$data->anggota_count}}</td>
                                <td class="text-center">
                                    <a href="{{ route('kelurahan/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                    <form method="POST" action="{{ route('kelurahan/destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger edit m-1" style="width: 90px">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$kelurahan->links()}}
            </div>
        </div>
    </div>
@endsection
