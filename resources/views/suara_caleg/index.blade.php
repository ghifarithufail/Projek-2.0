@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Suara Caleg</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
                                <a href="{{ route('suara/create') }}">
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
                            <th scope="col">Caleg</th>
                            <th scope="col">Partai</th>
                            <th scope="col">TPS</th>
                            <th scope="col">Suara Caleg</th>
                            <th scope="col">DPR RI</th>
                            <th scope="col">DPR PROV</th>
                            <th scope="col">DPRD</th>
                            <th scope="col">Target</th>
                            <th scope="col">Photo</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suara  as $data)
                            <tr>
                                <td>{{$data->calegs->namacaleg}}</td>
                                <td>{{$data->partais->partai}}</td>
                                <td>{{$data->tpsrws->tps}} - {{$data->tpsrws->kelurahans->nama_kelurahan}} - {{$data->tpsrws->kelurahans->kecamatan}}</td>
                                <td>{{$data->suara_caleg}}</td>
                                <td>{{$data->dpr_ri}}</td>
                                <td>{{$data->dpr_prov}}</td>
                                <td>{{$data->dprd}}</td>
                                <td>{{$data->tpsrws->target}}</td>
                                <td>
                                    <img src="{{asset('uploads/' . $data->photo)}}" width="100" style="border-radius: 20%;">
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('suara/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                    <form method="POST" action="{{ route('suara/destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger edit m-1" style="width: 90px">Delete</button>
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
