@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Partai</h3>
        </div>
    </div>
    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            <div class="menu d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                        <div class="text-right">
                            <a href="{{ route('partai/create') }}">
                                <button type="button" class="btn btn-success" style="zoom: 0.9">Tambah +</button>
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
                <table class="table" style="zoom: 0.9">
                    <thead>
                        <tr>
                            <th scope="col">Foto </th>
                            <th scope="col">Nama</th>
                            <th scope="col">Partai</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partai as $data)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/' . $data->foto) }}" width="80"
                                        style="border-radius: 20%;">
                                </td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->partai }}</td>
                                <td class="text-center">
                                    <a href="{{ route('partai/edit', $data->id) }}" class="btn btn-warning edit m-1"
                                        style="width: 90px">Edit
                                    </a>
                                    <form method="POST" action="{{ route('partai/destroy', $data->id) }}"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger edit m-1"
                                            style="width: 90px" onclick="return confirm('Data Partai akan terhapus secara permanen, Apakah kamu yakin?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
