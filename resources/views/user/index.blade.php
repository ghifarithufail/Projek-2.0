@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">USER</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('user/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.9">Tambah +</button>
                                {{-- </a> <a href="{{ route('anggota/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a> --}}
							</div>
						</div>
					</div>
				</div>
            <div>
                <table class="table" style="zoom: 0.9">
                    <thead>
                        <tr>
                            <th scope="col">Nama </th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>   
                            <th scope="col">Role</th>   
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user  as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->username}}</td>
                                <td>{{$data->status}}</td>
                                <td>
                                    @if ($data->role == '1')
                                        Admin
                                    @elseif($data->role == '2')
                                        Korcam
                                    @elseif($data->role == '3')
                                        Korhan
                                    @elseif($data->role == '4')
                                        Kortps
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user/edit', $data->id) }}"
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
