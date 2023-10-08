@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">USER</h3>
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama" id="search_kelurahan">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="Username" name="username" id="search_kecamatan">
                        </div>
                        <div class="col-sm-3 mt-2">
                            <select class="form-select" name="role" aria-label="Default select example">
                                <option selected value="">Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Korcam</option>
                                <option value="3">Korhan</option>
                                <option value="4">Kortps</option>
                                <option value="5">Owner</option>
                            </select>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px" id="search_btn" >Search</button>
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
                                @if (Auth::user()->role == '1')
                                <a href="{{ route('user/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.9">Tambah +</button>
                                </a>
                                @endif
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
                            <th scope="col">Role 2</th>
                            @if (Auth::user()->role == '1')
                            <th scope="col" class="text-center">Action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user  as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->username}}</td>
                                <td>
                                    @if ($data->status == '0')
                                        Aktif
                                    @elseif($data->status == '1')
                                        Non Aktif
                                    @elseif($data->status == '2')
                                        Keluar
                                    @endif
                                </td>
                                <td>
                                    @if ($data->role == '1')
                                        Admin
                                    @elseif($data->role == '2')
                                        Korcam
                                    @elseif($data->role == '3')
                                        Korhan
                                    @elseif($data->role == '4')
                                        Kortps
                                    @elseif($data->role == '5')
                                        Owner
                                    @endif
                                </td>
                                <td>
                                    @if ($data->role2 == '4')
                                        Kortps
                                    @elseif($data->role2 == '5')
                                        Non Aktif
                                    @else
                                        -
                                    @endif
                                </td>
                                @if (Auth::user()->role == '1')
                                <td class="text-center">
                                    <a href="{{ route('user/edit', $data->id) }}"
                                        class="btn btn-warning edit m-1" style="width: 90px">Edit
                                    </a>
                                    <form id="deleteForm{{ $data->id }}" method="POST" action="{{ route('user/destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-danger delete m-1" style="width: 90px" onclick="confirmDelete('{{ $data->name }}', {{ $data->id }})">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$user->links()}}
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function confirmDelete(itemName, userId) {
            swal({
                title: "Apakah anda yakin?",
                text: "Ingin menghapus data user " + itemName,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm' + userId).submit();
                }
            });
        }

    </script>
@endsection
