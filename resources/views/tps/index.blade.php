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
                                <a href="{{ route('tps/create') }}">
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
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Tps </th>
                            <th scope="col">Total DPT</th>
                            <th scope="col">Total Pria</th>
                            <th scope="col">Total Wanita</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Target</th>
                            <th scope="col">Anggota</th>
                            <th scope="col">Verifikasi Sukses</th>
                            <th scope="col" class="text-center">Action</th>
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
                                <td>{{$data->target}}</td>
                                <td class="text-center">{{$data->anggotas_count}}</td>
                                <td>{{$data->verified_anggotas_count}}</td>
                                <td class="text-center">
                                    <a href="{{ route('tps/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                    <form method="POST" action="{{ route('tps/destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger edit m-1" style="width: 90px">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$tps->links()}}
            </div>
        </div>
    </div>
@endsection
