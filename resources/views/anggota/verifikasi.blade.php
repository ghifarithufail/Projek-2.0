@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Verifikasi Konstituante</h3>
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
                                <td class="text-center">
                                    @if ($data->verified == 0)
                                        {{-- <form id="suksesVerifikasi" method="POST" action="{{ route('anggota/verifTrue', $data->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" onclick="suksesVerifikasi('{{ $item->nama_anggota }}')" class="btn btn-success sukses m-1"
                                                style="width: 90px">Berhasil</button>
                                        </form> --}}

                                        <form id="deleteForm" method="POST" action="{{ route('anggota/verifTrue', $data->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="button" class="btn btn-success delete m-1" style="width: 90px" onclick="confirmDelete('{{ $data->nama_anggota }}')">Berhasil</button>
                                        </form>

                                        <form id="failedForm" method="POST" action="{{ route('anggota/verifFalse', $data->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="button" class="btn btn-danger failed m-1" style="width: 90px" onclick="confirmFailed('{{ $data->nama_anggota }}')">Gagal</button>
                                        </form>

                                        {{-- <form method="POST" action="{{ route('anggota/verifFalse', $data->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger edit m-1"
                                                style="width: 90px">Gagal</button>
                                        </form> --}}
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function confirmDelete(itemName) {
            swal({
                title: "Apakah anda yakin?",
                text: "Bahwa data ini lolos verifikasi " + itemName,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }
        function confirmFailed(itemName) {
            swal({
                title: "Apakah anda yakin?",
                text: "Bahwa data ini Gagal verifikasi " + itemName,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('failedForm').submit();
                }
            });
        }
    </script>
@endsection
